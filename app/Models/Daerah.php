<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daerah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_daerah',
    ];

    // kode dibawah ini untuk relasi: satu daerah punya banyak sekolah
    public function sekolahs()
    {
        return $this->hasMany(Sekolah::class);
    }

}
