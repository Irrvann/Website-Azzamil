<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    use HasFactory;

    protected $table = 'orang_tuas';

    protected $fillable = [
        'users_id',
        'nama_ayah',
        'nama_ibu',
        'no_hp_ayah',
        'no_hp_ibu',
        'alamat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function anaks()
    {
        return $this->hasMany(Anak::class, 'orang_tuas_id');
    }
}
