<?php

//$find = 'abc';
//$line = 'aabcc';
//echo output(1, countString($find, $line));
//
//$find = 'aabc';
//$line = 'aabcc';
//echo output(1, countString($find, $line));

$file = new SplFileObject('sequences.txt');
$find = 'join the nmi team';

while (!$file->eof()) {
    $line = $file->fgets();
    echo output(++$i, countString($find, $line));
}

$file = null;

function countString($find, $line)
{
    $strlen = strlen($find);
    $counter = array_fill(0, $strlen, 0);
    $charIndices = getCharIndices($find);

    foreach (str_split($line) as $k => $ch) {
        if (!isset($charIndices[$ch])) {
            continue;
        }

        foreach ($charIndices[$ch] as $i) {
            if ($i === 0) {
                $counter[0] += 1;
            } else {
                $counter[$i] += $counter[$i - 1];
            }
        }
    }

    return $counter[$strlen - 1];
}

function getCharIndices($str)
{
    $indices = array_fill_keys(str_split($str), []);
    foreach (str_split($str) as $k => $ch) {
        array_unshift($indices[$ch], $k);
    }
    return $indices;
}

function output($l, $n)
{
    $n = sprintf("%u", $n);
    $n = substr($n, -5);
    return sprintf("Line %d: %05.5s\n", $l, $n);
}

