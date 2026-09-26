<?php
$email = "Thank you for your email. We have reviewed your request and will get back to you with more details as soon as possible. Please let us know if you have any other questions in the meantime.";

$prefix = "> ";
$fieldWidth = 20;
$textWidth = $fieldWidth - strlen($prefix); // leave room for the "> " prefix on every line

// wordwrap()'s $break argument is inserted BETWEEN wrapped lines, so using
// "\n> " here makes every line after the first start with "> "; prepending
// "> " once more in front makes the very first line match too.
$wrapped = $prefix . wordwrap($email, $textWidth, "\n" . $prefix, true);

echo $wrapped . "\n";