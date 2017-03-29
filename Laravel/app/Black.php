<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Black extends Model
{
    protected $fillable = [
        'name',
        'number'
    ];

    public function white(){
        return $this->hasOne('App\White');
    }

    public function manyWhites(){
        return $this->belongsToMany('App\White');
    }
}
