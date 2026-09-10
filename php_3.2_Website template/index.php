<?php
$name = "John";
$header = <<<HEADER
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name</title>
</head>
<body>
HEADER;

$footer = <<<FOOTER
</body>
</html>
FOOTER;

echo $header;

echo "<h1>Hello $name</h1>";

echo $footer;