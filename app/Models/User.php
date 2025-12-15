<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'password',
        'status',
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
            'password' => 'hashed',
        ];
    }

    // ===== RELATIONS =====
    public function admin()
    {
        return $this->hasOne(Admin::class, 'users_id');
    }

    public function superadmin()
    {
        return $this->hasOne(Superadmin::class, 'users_id');
    }

    public function guru()
    {
        return $this->hasOne(Guru::class, 'users_id');
    }

    public function orangTua()
    {
        return $this->hasOne(OrangTua::class, 'users_id');
    }

    // ===== HELPER: ambil profil role yang ada =====
    public function profile()
    {
        return $this->superadmin
            ?? $this->admin
            ?? $this->guru
            ?? $this->orangTua;
    }

    public function displayName(): string
    {
        $p = $this->profile();

        // superadmins/admins pakai "nama"
        if ($p && isset($p->nama))
            return (string) $p->nama;

        // gurus pakai "nama_guru"
        if ($p && isset($p->nama_guru))
            return (string) $p->nama_guru;

        // orang_tuas: gabungkan ayah/ibu (atau pilih salah satu)
        if ($p && (isset($p->nama_ayah) || isset($p->nama_ibu))) {
            return trim(($p->nama_ayah ?? '') . ' / ' . ($p->nama_ibu ?? ''));
        }

        return (string) $this->username;
    }

    public function displayJabatan(): string
    {
        $p = $this->profile();
        return (string) ($p->jabatan ?? $this->username);
    }


    public function avatarUrl(): string
    {
        $sa = $this->superadmin;
        $ad = $this->admin;
        $gr = $this->guru;
        $ot = $this->orangTua;

        $foto =
            ($sa->foto ?? null)
            ?: ($ad->foto ?? null)
            ?: ($gr->foto ?? null)
            ?: ($ot->foto ?? null);

        // fallback
        if (!$foto) {
            return asset('assets/media/foto/blank.png');
        }

        $foto = ltrim($foto, '/');

        // sudah URL
        if (Str::startsWith($foto, ['http://', 'https://'])) {
            return $foto;
        }

        // ===== FOTO DARI STORAGE (sesuai pola yang kamu pakai) =====
        if (
            Str::startsWith($foto, [
                'foto_guru/',
                'foto_admin/',
                'foto_superadmin/',
                'foto_orangtua/',
            ])
        ) {
            return asset('storage/' . $foto); // butuh php artisan storage:link
        }

        // ===== SELAIN ITU = PUBLIC (assets, images, dll) =====
        return asset($foto);
    }



}
