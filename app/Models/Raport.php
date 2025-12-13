<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raport extends Model
{
    use HasFactory;

    protected $fillable = [
        'anak_id',
        'guru_id',
        'sekolah_id',
        'semester',
        'tahun_ajaran',
        'berat_badan',
        'tinggi_badan',
        'nilai_agama',
        'nilai_jati_diri',
        'nilai_literasi_sains',
        'nilai_p5',
        'refleksi_guru',
        'refleksi_orang_tua',
        'sakit',
        'izin',
        'tanpa_keterangan',
    ];

    // Relasi ke Anak
    public function anak()
    {
        return $this->belongsTo(Anak::class, 'anak_id');
    }

    // Relasi ke Guru
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    // Relasi ke Sekolah
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id');
    }

    public function fotos()
    {
        return $this->hasMany(RaportFoto::class);
    }

    public function fotosAgama()
    {
        return $this->hasMany(RaportFoto::class)->where('komponen', 'agama');
    }

    public function fotosJatiDiri()
    {
        return $this->hasMany(RaportFoto::class)->where('komponen', 'jati_diri');
    }

    public function fotosLiterasiSains()
    {
        return $this->hasMany(RaportFoto::class)->where('komponen', 'literasi_sains');
    }

    public function fotosP5()
    {
        return $this->hasMany(RaportFoto::class)->where('komponen', 'p5');
    }

}
