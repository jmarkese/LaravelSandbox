<?php
/*

For example, the following sequence contains four occurrences of the string "abc"

Sequence "aabcc"
Occurrences
aabcc
aabcc
aabcc
aabcc

*/

//$strin = 'abc';
$strin = 'abc';
//$strin = 'join the nmi team';

$haystack = 'aabcc';
//$haystack = 'abcabc';
//$haystack = 'aabcbcc';
//$haystack = 'afdsafdsbfdscfdsbfdscfdsc';
//$haystack = 'oinj oin the nmi team';
//$haystack = 'jjooiinn  tthhe nmi abcd team';

echo output(3, countString($strin, $haystack));

function countString($find, $line) {
    $strlen = strlen($find);
    $counter = array_fill(0, $strlen, 0);

    foreach (str_split($line) as $ch) {
        $pos = stripos($find, $ch);
        if ($pos === false) {
            continue;
        } else if ($pos === 0) {
            $counter[0] += 1;
        } else {
            $counter[$pos] += $counter[$pos - 1];
        }
    }

    return $counter[$strlen - 1];
}


function output($l, $n) {
    return sprintf("Line %d: %05d\n", $l, $n);
}







$strin = 'aabc';
$haystack = 'aabcc';

echo output(3, countString2($strin, $haystack));

function countString2($find, $line) {
    $strlen = strlen($find);
    $counter = array_fill(0, $strlen, 0);

    foreach (str_split($line) as $k => $ch) {
        $pos = stripos($find, $ch);
        if ($pos === false) {
            continue;
        } else if ($pos === 0) {
            $counter[0] += 1;
        } else {
            $counter[$pos] += $counter[$pos - 1];
        }
    }

    var_dump($counter);
    return $counter[$strlen - 1];
}
