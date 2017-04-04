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
        'parent_id', 'name', 'numer', 'denom', 'interval_l', 'interval_r'
    ];

    public function parent()
    {
        return $this->belongsTo('App\GroupResources\Node', 'parent_id');
    }
    /*public function parent()
    {
        $l = $this->left();
        $r = $this->right();
        $parent = new Rational($l->num - $r->num, $l->den - $r->den);
        return Node::where('numer', $parent->num)->where('denom', $parent->den)->first();
    }*/

    public function ancestors()
    {
        return $this->parent()->with('ancestors');
    }

    public function children()
    {
        return $this->hasMany('App\GroupResources\Node', 'parent_id');
    }

    public function descendants()
    {
        return $this->children()->with('descendants');
    }

    public function subSet()
    {
        return Node::query()
            ->where('interval_l', '>=', $this->interval_l)
            ->where('interval_r', '<=', $this->interval_r)
            ->get();
    }

    public function insertNode(string $name)
    {
        $right = $this->right();
        $left = $this->left();

        do {
            $insert = $left->mediant($right);
            $right = $insert;
            $node = Node::where('numer', $insert->num)->where('denom', $insert->den)->first();
        } while ($node);

        $right = $this->right($insert);

        $node = new Node([
            'parent_id' => $this->id,
            'name' => $name,
            'numer' => $insert->num,
            'denom' => $insert->den,
            'interval_l' => (int) (PHP_INT_MAX / $insert->den) * $insert->num,
            'interval_r' => (int) (PHP_INT_MAX / $right->den) * $right->num
        ]);

        $node->save();
        return $node;
    }

    public function depth()
    {
        if($this->numer == 0 && $this->denom == 1){
            return 0;
        } else {
            return $this->parent->depth() + 1;
        }
    }

    private function left()
    {
        return new Rational($this->numer, $this->denom);
    }

    private function right(Rational $left=null)
    {
        $left = $left ?: $this->left();
        for($i = 1; $i <= $left->den; $i++){
            if(($left->num * $i + 1) % $left->den === 0) {
                return new Rational(($left->num * $i + 1) / $left->den, $i);
            }
        }
    }
}

class Rational
{
    public $num;
    public $den;

    public function __construct($num, $den)
    {
        $this->num = $num / $this->gcd($num, $den);
        $this->den = $den / $this->gcd($num, $den);
    }

    public function __toString()
    {
        return $this->num . '/' . $this->den;
    }

    public function mediant(Rational $that)
    {
        return new Rational($this->num + $that->num, $this->den + $that->den);
    }

    public function compare(Rational $that)
    {
        $cmp = ($this->num * $that->den) - ($this->den * $that->num);

        if ($cmp > 0){
            return 1;
        } else if ($cmp < 0){
            return -1;
        } else {
            return 0;
        }
    }

    private function gcd($a, $b)
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
}
