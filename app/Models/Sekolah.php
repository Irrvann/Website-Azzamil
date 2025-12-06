<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;

    protected $fillable = [
        'daerahs_id',
        'nama_sekolah',
        'jenis_sekolah',
        'kelas',
    ];

    public function daerah()
    {
        return $this->belongsTo(Daerah::class, 'daerahs_id');
    }

    public function gurus()
    {
        return $this->hasMany(Guru::class, 'sekolahs_id');
    }

    public function anaks()
    {
        return $this->hasMany(Anak::class, 'sekolahs_id');
    }
}
