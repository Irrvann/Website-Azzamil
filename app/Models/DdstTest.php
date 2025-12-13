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
        'tanggal_test',
        'usia_bulan',
        'hasil_akhir',
        'antropometris_id',
        'semester',
        'tahun_ajaran',
        'interpretasi_ddst',
        'tugas_belum_tercapai',
        'tugas_perlu_ditingkatkan',
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

}
