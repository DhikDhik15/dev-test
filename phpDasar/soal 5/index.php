<?php

echo "Masukkan string : ";

$str = trim(fgets(STDIN));

function _encrypt(string $str)
{
  return caesharChipper($str, 1);
}

function _decrypt(string $str)
{
  return caesharChipper($str, -1);
}

function caesharChipper(string $str, int $shift = 1): string
{
  $chipper = '';

  foreach (str_split($str) as $char) {
    $chipper .= shiftChar($char, $shift);

    if ($shift > 0) {
      $shift++;
    } else {
      $shift--;
    }

    $shift *= -1;
  }

  return $chipper;
}

function shiftChar(string $char, int $shift): string
{
  $shift = $shift % 25;
  $ascii = ord($char);
  $shifted = $ascii + $shift;

  if ($ascii >= 65 && $ascii <= 90) {
    return chr(shiftUppercase($shifted));
  }

  if ($ascii >= 97 && $ascii <= 122) {
    return chr(shiftLowercase($shifted));
  }

  return chr($ascii);
}

function shiftUppercase(int $ascii): int
{
  if ($ascii < 65) {
    $ascii = 91 - (65 - $ascii);
  }

  if ($ascii > 90) {
    $ascii = ($ascii - 90) + 64;
  }

  return $ascii;
}

function shiftLowercase(int $ascii): int
{
  if ($ascii < 97) {
    $ascii = 123 - (97 - $ascii);
  }

  if ($ascii > 122) {
    $ascii = ($ascii - 122) + 96;
  }

  return $ascii;
}

$encrypted = _encrypt($str);
$decrypted = _decrypt($encrypted);

echo "String : " . $str . PHP_EOL;
echo "Encrypted : " . $encrypted . PHP_EOL;
echo "Decrypted : " . $decrypted . PHP_EOL;
