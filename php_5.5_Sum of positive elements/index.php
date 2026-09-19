<?php
$matrix = [
    [3.5, -2.1,  4.0, -0.5],
    [-7.2, 8.3,  0.0,  2.2],
    [1.1, -3.3,  5.5, -6.6],
];

echo "<pre>";

echo "Matrix (m x n):\n";
print_r($matrix);

$positiveSum = 0;

foreach ($matrix as $row) {
    // array_filter() keeps only elements where the callback returns true
    $positives = array_filter($row, function ($value) {
        return $value > 0;
    });
    $positiveSum += array_sum($positives);
}

echo "\nSum of positive elements: $positiveSum";

echo "</pre>";