<?php

$nilai = "72 65 73 78 75 74 90 81 87 65 55 69 72 78 79 91 100 40 67 77 86";

function parseStrToArray(string $str): array
{
  $arr = explode(' ', $str);

  return $arr;
}

function average(array $arr): int
{
  $count = count($arr);
  $arrSum = array_sum($arr);

  return $arrSum / $count;
}

function sortMax(array $arr): string
{
  rsort($arr);
  $arrSliced = array_slice($arr, 0, 7);

  return implode(', ', $arrSliced);
}

function sortMin(array $arr): string
{
  sort($arr);
  $arrSliced = array_slice($arr, 0, 7);

  return implode(', ', $arrSliced);
}

echo "Nilai rata - rata : " . average(parseStrToArray($nilai)) . PHP_EOL;
echo "Nilai tertinggi : " . sortMax(parseStrToArray($nilai)) . PHP_EOL;
echo "Nilai terendah : " . sortMin(parseStrToArray($nilai)) . PHP_EOL;
