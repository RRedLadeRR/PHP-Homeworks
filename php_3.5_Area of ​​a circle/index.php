<?php

const PI = 3.14159;

$radius = rand(10, 100);

$area = PI * $radius ** 2;

echo "<h2>Circle</h2>";
echo "Radius: $radius<br>";
echo "Area: $area<br><br>";

$diameter = $radius * 2;

echo "
<div style='
    width: {$diameter}px;
    height: {$diameter}px;
    border: 2px solid black;
    border-radius: 50%;
'></div>
";
