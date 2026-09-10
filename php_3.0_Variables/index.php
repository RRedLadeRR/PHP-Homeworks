<?php

// Integer
$year = 2026;

// Boolean
$is_leap = true;

// Float
$price = 12.99;

// String
$favorite_movie = "Reacher";

// Constant using const
const MY_CAR = "Dodge";

// Constant using define()
define("MY_REG_DATE", "05.09");

// Output variables
echo "Year: $year<br>\n";
echo "Leap year: " . ($is_leap ? "Yes" : "No") . "<br>\n";
echo "Price: $price<br>\n";
echo "Favorite movie: $favorite_movie<br>\n";

// Output constants
echo "Car: " . MY_CAR . "<br>\n";
echo "Registration date: " . MY_REG_DATE;
