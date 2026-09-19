<?php
$movies = [
    "Inception"    => ["director" => "Christopher Nolan",  "year" => 2010],
    "Parasite"     => ["director" => "Bong Joon-ho",       "year" => 2019],
    "The Matrix"   => ["director" => "Lana Wachowski",     "year" => 1999],
    "Interstellar" => ["director" => "Christopher Nolan",  "year" => 2014],
    "Amelie"       => ["director" => "Jean-Pierre Jeunet", "year" => 2001],
];

// Extracts the last word of a full name, used as an approximation of "last name"
function lastName(string $fullName): string
{
    $parts = explode(" ", $fullName);
    return end($parts);
}

// Prints one movie as a styled list item.
// Matches array_walk()'s callback signature: ($value, $key).
function printMovie($info, $title)
{
    echo "<li>"
       . "<span class='title'>{$title}</span>"
       . " &mdash; <span class='director'>{$info['director']}</span>"
       . " <span class='year'>({$info['year']})</span>"
       . "</li>\n";
}

echo "<style>
    ul.movie-list { list-style: none; padding: 0; font-family: 'Segoe UI', sans-serif; max-width: 420px; }
    ul.movie-list li { padding: 8px 12px; margin-bottom: 6px; background: #f4f4f9; border-left: 4px solid #6366f1; border-radius: 4px; }
    ul.movie-list .title { font-weight: bold; color: #1e293b; }
    ul.movie-list .director { font-style: italic; color: #475569; }
    ul.movie-list .year { color: #ffffff; background: #6366f1; padding: 1px 6px; border-radius: 10px; font-size: 12px; }
    h3 { font-family: 'Segoe UI', sans-serif; color: #1e293b; margin-top: 30px; }
</style>";

// 1) Sort by movie title (key), alphabetically
$byTitle = $movies;
ksort($byTitle);
echo "<h3>Sorted by title</h3><ul class='movie-list'>";
array_walk($byTitle, 'printMovie');
echo "</ul>";

// 2) Sort by director's last name
$byDirector = $movies;
uasort($byDirector, function ($a, $b) {
    return strcmp(lastName($a['director']), lastName($b['director']));
});
echo "<h3>Sorted by director's last name</h3><ul class='movie-list'>";
array_walk($byDirector, 'printMovie');
echo "</ul>";

// 3) Sort by release year
$byYear = $movies;
uasort($byYear, function ($a, $b) {
    return $a['year'] <=> $b['year'];
});
echo "<h3>Sorted by release year</h3><ul class='movie-list'>";
array_walk($byYear, 'printMovie');
echo "</ul>";