<?php

function countLowercase (string $str): int {
  return preg_match_all('/[a-z]/', $str);
}

echo "Masukkan string : ";

$str = trim(fgets(STDIN));
$count = countLowercase($str);

echo "output : {$str} mengandung {$count} buah huruf kecil." . PHP_EOL;