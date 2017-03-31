<?php

print_r (xRational(39, 32)).PHP_EOL;
print_r (yRational(39, 32)).PHP_EOL;
print_r (parent(27,32)).PHP_EOL;
echo 'sib: ';
echo siblingNumber(7,8).PHP_EOL;
echo 'sib: ';
echo siblingNumber(15,16).PHP_EOL;
echo 'sib: ';
echo siblingNumber(27,32).PHP_EOL;
echo 'sib: ';
echo siblingNumber(3,4).PHP_EOL;
echo getPath(15,16).PHP_EOL;
echo distance(27,32,3,4).PHP_EOL;
echo distance(7,8,3,4).PHP_EOL;
print_r (child(3,2,3)).PHP_EOL;
print_r (child(1,1,1)).PHP_EOL;
print_r (encodePath('2.1.3')).PHP_EOL;



function xRational($numerIn, $denomIn)
{
    $numer = $numerIn + 1;
    $denom = $denomIn * 2;

    while(floor($numer/2) == (int) $numer/2){
        $numer = (int) $numer / 2;
        $denom = (int) $denom / 2;
    }

    return ['numer'=>$numer, 'denom'=>$denom];
}

function yRational($numerIn, $denomIn)
{
    $xRational = xRational($numerIn, $denomIn);
    $numer = $xRational['numer'];
    $denom = $xRational['denom'];

    while($denom < $denomIn){
        $numer *= 2;
        $denom *= 2;
    }

    return ['numer'=>($numerIn - $numer), 'denom'=>$denom];
}


function parent($numerIn, $denomIn)
{
    if($numerIn == 3){
        return null;
    }

    $numer = (int) ($numerIn - 1) / 2;
    $denom = (int) $denomIn / 2;

    while(floor(($numer - 1) / 4) == ($numer - 1) / 4){
        $numer = ($numer + 1) / 2;
        $denom /= 2;
    }

    return ['numer'=>$numer, 'denom'=>$denom];
}

function siblingNumber($numerIn, $denomIn)
{
    if($numerIn == 3){
        return null;
    }

    $numer = (int) ($numerIn - 1) / 2;
    $denom = (int) $denomIn / 2;
    $num = 1;

    while(floor(($numer - 1) / 4) == ($numer - 1) / 4){
        if($numer == 1 && $denom == 1){
            return $num;
        }
        $numer = (int) ($numer + 1) / 2;
        $denom = (int) $denom / 2;
        echo $num++.'|';
    }

    return $num;
}

function getPath($numerIn, $denomIn)
{
    if(is_null($numerIn)){
        return '';
    }
    $parent = parent($numerIn, $denomIn);
    return getPath($parent['numer'], $parent['denom']).'.'.siblingNumber($numerIn, $denomIn);
}

function distance($numerA, $denomA, $numerB, $denomB)
{
    if(is_null($numerA)){
        throw new Exception('The rational '.$numerA.'/'.$denomA.' is not a child of the parent '.$numerB.'/'.$denomB.' ');
    }
    if ($numerA == $numerB && $denomA == $denomB){
        return 0;
    }
    $parent = parent($numerA, $denomA);
    return 1 + distance($parent['numer'], $parent['denom'], $numerB, $denomB);
}

function child($numerIn, $denomIn, $child)
{
    $numer = $numerIn * pow(2, $child) + 3 - pow(2, $child);
    $denom = $denomIn * pow(2, $child);
    return ['numer'=>$numer, 'denom'=>$denom];
}

function encodePath($path)
{
    $numer = 1;
    $denom = 1;
    $postfix = '.'.$path.'.';

    while(strlen($postfix) > 1){
        $sibling = substr($postfix, 1, strpos($postfix, '.', 1) - 1);
        $postfix = substr($postfix, strpos($postfix, '.', 1), strlen($postfix) - strpos($postfix, '.', 1));
        $child = child($numer, $denom, $sibling);
    }

    return $child;
}