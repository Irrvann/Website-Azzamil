<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DdstItem extends Model
{
    use HasFactory;

    protected $table = 'ddst_items';

    protected $fillable = [
        'kategori_perkembangan',
        'nama_item',
        'min_bulan',
        'max_bulan',
        'catatan',
    ];

    public function testItems()
    {
        return $this->hasMany(DdstTestItem::class, 'ddst_items_id');
    }
}
