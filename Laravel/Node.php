<?php
class Node
{


    private $left;

    public function __construct($num, $den)
    {
        $this->left = new Rational($num, $den);
    }

    public function right(Rational $left=null)
    {
        $left = $left ?: $this->left;
        for($i = 1; $i <= $left->den; $i++){
            if(($left->num * $i + 1) % $left->den === 0) {
                return new Rational(($left->num * $i + 1) / $left->den, $i);
            }
        }
    }

    public function insertChild(Rational $l, string $name)
    {
        $left = $this->mediant($l, $this->right($l));


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


function mediant(Rational $l, Rational $r)
{
    return new Rational($l->num + $r->num, $l->den + $r->den);
}

function compareRationals(Rational $a, Rational $b)
{
    return $a->compare($b);
}

function right(Rational $left)
{
    for($i = 1; $i <= $left->den; $i++){
        if(($left->num * $i + 1) % $left->den === 0) {
            return new Rational(($left->num * $i + 1) / $left->den, $i);
        }
    }
}


$r1 = new Rational(1,2);
$r2 = new Rational(3,4);
$r3 = mediant($r1, $r2);
$r4 = new Rational(5,7);
$r5 = right($r4);

echo $r1. PHP_EOL .$r2. PHP_EOL .$r3. PHP_EOL .$r4. PHP_EOL .$r5. PHP_EOL;



