<?php

function parseStrToArray(string $str): array
{
  $arr = explode(' ', $str);

  return $arr;
}

function nGram(array $arr, int $n = 1): string
{
  $chunk = array_chunk($arr, $n);

  $arrGram = array_map(function ($val) {
    return implode(' ', $val);
  }, $chunk);

  return implode(', ', $arrGram);
}

function unigram(array $arr): string
{
  $unigram = implode(', ', $arr);

  return "Unigram : {$unigram}";
}

function bigram(array $arr): string
{
  $bigram  = nGram($arr, 2);

  return "Bigram : {$bigram}";
}

function trigram(array $arr): string
{
  $bigram  = nGram($arr, 3);

  return "Trigram : {$bigram}";
}

echo "Masukkan string : ";

$str = trim(fgets(STDIN));

echo unigram(parseStrToArray($str)) . PHP_EOL;
echo bigram(parseStrToArray($str)) . PHP_EOL;
echo trigram(parseStrToArray($str)) . PHP_EOL;
