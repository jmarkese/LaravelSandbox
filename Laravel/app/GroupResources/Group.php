<?php

namespace App\GroupResources;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use NodeTrait;
    protected $table = 'nodes';

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
