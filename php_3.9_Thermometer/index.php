<?php

$t = rand(-20, 20);

echo "Температура: $t °C<br><br>";

echo "<table border='1'>";

for ($i = 20; $i >= -20; $i--) {

    $style = $i < $t ? "background:red" : "background:yellow";

    echo "<tr>";
    echo "<td width='30px'>$i</td>";
    echo "<td style='$style; width:30px'></td>";
    echo "</tr>";
}

echo "</table>";
