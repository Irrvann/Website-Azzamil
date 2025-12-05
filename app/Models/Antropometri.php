<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antropometri extends Model
{
    use HasFactory;

    protected $table = 'antropometris';

    protected $fillable = [
        'anaks_id',
        'tanggal_ukur',
        'tinggi_badan',
        'berat_badan',
        'lingkar_kepala',
    ];

    protected $casts = [
        'tanggal_ukur' => 'date',
        'tinggi_badan' => 'float',
        'berat_badan' => 'float',
        'lingkar_kepala' => 'float',
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'anaks_id');
    }
}
