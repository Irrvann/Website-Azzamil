<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DdstTestItem extends Model
{
    use HasFactory;

    protected $table = 'ddst_test_items';

    protected $fillable = [
        'ddst_tests_id',
        'ddst_items_id',
        'status',
        'keterangan',
    ];

    public function ddstTest()
    {
        return $this->belongsTo(DdstTest::class, 'ddst_tests_id');
    }

    public function ddstItem()
    {
        return $this->belongsTo(DdstItem::class, 'ddst_items_id');
    }
}
