<?php
// English word => Ukrainian translation(s)
$dictionary = [
    "hello" => "привіт",
    "book"  => "книга",
    "cat"   => "кіт",
    "run"   => ["бігти", "бігати"],     // several Ukrainian translations for one English word
    "light" => ["світло", "легкий"],    // e.g. "light" as a noun and as an adjective
];

echo "<pre>"; // keeps print_r() readable in the browser

echo "English-Ukrainian dictionary:\n";
print_r($dictionary);

// Split into simple (string) entries and multi-translation (array) entries,
// because array_flip() can only flip string/int VALUES -- it silently
// drops any entry whose value is itself an array.
$simple = array_filter($dictionary, function ($value) {
    return !is_array($value);
});
$multi = array_filter($dictionary, function ($value) {
    return is_array($value);
});

// array_flip() swaps keys and values for the simple entries
$reverseDictionary = array_flip($simple);

// Handle entries with several Ukrainian translations manually:
// each translation becomes its own key pointing back to the English word
foreach ($multi as $english => $translations) {
    foreach ($translations as $word) {
        $reverseDictionary[$word] = $english;
    }
}

echo "\nUkrainian-English dictionary (reversed):\n";
print_r($reverseDictionary);

echo "</pre>";