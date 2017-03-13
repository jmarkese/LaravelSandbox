<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Yellow extends Model
{
    public function white(){
        return $this->belongsTo('App\White');
    }

    public function red(){
        return $this->belongsTo('App\Red');
    }

}
