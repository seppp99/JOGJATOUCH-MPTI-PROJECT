<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfilePhotoRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

/**
 * Foto profil pengguna: simpan/ganti dan hapus.
 *
 * Semua respons berbentuk JSON karena antarmukanya berbasis fetch() dari modal,
 * bukan submit form biasa. Bentuk respons dibuat konsisten supaya sisi klien
 * cukup menangani satu pola:
 *
 *   sukses : { ok: true,  url: string|null, message: string }
 *   gagal  : { ok: false, message: string }
 *
 * Galat validasi tetap dibiarkan mengalir sebagai 422 bawaan Laravel (berisi
 * `errors`), dan sisi klien membacanya secara khusus.
 */
class ProfilePhotoController extends Controller
{
    /**
     * Folder penyimpanan di disk 'public'.
     */
    private const DIRECTORY = 'profile-photos';

    /**
     * Simpan atau ganti foto profil.
     *
     * Urutannya disengaja: simpan berkas BARU dulu, baru hapus yang lama. Kalau
     * dibalik, kegagalan penyimpanan akan meninggalkan pengguna tanpa foto sama
     * sekali - foto lamanya sudah terlanjur hilang.
     */
    public function update(UpdateProfilePhotoRequest $request): JsonResponse
    {
        $user = $request->user();

        try {
            $newPath = $request->file('photo')->store(self::DIRECTORY, 'public');

            if ($newPath === false) {
                return $this->failed('Foto gagal disimpan ke penyimpanan.');
            }

            $oldPath = $user->photo_path;

            $user->photo_path = $newPath;
            $user->save();

            // Berkas lama dihapus SETELAH database diperbarui. Kalau save()
            // gagal, foto lama masih utuh dan record tetap konsisten.
            if (filled($oldPath) && $oldPath !== $newPath) {
                $this->deleteFileQuietly($oldPath);
            }

            return response()->json([
                'ok' => true,
                'url' => $user->refresh()->profilePhotoUrl(),
                'message' => 'Foto profil berhasil diperbarui.',
            ]);
        } catch (Throwable $e) {
            // Bersihkan berkas yatim bila kegagalan terjadi setelah unggahan.
            if (isset($newPath) && is_string($newPath)) {
                $this->deleteFileQuietly($newPath);
            }

            Log::error('Gagal memperbarui foto profil', [
                'user_id' => $user->id,
                'exception' => $e->getMessage(),
            ]);

            return $this->failed('Terjadi kesalahan saat menyimpan foto. Silakan coba lagi.');
        }
    }

    /**
     * Hapus foto profil: berkas fisik dan kolom di database.
     */
    public function destroy(Request $request): JsonResponse
    {
        $user = $request->user();

        if (blank($user->photo_path)) {
            // Bukan error yang perlu ditakuti - hasil akhirnya sama dengan yang
            // diminta (tidak ada foto), jadi dijawab sebagai sukses agar UI
            // tidak menampilkan pesan menakutkan untuk klik ganda.
            return response()->json([
                'ok' => true,
                'url' => null,
                'message' => 'Tidak ada foto profil untuk dihapus.',
            ]);
        }

        try {
            $path = $user->photo_path;

            $user->photo_path = null;
            $user->save();

            $this->deleteFileQuietly($path);

            return response()->json([
                'ok' => true,
                'url' => null,
                'message' => 'Foto profil berhasil dihapus.',
            ]);
        } catch (Throwable $e) {
            Log::error('Gagal menghapus foto profil', [
                'user_id' => $user->id,
                'exception' => $e->getMessage(),
            ]);

            return $this->failed('Terjadi kesalahan saat menghapus foto. Silakan coba lagi.');
        }
    }

    /**
     * Menghapus berkas tanpa membuat permintaan ikut gagal.
     *
     * Berkas yang sudah tidak ada bukan alasan untuk menggagalkan operasi -
     * tujuannya justru supaya berkas itu tidak ada.
     */
    private function deleteFileQuietly(string $path): void
    {
        try {
            Storage::disk('public')->delete($path);
        } catch (Throwable $e) {
            Log::warning('Berkas foto profil gagal dihapus', [
                'path' => $path,
                'exception' => $e->getMessage(),
            ]);
        }
    }

    private function failed(string $message): JsonResponse
    {
        return response()->json(['ok' => false, 'message' => $message], 500);
    }
}
