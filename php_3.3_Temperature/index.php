<?php

$x = rand(-20, 30);

$temperature = round($x);

if ($x < 0) {
    echo "<h1 style='color: blue;'>Temperature: $temperature °C</h1>";
    echo "<p style='color: blue;'>Cold</p>";
} elseif ($x == 0) {
    echo "<h1 style='color: gray;'>Temperature: $temperature °C</h1>";
    echo "<p style='color: gray;'>Warm</p>";
} else {
    echo "<h1 style='color: red;'>Temperature: $temperature °C</h1>";
    echo "<p style='color: red;'>Hot</p>";
}
