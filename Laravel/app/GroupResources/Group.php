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


    public function nextSibling() // Dyadic
    {
        $next['numer_l'] = 2 * $this->numer_l + 1;
        $next['denom_l'] = 2 * $this->denom_l;
        $next['numer_r'] = 2 * $this->numer_r + 1;
        $next['denom_r'] = 2 * $this->denom_r;
        return $next;
    }

    public function prevSibling() // Dyadic
    {
        if($this->firstChild()) {
            $prev['numer_l'] = $this->numer_l;
            $prev['denom_l'] = $this->denom_l;
            $prev['numer_r'] = $this->numer_r + 1;
            $prev['denom_r'] = $this->denom_r;
        } else {
            $prev['numer_l'] = $this->numer_l - 1;
            $prev['denom_l'] = $this->denom_l;
            $prev['numer_r'] = $this->numer_r - 1;
            $prev['denom_r'] = $this->denom_r;
        }
        return $prev;
    }

    public function firstChild() // Dyadic
    {

    }


    private function mediant($numer_l, $denom_l, $numer_r, $denom_r)
    {
        $numer_m = $numer_l + $numer_r;
        $denom_m = $denom_l + $denom_r;
        return ['numer'=>$numer_m,'denom'=>$denom_m];
    }


    /**
     * Greatest Common Denominator
     * @param int $a
     * @param int $b
     * @return int
     */
    private function gcd(int $a, int $b): int
    {
        if ($a === 0) {
            return $b;
        } else if ($b === 0) {
            return $a;
        } else if ($a > $b) {
            return $this->gcd(($a % $b), $b);
        } else {
            return $this->gcd($a, ($b % $a));
        }
    }




    public function insert(Group $child)
    {
        while(false) // check to see if next child id open
            $child->interval = $this->interval; //multipied by the next child rational number
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