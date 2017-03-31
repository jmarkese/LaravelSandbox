<?php

namespace App\GroupResources;
use Illuminate\Database\Eloquent\Model;


class Node extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'numer', 'denom',
    ];

    /**
     * One sub Node, belongs to a Main Node ( Or Parent Node ).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('App\GroupResources\Node', 'parent_id');
    }

    public function ancestors()
    {
        return $this->parent()->with('ancestors');
    }

    /**
     * A Parent Node has many sub Nodes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany('App\GroupResources\Node', 'parent_id');
    }

    public function descendants()
    {
        return $this->children()->with('descendants');
    }

    public function tree()
    {
        return $this->parent()->children()->where();
    }





    public function xRational($numerIn, $denomIn)
    {
        $numer = $numerIn + 1;
        $denom = $denomIn * 2;

        while(floor($numer/2) == $numer/2){
            $numer /= 2;
            $denom /= 2;
        }

        return ['numer'=>$numer, 'denom'=>$denom];
    }

    public function yRational($numerIn, $denomIn)
    {
        $xRational = xRational($numerIn, $denomIn);
        $numer = $xRational['numer'];
        $denom = $xRational['denom'];

        while($denom < $denomIn){
            $numer *= 2;
            $denom *= 2;
        }

        return ['numer'=>($numerIn - $numer), 'denom'=>$denom];
    }

}