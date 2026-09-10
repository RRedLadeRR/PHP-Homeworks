<?php

$n = 5;

echo "<table border='1'>";

for ($i = 1; $i <= $n; $i++) {
    if ($i % 2 != 0) {
        echo "<tr>";
        echo "<td>$i</td>";
        echo "<td><img src='img_$i.jpg' width='240'></td>";
        echo "</tr>";
    }
}

echo "</table>";
