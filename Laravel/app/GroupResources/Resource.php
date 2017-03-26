<?php

namespace App\GroupResources;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    //protected $fillable = ['resourceables_id', 'resourceables_type'];

    /**
     * A Resource can have many Groups, and Groups can have many Resources.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function groups()
    {
        return $this->belongsToMany('App\GroupResources\Group');
    }

    /**
     * A resource should have a polymorphic relationship to another model
     * that you want to provide to the resource's groups.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function resourceable()
    {
        return $this->morphTo();
    }

}