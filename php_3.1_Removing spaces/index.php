<?php
$str = "[   34  555   8 9 9  ]";

echo "<pre>";

echo "Original: '$str'\n";

// Collapse every run of 2+ spaces down to a single space.
// str_replace() only closes one gap per pass, so it's run in a loop
// until no double-space is left anywhere in the string.
while (str_contains($str, "  ")) {
    $str = str_replace("  ", " ", $str);
}

echo "Cleaned:  '$str'\n";

echo "</pre>";