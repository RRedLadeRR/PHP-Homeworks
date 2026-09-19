<?php
$items = [
    "Johnson" => 2005, 
    "Smith" => 2003, 
    "Miller" => 2004
    ];

echo "<pre>";

asort($items);
print_r($items); 

sort($items);
print_r($items); 

ksort($items);
print_r($items); 

echo "</pre>";