<?php

namespace App\GroupResources;

class Group extends Node
{
    use NodeTrait;

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
