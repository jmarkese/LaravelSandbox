<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Red extends Model
{
    public function white(){
        return $this->belongsTo('App\White');
    }

    public function users(){
        return $this->hasMany('App\User');
    }

    public function yellows(){
        return $this->hasMany('App\Yellow');
    }


}
