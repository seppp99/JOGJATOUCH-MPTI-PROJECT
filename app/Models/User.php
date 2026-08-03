<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements FilamentUser, HasName
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'whatsapp_number',
        'email',
        'password',
        'email_verified_at',
    ];

    /*
     * Catatan: 'photo_path' SENGAJA tidak dimasukkan ke $fillable. Kolom itu
     * hanya boleh diisi oleh ProfilePhotoController setelah berkasnya lolos
     * validasi dan benar-benar tersimpan, jadi ditulis eksplisit lewat
     * $user->photo_path = ... - bukan lewat mass assignment dari input.
     */

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Nama yang ditampilkan panel Filament.
     *
     * Dikembalikan email, bukan kolom `name`, supaya pill profil di topbar dan
     * judul di popup user menu sama-sama menampilkan identitas login. Filament
     * memanggil ini lewat FilamentManager::getUserName() (baris 614) hanya bila
     * model mengimplementasikan kontrak HasName - jadi satu method ini mengubah
     * kedua tempat sekaligus, tanpa menyunting view.
     *
     * Catatan: inisial avatar TIDAK ikut berubah karena override
     * resources/views/vendor/filament-panels/components/avatar/user.blade.php
     * mengambilnya dari kolom `name`, bukan dari method ini.
     */
    public function getFilamentName(): string
    {
        return $this->email;
    }

    /**
     * Apakah pengguna punya foto profil yang berkasnya benar-benar ada?
     *
     * Kolom database saja tidak cukup dijadikan patokan: berkasnya bisa hilang
     * (dihapus manual, storage dibersihkan, pindah server) sementara kolomnya
     * masih terisi. Tanpa pengecekan ini, UI akan menampilkan gambar rusak dan
     * tombol Edit/Hapus tetap aktif untuk berkas yang tidak ada.
     */
    public function hasProfilePhoto(): bool
    {
        return filled($this->photo_path) && Storage::disk('public')->exists($this->photo_path);
    }

    /**
     * URL foto profil, atau null bila tidak punya.
     *
     * Memakai asset() dan BUKAN Storage::url(): Storage::url() menyusun URL dari
     * APP_URL (di .env masih http://localhost), sehingga gambar akan gagal dimuat
     * saat aplikasi diakses lewat 127.0.0.1:8000. asset() mengikuti host request
     * yang sedang berjalan, jadi aman di semua kondisi.
     */
    public function profilePhotoUrl(): ?string
    {
        if (! $this->hasProfilePhoto()) {
            return null;
        }

        // Query string versi supaya browser tidak menampilkan foto lama dari
        // cache setelah pengguna mengganti fotonya.
        return asset('storage/'.$this->photo_path).'?v='.($this->updated_at?->timestamp ?? time());
    }

    /**
     * Inisial untuk avatar cadangan saat tidak ada foto.
     */
    public function initial(): string
    {
        return mb_strtoupper(mb_substr(trim((string) $this->name), 0, 1)) ?: '?';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isAdmin();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
