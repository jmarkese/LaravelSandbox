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
        'name', 'numer', 'denom',
    ];

    public function left()
    {
        return new Rational($this->numer, $this->denom);
    }

    public function right()
    {
        $left = $this->left();
        for($i = 1; $i <= $left->den; $i++){
            if(($left->num * $i + 1) % $left->den === 0) {
                return new Rational(($left->num * $i + 1) / $left->den, $i);
            }
        }
    }

    public function parent()
    {
        $l = $this->left();
        $r = $this->right();
        $parent = new Rational($l->num - $r->num, $l->den - $r->den);
        return  Node::where('numer', $parent->num)->where('denom', $parent->den)->first();
    }

    public function insert(string $name)
    {
        $right = $this->right();
        $left = $this->left();

        do {
            $insert = $this->mediant($left, $right);
            $right = $insert;
            $node = Node::where('numer', $insert->num)->where('denom', $insert->den)->first();
        } while ($node);

        return (new Node(['name' => $name, 'numer' => $insert->num, 'denom' => $insert->den]))->save();
    }

    private function mediant(Rational $l, Rational $r)
    {
        return new Rational($l->num + $r->num, $l->den + $r->den);
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
}
