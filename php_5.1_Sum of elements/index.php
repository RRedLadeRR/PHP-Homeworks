<?php
$numbers = [3.5, -2.75, 10.2, 0.8, -7.1, 4.6];

echo "<pre>";

echo "Array:\n";
print_r($numbers);

$minValue = min($numbers);
$maxValue = max($numbers);
$sum      = $minValue + $maxValue;

echo "\nMinimum: $minValue";
echo "\nMaximum: $maxValue";
echo "\nSum of min and max: $sum";

echo "</pre>";