<?php
$template = "Shanovniy. We will be glad to see your son at our departure. " . "We are waiting for him on the 25th. Organizing Committee.";

// $template = "We will be glad to see your son at our departure." . "Check for the new 25th. Organizing Committee.";

// 1) Convert the template into an array of phrases (sentences)
$phrases = explode(". ", $template);

// 2) In the first phrase, replace "Shanovniy" with the parent's name + "!"
$parentName = "Ivan";
$pos = strpos($phrases[0], "Shanovniy");
$phrases[0] = substr_replace($phrases[0], $parentName . "!", $pos, strlen("Shanovniy"));

// 3) Replace the signature "Organizing Committee" with "Administration"
$lastIndex = count($phrases) - 1;
$phrases[$lastIndex] = str_replace("Organizing Committee", "Administration", $phrases[$lastIndex]);

// 4) Replace "your son"/"him" with "your daughter"/"her" throughout every phrase
$phrases = str_replace(
    ["your son", "him"],
    ["your daughter", "her"],
    $phrases
);

// 5) Convert the array back into a string, one phrase per line
$result = implode("\n", $phrases);

echo $result . "\n";