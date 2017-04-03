<?php
class Node
{
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
}

class Rational
{
    private $num;
    private $den;

    public function __construct(int $num, int $den)
    {
        $this->num = $num / $this->gcd($num, $den);
        $this->den = $den / $this->gcd($num, $den);
    }

    public function __toString()
    {
        return $this->num . '/' . $this->den;
    }

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

    public


}