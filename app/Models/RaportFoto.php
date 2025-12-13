<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaportFoto extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'raport_id',
        'komponen',
        'foto',
    ];

    public function raport()
    {
        return $this->belongsTo(Raport::class);
    }
}
