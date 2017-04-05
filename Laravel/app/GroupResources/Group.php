<?php

namespace App\GroupResources;
use Illuminate\Database\Eloquent\Model;

class Group extends Node
{
    //use Node;

    protected $table = "nodes";

    //protected $fillable = ['name', 'tree_id', 'parent_id', 'numer', 'denom', 'interval_l', 'interval_r'];

    /**
     * A Group can have many Users, and Users can have many Groups.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function users()
    {
        return $this->morphedByMany('App\User', 'groupable');
    }

    /**
     * A Group
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function whites()
    {
        return $this->morphedByMany('App\White', 'groupable');
    }


}
