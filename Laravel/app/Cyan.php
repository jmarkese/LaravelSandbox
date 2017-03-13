<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cyan extends Model
{
    public function white(){
        return $this->belongsTo('App\White');
    }

    public function blues(){
        return $this->belongsToMany('App\Blues');
    }
}
