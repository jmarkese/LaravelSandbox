<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Red extends Model
{
    public function white(){
        return $this->belongsTo('App\White');
    }

    public function yellows(){
        return $this->hasMany('App\Yellow');
    }


}
