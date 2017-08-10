<?php

const LIMIT = 9999;


timeFunction('sumFactors');

function sumFactors ()
{
    $sum = 0;
    for ($a = 5, $b = 7, $c = 11; $a <= LIMIT; $a += 5, $b += 7, $c += 11) {
        $sum += $a;
        $sum += ($b <= LIMIT && $b % 5) ? $b : 0;
        $sum += ($c <= LIMIT && $c % 5 && $c % 7) ? $c : 0;
    }
    return $sum;
}

function timeFunction(callable $function){
    $start = microtime(true);
    $result = $function();
    $time = (microtime(true) - $start);
    echo sprintf("%d (Execution Time: %f)".PHP_EOL, $result, $time);
}


/*
timeFunction('slow');
timeFunction('optimized');
timeFunction('exactlyOnce');
timeFunction('exactlyOnceArray'); // this one is actually slower than the exactlyOnce straight loop due to array overhead
function slow ()
{
    $sum = 0;
    for ($i = 1; $i <= LIMIT; $i++) {
        if ( $i % 5 === 0 ) {
            $sum += $i;
        }
        if ( $i % 7 === 0) {
            $sum += $i;
        }
        if ( $i % 11 === 0 ) {
            $sum += $i;
        }
    }
    return $sum;
}

function optimized ()
{
    $sum = 0;
    foreach ([5, 7 ,11] as $x) {
        $sum += getSumFactorsOfX($x, LIMIT);
    }
    return $sum;
}


function exactlyOnce ()
{
    $sum = 0;
    for ($i = 1; $i <= LIMIT; $i++) {
        if (( $i % 5 === 0 ) || ( $i % 7 === 0 ) || ( $i % 11 === 0 )) {
            $sum += $i;
        }
    }
    return $sum;
}


function exactlyOnceArray()
{
    $factors = [];
    foreach ([5, 7 ,11] as $x) {
        setArrayFactorsOfX($factors, $x, LIMIT);
    }
    return array_sum(array_keys($factors));
}


function setArrayFactorsOfX(&$factors, $x, $limit)
{
    for ($i = 0; $i <= $limit; $i += $x) {
        $factors[$i] = true;
    }
}

function getSumFactorsOfX($x, $limit)
{
    $sum = 0;
    for ($i = 0; $i <= $limit; $i += $x) {
        $sum += $i;
    }
    return $sum;
}
*/

