<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grey extends Model
{
    public function whites(){
        return $this->hasMany('App\White');
    }
}
