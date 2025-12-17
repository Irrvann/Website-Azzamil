<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DdstTest extends Model
{
    use HasFactory;

    protected $table = 'ddst_tests';

    protected $fillable = [
        'anaks_id',
        'gurus_id',
        'reviewers_id',
        'tanggal_test',
        'usia_bulan',
        'hasil_akhir',
        'antropometris_id',
        'semester',
        'tahun_ajaran',
        'interpretasi_ddst',
        'profile_dan_karakter_yang_dikenali_guru',
        'profile_dan_karakter_yang_dikenali_ortu',
        'saran_rujukan',
        'hasil_akhir',
    ];

    protected $casts = [
        'tanggal_test' => 'date',
        'usia_bulan' => 'integer',
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'anaks_id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'gurus_id');
    }

    public function items()
    {
        return $this->hasMany(DdstTestItem::class, 'ddst_tests_id');
    }

    public function antropometri()
    {
        return $this->belongsTo(Antropometri::class, 'antropometris_id');
    }

    public function fotos()
    {
        return $this->hasMany(DdstTestFoto::class, 'ddst_tests_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(Reviewer::class, 'reviewers_id');
    }

}
