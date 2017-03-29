<?php
$one = 0xFFFFFFFF;
$one_one = 0x0000FFFF;
$one_two = 0xFFFF0000;


show( dechex((int) sqrt($one)) );
show( dechex((int) sqrt($one_one)) );
show( dechex((int) sqrt($one_two)) );



function show ($thing){
    echo $thing."\n";
}