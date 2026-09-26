<?php

$text1 = 'He said "hello world" and left the room (quietly.';
$text2 = 'She replied "of course (as always)" without hesitation.';

function analyzeStr(string $text): void
{
    echo "<pre>";

    echo "Analyzing: \"$text\"\n";

    $quoteCount = substr_count($text, '"');
    if ($quoteCount % 2 !== 0) {
        echo "  Warning: unpaired quotation marks ({$quoteCount} found, should be an even number).\n";
    } else {
        echo "  Quotation marks are balanced ({$quoteCount} found).\n";
    }

    $openParens  = substr_count($text, '(');
    $closeParens = substr_count($text, ')');
    if ($openParens !== $closeParens) {
        echo "  Warning: unpaired parentheses ({$openParens} opening vs {$closeParens} closing).\n";
    } else {
        echo "  Parentheses are balanced ({$openParens} pair(s)).\n";
    }

    echo "\n";

    echo "</pre>";
}

analyzeStr($text1);
analyzeStr($text2);