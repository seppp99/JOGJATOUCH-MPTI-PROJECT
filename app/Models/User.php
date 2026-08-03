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
