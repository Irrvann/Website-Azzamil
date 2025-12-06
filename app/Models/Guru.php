<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'sekolahs_id',
        'nik',
        'nipa',
        'nama_guru',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'jabatan',
        'alamat',
        'email',
        'no_hp',
        'pend_terakhir',
        'jurusan',
        'tanggal_masuk',
        'foto',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_masuk' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'sekolahs_id');
    }

    public function ddstTests()
    {
        return $this->hasMany(DdstTest::class);
    }
}
