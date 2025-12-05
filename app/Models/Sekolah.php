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
        return $this->belongsTo(Daerah::class);
    }

    public function gurus()
    {
        return $this->hasMany(Guru::class);
    }

    public function anaks()
    {
        return $this->hasMany(Anak::class, 'sekolahs_id');
    }
}
