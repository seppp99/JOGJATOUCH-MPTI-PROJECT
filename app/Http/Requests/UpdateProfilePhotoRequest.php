<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfilePhotoRequest extends FormRequest
{
    /**
     * Batas ukuran berkas dalam kilobyte.
     *
     * Dipublikasikan sebagai konstanta supaya sisi klien bisa memakai angka yang
     * sama (disuntikkan ke Blade), sehingga pengguna ditolak lebih awal dengan
     * pesan yang ramah alih-alih menunggu unggahan besar gagal di server.
     */
    public const MAX_KILOBYTES = 4096; // 4 MB

    public function authorize(): bool
    {
        // Rute sudah dijaga middleware 'auth'; di sini cukup memastikan memang
        // ada pengguna yang login.
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'photo' => [
                'required',
                'file',
                // `image` menolak berkas yang hanya BERNAMA .jpg tetapi isinya
                // bukan gambar - pengecekan berbasis isi, bukan ekstensi.
                'image',
                'mimes:jpeg,jpg,png',
                'max:'.self::MAX_KILOBYTES,
                // Batas dimensi mencegah "bom dekompresi": berkas kecil yang
                // memuai jadi ratusan megabyte saat diproses.
                'dimensions:min_width=100,min_height=100,max_width=6000,max_height=6000',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'photo.required' => 'Tidak ada gambar yang dikirim.',
            'photo.file' => 'Data yang dikirim bukan berkas yang valid.',
            'photo.image' => 'Berkas yang dikirim bukan gambar.',
            'photo.mimes' => 'Format foto harus PNG, JPG, atau JPEG.',
            'photo.max' => 'Ukuran foto maksimal '.(self::MAX_KILOBYTES / 1024).' MB.',
            'photo.dimensions' => 'Dimensi gambar tidak wajar (minimal 100x100 piksel, maksimal 6000x6000 piksel).',
        ];
    }
}
