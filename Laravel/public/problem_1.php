<?php
$file = new SplFileObject('product_costs.txt');

$i = 0 ;
while (!$file->eof()) {
    $line = $file->fgets();
    $params = explode(" ",$line);
    echo sprintf("Line %d: %f".PHP_EOL, ++$i, calcPrice($params[0], $params[1], 0));
}

$file = null;

function calcPrice($c, $f, $g)
{
    // 20.00 (P) - 20 (P) * 0.10 (F) - 10.00 (C) = $8.00
    // P - F * P - C = G
    // P * (1 - F) = C + G
    // P = (C + G) / (1 - F)

    return ($c + $g) / (1 - $f);
}
