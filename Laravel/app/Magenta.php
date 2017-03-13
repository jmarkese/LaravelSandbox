<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Magenta extends Model
{
    public function whites()
    {
        return $this->morphedByMany('App\White', 'magentables');
    }
 }
