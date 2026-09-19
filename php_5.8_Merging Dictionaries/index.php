<?php
$dict1 = [
    "hello" => "привіт",
    "book"  => "книга",
    "cat"   => "кіт",
    "run"   => ["бігти", "бігати"],
];

$dict2 = [
    "hello" => "вітаю",              // second translation for an existing word
    "dog"   => "собака",             // brand new word
    "run"   => "мчати",              // one more translation added to an already-multi entry
    "book"  => ["том", "видання"],   // adding several new translations at once
];

echo "<pre>"; // keeps print_r() readable in the browser

echo "Dictionary 1:\n";
print_r($dict1);
echo "\nDictionary 2:\n";
print_r($dict2);

// Combine, appending values instead of overwriting when a key matches in both
$combined = array_merge_recursive($dict1, $dict2);

echo "\nCombined dictionary:\n";
print_r($combined);

echo "</pre>";