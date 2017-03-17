<?php

function setLengthTo5($val){
    if(strlen($val) < 5){
        while (strlen($val) < 5){
            $val .= ' ';
        }
    }

    return $val;
}
//hello!
for($i = 1; $i < 10; $i++) {
    for ($j = 1; $j < 10; $j++) {
        echo setLengthTo5($i * $j);
    }

    echo "\n";
}
