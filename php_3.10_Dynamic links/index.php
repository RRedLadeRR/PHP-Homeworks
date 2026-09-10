<?php

for ($i = 1; $i <= 10; $i++) {
    ${"x".$i} = $i;
}

for ($i = 1; $i <= 10; $i++) {
    echo ${"x".$i} . "<br>";
}
