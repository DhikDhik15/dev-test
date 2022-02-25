<?php

$arr = [
  ['f', 'g', 'h', 'i'],
  ['j', 'k', 'p', 'q'],
  ['r', 's', 't', 'u']
];

function cari(array $arrays, string $str): bool
{
  $arrStr = str_split($str);
  $arraysIndex = 0;

  $arrMatches = [];

  foreach ($arrays as $index => $array) {
    $arraysIndex = $index;
    foreach ($arrStr as $str) {
      if (($arrayIndex = array_search($str, $array)) !== false) {
        $arrMatches[] = [
          'str' => $str,
          'arraysIndex' => $arraysIndex,
          'arrayIndex' => $arrayIndex,
          'arrayLength' => count($array),
        ];
      }
    }
  }

  $point = 0;

  if (count(array_count_values(array_column($arrMatches, 'arraysIndex'))) === 1) {
    $point = count(array_unique($arrMatches, SORT_REGULAR));
  } else {
    foreach (array_unique($arrMatches, SORT_REGULAR) as $arrMatch) {
      if ($arrMatch["arrayIndex"] !== ($arrMatch["arrayLength"] - 1)) {
        $point += 1;
      }
    }
  }

  if ($point > 3) {
    return true;
  }

  return false;
}

echo "cari(\$arr, 'fghi') : " . (cari($arr, 'fghi') ? 'true' : 'false') . PHP_EOL; // true
echo "cari(\$arr, 'fst') : " . (cari($arr, 'fst') ? 'true' : 'false') . PHP_EOL; // false
echo "cari(\$arr, 'fghp') : " . (cari($arr, 'fghp') ? 'true' : 'false') . PHP_EOL; // true
echo "cari(\$arr, 'pqr') : " . (cari($arr, 'pqr') ? 'true' : 'false') . PHP_EOL; // false
echo "cari(\$arr, 'fjrstp') : " . (cari($arr, 'fjrstp') ? 'true' : 'false') . PHP_EOL; // true
echo "cari(\$arr, 'fghh') : " . (cari($arr, 'fghh') ? 'true' : 'false') . PHP_EOL; // false
echo "cari(\$arr, 'fghq') : " . (cari($arr, 'fghq') ? 'true' : 'false') . PHP_EOL; // false