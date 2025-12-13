<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    use HasFactory;

    protected $table = 'anaks';

    protected $fillable = [
        'sekolahs_id',
        'orang_tuas_id',
        'nik',
        'nisn',
        'nipd',
        'no_kk',
        'no_registrasi_kk',
        'nama_anak',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'foto',
        'tanggal_masuk',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_masuk' => 'date',
    ];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'sekolahs_id');
    }

    public function orangTua()
    {
        return $this->belongsTo(OrangTua::class, 'orang_tuas_id');
    }

    public function antropometris()
    {
        return $this->hasMany(Antropometri::class, 'anaks_id');
    }

    public function ddstTests()
    {
        return $this->hasMany(DdstTest::class);
    }
}
