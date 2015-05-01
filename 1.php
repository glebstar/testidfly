#!/usr/bin/php
<?php

if ( !isset($argv[1]) ) {
    e('Required argument');
}

$teststr = str_replace('"', '', $argv[1]);
$arrstr  = str_split($teststr);

$validchars = array('{', '(', '[', ']', ')', '}');
$correctcoups = array(
    '{}',
    '[]',
    '()'
);

foreach ($arrstr as $_a) {
    if ( !in_array($_a, $validchars) ) {
        e('Incorrect character ' . $_a);
    }
}

$strlen = strlen($teststr);
if ( !is_int($strlen/2) ) {
    e('Incorrect string length');
}

$j = $strlen-1;
$incorrect = true;

for ($i = 0; $i<=$strlen/2-1; $i++) {
    $coup = $arrstr[$i] . $arrstr[$j];
    $incorrect = true;
    
    foreach ($correctcoups as $_cc) {
        if ( $_cc == $coup) {
            $incorrect = false;
        }
    }
    
    if ( $incorrect ) {
        e('Incorrect string');
    }
    
    $j--;
}


e('Correct string', 'Ok');

function e($message='', $result='Err') {
    if ($result == 'Err') {
        print "ERROR: " . $message . "\n\n"; 
    } else {
        print "OK\n" . $message . "\n\n";
    }
    exit;
}
