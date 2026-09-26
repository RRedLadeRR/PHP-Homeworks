<?php
// Simulated user-submitted "email" text -- possibly malicious
$email = "JohnJohnson<script>alert('Dangerous script here');</script>@gmail.com";

// --- Manual approach with str_replace(), matching the earlier exercises ---
$safeManual = str_replace(
    ['<', '>'],
    ['&lt;', '&gt;'],
    $email
);

// --- Recommended approach: htmlspecialchars() ---
// Converts <, >, &, ", ' all at once -- the standard, safe way to output
// any user-supplied text inside HTML.
$safe = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

echo $safe;



// Raw input: extra whitespace, HTML tags (including a malicious one),
// an ampersand, a quote, and an accented character
$rawInput = "   <p>Hello & welcome to our café! <script>alert('hi')</script></p>   ";

echo "Original:\n'$rawInput'\n\n";

// 1) Remove HTML tags entirely
$noTags = strip_tags($rawInput);
echo "After strip_tags():\n'$noTags'\n\n";

// 2) Remove leading/trailing whitespace
$trimmed = trim($noTags);
echo "After trim():\n'$trimmed'\n\n";

// 3a) Escape special HTML characters: &, <, >, \", '
$safeSpecialChars = htmlspecialchars($trimmed, ENT_QUOTES, 'UTF-8');
echo "After htmlspecialchars():\n'$safeSpecialChars'\n\n";

// 3b) Convert ALL characters that have an HTML entity equivalent,
// including accented/special letters like "é"
$safeEntities = htmlentities($trimmed, ENT_QUOTES, 'UTF-8');
echo "After htmlentities():\n'$safeEntities'\n";