<?php

namespace App\GroupResources;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * One sub Group, belongs to a Main Group ( Or Parent Group ).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('App\GroupResources\Group', 'parent_id');
    }


    /**
     * A Parent Group has many sub Groups
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany('App\GroupResources\Group', 'parent_id');
    }


    /**
     * A Group can have many Users, and Users can have many Groups.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * A Group can have many Resources, and Resources can have many Groups.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function resources()
    {
        return $this->belongsToMany('App\GroupResources\Resource');
    }

    /**
     * A Group might have a polymorphic relationship to another model
     * that contains more attributes pertaining to that group.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function groupable()
    {
        return $this->morphTo();
    }

}