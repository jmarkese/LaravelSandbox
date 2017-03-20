<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class White extends Model
{
    public function reds(){
        return $this->hasMany('App\Red');
    }

    public function yellow(){
        return $this->hasOne('App\Yellow');
    }

    public function greens(){
        return $this->morphMany('App\Green', 'greenable');
    }

    public function cyans(){
        return $this->hasMany('App\Cyan');
    }

    public function blues(){
        return $this->hasMany('App\Blue');
    }

    public function magentas()
    {
        return $this->morphToMany('App\magenta', 'magentables');
    }

    public function black(){
        return $this->belongsTo('App\Black');
    }

    public function manyBlacks(){
        return $this->belongsToMany('App\Black');
    }

    public function grey(){
        return $this->belongsTo('App\Grey');
    }

}
