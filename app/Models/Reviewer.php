<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviewer extends Model
{
    //
    protected $fillable = ['nama'];

    public function ddstTests()
    {
        return $this->hasMany(\App\Models\DdstTest::class, 'reviewers_id');
    }

}
