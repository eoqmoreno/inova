<?php
echo formatMoney(1000000321435.4, true); # 1,321,435.40


function formatMoney2($number, $fractional=false) {
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
	$number = str_replace('.',',',$number);

    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d

\d)/', '$1.$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
} 

function formatMoney($number, $fractional=false) { 
    if ($fractional) { 
        $number = sprintf('%.2f', $number); 
    } 
	$number = str_replace('.',',',$number);
    while (true) { 
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1.$2', $number); 
        if ($replaced != $number) { 
            $number = $replaced; 
        } else { 
            break; 
        } 
    } 
    return $number; 
} 

?>