<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Green extends Model
{
    public function greenable(){
        return $this->morphTo();
    }

}
