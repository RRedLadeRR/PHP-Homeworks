<?php
$numbers = [3.5, -2.75, 10.2, 0.8, -7.1, 4.6];

echo "<pre>";

echo "Original array:\n";
var_dump($numbers);

$reversed = array_reverse($numbers);

echo "\nReversed array:\n";
var_dump($reversed);

echo "</pre>";