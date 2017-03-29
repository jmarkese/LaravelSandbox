<?php

namespace App\GroupResources;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'parent_id', 'numer_l', 'denom_l', 'numer_r', 'denom_r', 'interval', 'groupables_id', 'groupables_type',
    ];

    /**
     * One sub Group, belongs to a Main Group ( Or Parent Group ).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('App\GroupResources\Group', 'parent_id');
    }

    public function ancestors()
    {
        return $this->parent()->with('ancestors');
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

    public function descendants()
    {
        return $this->children()->with('descendants');
    }

    public function tree()
    {
        return $this->parent()->children()->where();
    }




    public function insertNode()
    {
        return (Group::where()) ? : $this->nextChild();

    }

    private function nextChild()
    {

    }



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