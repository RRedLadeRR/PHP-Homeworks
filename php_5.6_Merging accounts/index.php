<?php
$users1 = ["John" => "qwerty", "Nicole" => "asdf", "Mark" => "ww"];
$users2 = ["Joan" => "1234", "Mark" => "poiu", "Nicole" => "ggg"];

echo "<pre>"; // keeps print_r() readable in the browser

// --- Naive combine, just to show array_merge()/+ ---
// Note: with array_merge(), if a key exists in both arrays the LATER
// array's value overwrites the earlier one, so duplicates get lost here.
$naiveMerge = array_merge($users1, $users2);
echo "Naive merge with array_merge() (duplicates overwritten):\n";
print_r($naiveMerge);

// --- Find users that exist in BOTH arrays ---
$commonFrom1 = array_intersect_key($users1, $users2); // common keys, values from $users1
print_r($commonFrom1);
$commonFrom2 = array_intersect_key($users2, $users1); // common keys, values from $users2
print_r($commonFrom2);
// Combine same-key values into one array per user
$duplicates = array_merge_recursive($commonFrom1, $commonFrom2);
print_r($duplicates);
// --- Build the main array with ONLY non-repeating users ---
$onlyIn1   = array_diff_key($users1, $users2); // keys unique to $users1
print_r($onlyIn1);
$onlyIn2   = array_diff_key($users2, $users1); // keys unique to $users2
print_r($onlyIn2);
$mainArray = array_merge($onlyIn1, $onlyIn2);

echo "\nMain array (non-repeating users only):\n";
print_r($mainArray);

echo "\nUsers with matching keys (moved to a separate array):\n";
print_r($duplicates);

$common = array_merge_recursive($users1, $users2);
print_r($common);

echo "</pre>";