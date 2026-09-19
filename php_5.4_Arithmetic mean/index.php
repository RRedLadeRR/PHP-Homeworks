<?php
// Середне арифметичне
$numbers = [12, 45, 7, 23, 89, 34, 16];

echo "<pre>";

echo "Array:\n";
print_r($numbers);

$sum     = array_sum($numbers);
$count   = count($numbers);
$average = $sum / $count;

echo "\nSum: $sum";
echo "\nCount: $count";
echo "\nArithmetic mean: $average";

echo "</pre>";