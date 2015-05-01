#!/usr/bin/php
<?php

if ( !isset($argv[1]) ) {
    e('Required argument');
}

if ( !file_exists($argv[1])) {
    e("File " . $argv[1] . " not found");
}

$arrtext = file($argv[1], FILE_SKIP_EMPTY_LINES);

// массив длин ячеек таблицы
$lentbl = array('0', '0', '0');

// массив элементов таблицы
$arrels = array();

foreach ($arrtext as $_s) {
    $arrstr = explode(',', preg_replace("/\s|'|\[|\]/", '', $_s));
    if ($arrstr[0] != '') {
        $arrels[] = $arrstr;
        // вычисляем длину ячеек таблицы
        for ($i=0; $i<3; $i++) {
            if ( strlen($arrstr[$i]) > $lentbl[$i] ) {
                $lentbl[$i] = strlen($arrstr[$i]);
            }
        }
    }
}

$j = 0;

// заполняем таблицу
foreach ($arrels as $_ae) {
    if ( $j == 0 ) {
        drawSolid($lentbl);
    }
    print('|');
    
    for ($i=0; $i<3; $i++) {
        print(' ' . $_ae[$i]);
        for ($c=strlen($_ae[$i]); $c<=$lentbl[$i]; $c++){
            print(' ');
        }
        print('|');
    }
    print ("\n");
    
    if ( $j == 0 || $j == count($arrels)-1 ) {
        drawSolid($lentbl);
    }
    
    $j++;
}

function drawSolid($lentbl)
{
    print('+');
    foreach ($lentbl as $_l) {
        for($i=0; $i<$_l+2; $i++) {
            print('-');
        }
        print('+');
    }
    print "\n";
}

function e($message) {
    print "ERROR: " . $message . "\n\n"; 
    exit;
}
