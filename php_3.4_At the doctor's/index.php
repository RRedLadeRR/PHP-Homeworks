<?php

$x = rand(360, 410) / 10;

// if ($x < 37.7) {
//     $text = "Helthy!";
// } elseif ($x == 37.7) {
//     $text = "Not too good…";
// } else {
//     $text = "Sick!";
// }

$result = $x < 37.7 ? "Helthy" : ($x == 37.7 ? "Not too good" : "Sick");

echo "Temperature: $x °C<br>";
echo $result;
