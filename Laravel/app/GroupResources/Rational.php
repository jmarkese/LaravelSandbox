<?php

namespace app\GroupResources;

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
