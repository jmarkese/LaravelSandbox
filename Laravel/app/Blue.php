<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blue extends Model
{
    public function white(){
        return $this->belongsTo('App\White');
    }

    public function cyans(){
        return $this->belongsToMany('App\Cyan');
    }

    public function users(){
        return $this->hasMany('App\User');
    }
}
