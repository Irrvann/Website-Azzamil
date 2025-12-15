<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DdstTestFoto extends Model
{
    //
    protected $table = 'ddst_test_fotos';

    protected $fillable = [
        'ddst_tests_id',
        'foto',
        'caption',
    ];

    public function ddstTest()
    {
        return $this->belongsTo(DdstTest::class, 'ddst_tests_id');
    }
}
