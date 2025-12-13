<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

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

    public function displayEmail(): string
    {
        $p = $this->profile();
        return (string) ($p->email ?? $this->username);
    }

    public function avatarUrl(): string
    {
        // pastikan relasi ada (kalau belum di-load, ini tetap bisa akses tapi bisa query berulang)
        $sa = $this->superadmin;
        $ad = $this->admin;
        $gr = $this->guru;
        $ot = $this->orangTua;

        // ===== AMBIL FOTO SESUAI ROLE =====
        // GANTI nama kolom di bawah kalau beda
        $foto =
            $sa->foto ?? null
            ?: $ad->foto ?? null
            ?: $gr->foto ?? null
            ?: $ot->foto ?? null;

        if (!$foto) {
            return asset('assets/media/avatars/blank.png');
        }

        // ===== NORMALISASI PATH =====
        $foto = ltrim($foto, '/');

        // kalau sudah URL
        if (str_starts_with($foto, 'http://') || str_starts_with($foto, 'https://')) {
            return $foto;
        }

        // kalau simpan "storage/xxx"
        if (str_starts_with($foto, 'storage/')) {
            return asset($foto);
        }

        // kalau simpan "public/xxx" (storage disk)
        if (str_starts_with($foto, 'public/')) {
            return asset(str_replace('public/', 'storage/', $foto));
        }

        // default: anggap tersimpan di storage/app/public/xxx
        return asset('storage/' . $foto);
    }

}
