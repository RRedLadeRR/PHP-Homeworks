<?php
$directors = [
    "Christopher Nolan" => [
        "The Dark Knight"              => 2008,
        "Inception"                    => 2010,
        "The Dark Knight Rises"        => 2012,
        "Interstellar"                 => 2014,
        "Dunkirk"                      => 2017,
        "Zack Snyder's Justice League" => 2021,
        "Oppenheimer"                  => 2023,
        "The Odyssey"                  => 2026,
    ],
    "Quentin Tarantino" => [
        "Pulp Fiction"                       => 1994,
        "Kill Bill: Vol 1"                   => 2003,
        "Kill Bill: Vol 2"                   => 2004,
        "Kill Bill: The Whole Bloody Affair" => 2004,
        "CSI: Crime Scene Investigation"     => 2005,
        "Inglourious Basterds"               => 2009,
        "Django Unchained"                   => 2012,
        "The Hateful Eight"                  => 2015,
    ],
    "Christopher McQuarrie" => [
        "Jack Reacher"                                  => 2012,
        "Edge of Tomorrow"                              => 2014,
        "Mission: Impossible - Rogue Nation"            => 2015,
        "Jack Reacher: Never Go Back"                   => 2016,
        "The Mummy"                                     => 2017,
        "Mission: Impossible - Fallout"                 => 2018,
        "Top Gun: Maverick"                             => 2022,
        "Reacher (Series)"                              => 2022,
        "Mission: Impossible - Dead Reckoning Part One" => 2023,
        "Mission: Impossible - The Final Reckoning"     => 2025,
    ],
    "Guy Ritchie" => [
        "Snatch"                                => 2000,
        "The Man from U.N.C.L.E."               => 2015,
        "Snatch (Series)"                       => 2017,
        "King Arthur: Legend of the Sword"      => 2017,
        "The Gentleman"                         => 2019,
        "The Gentleman (Series)"                => 2024,
        "The Ministry of Ungentlemanly Warfare" => 2024,
        "Young Sherlock (Series)"               => 2026,
        "In the Grey"                           => 2026,
    ],
];

function flattenMovies(array $directors): array
{
    $rows = [];
    foreach ($directors as $director => $movies) {
        foreach ($movies as $title => $year) {
            $rows[] = ["director" => $director, "title" => $title, "year" => $year];
        }
    }
    return $rows;
}

function searchMovies(array $rows, string $query): array
{
    $query = trim($query);
    if ($query === '') {
        return [];
    }
    if (ctype_digit($query)) {
        $length = strlen($query);
        return array_values(array_filter($rows, function ($row) use ($query, $length) {
            $yearStr = (string) $row['year'];
            if ($length === 4) return $yearStr === $query;
            if ($length === 2) return substr($yearStr, -2) === $query;
            return false;
        }));
    }
    return array_values(array_filter($rows, function ($row) use ($query) {
        return stripos($row['director'], $query) !== false
            || stripos($row['title'], $query) !== false;
    }));
}

function renderGroupedTables(array $rows, string $emptyMessage = "Nothing found for this query."): void
{
    if (empty($rows)) {
        echo "<p class='empty-message'>{$emptyMessage}</p>";
        return;
    }
    $grouped = [];
    foreach ($rows as $row) {
        $grouped[$row['director']][] = $row;
    }
    foreach ($grouped as $director => $movies) {
        echo "<h3>" . htmlspecialchars($director) . "</h3>";
        echo "<table class='movie-table'><thead><tr><th>Title</th><th>Year</th></tr></thead><tbody>";
        foreach ($movies as $movie) {
            echo "<tr><td>" . htmlspecialchars($movie['title']) . "</td><td>{$movie['year']}</td></tr>";
        }
        echo "</tbody></table>";
    }
}

// Shows either the full listing (empty query) or search results, with a
// heading that reflects which one is being displayed.
function renderSearchResults(array $allRows, string $query): void
{
    $query = trim($query);
    if ($query === '') {
        echo "<h2>All movies</h2>";
        renderGroupedTables($allRows);
        return;
    }
    echo "<h2>Search results for \"" . htmlspecialchars($query) . "\"</h2>";
    renderGroupedTables(searchMovies($allRows, $query));
}

$allRows = flattenMovies($directors);

// AJAX branch: return ONLY the results fragment, nothing else, and stop.
if (isset($_GET['ajax'])) {
    renderSearchResults($allRows, $_GET['query'] ?? '');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Movie search</title>
<style>
    body { font-family: 'Segoe UI', sans-serif; background: #f8fafc; color: #1e293b; padding: 20px; max-width: 900px; margin: 0 auto; }
    h1 { color: #0f172a; }
    h2 { color: #0f172a; border-bottom: 2px solid #f59e0b; padding-bottom: 4px; margin-top: 28px; }
    h3 { color: #334155; margin: 18px 0 6px; }
    #searchBox {
        width: 100%; padding: 10px 14px; font-size: 15px; border: 1px solid #cbd5e1;
        border-radius: 8px; box-sizing: border-box; margin-top: 8px;
    }
    #searchBox:focus { outline: none; border-color: #f59e0b; box-shadow: 0 0 0 3px rgba(245,158,11,0.2); }
    table.movie-table { border-collapse: collapse; width: 100%; background: #fff; box-shadow: 0 1px 4px rgba(0,0,0,0.1); margin-bottom: 10px; }
    table.movie-table th { background: #f59e0b; color: #fff; text-align: left; padding: 6px 12px; }
    table.movie-table td { padding: 6px 12px; border-bottom: 1px solid #e2e8f0; }
    table.movie-table tr:last-child td { border-bottom: none; }
    .empty-message { padding: 10px 14px; background: #fef2f2; border-left: 4px solid #ef4444; color: #991b1b; border-radius: 4px; }
</style>
</head>
<body>

<h1>Movie search</h1>
<input type="text" id="searchBox" placeholder="Search by director, title, or year..." autocomplete="off">

<div id="results">
<?php renderSearchResults($allRows, ''); ?>
</div>

<script>
const searchBox  = document.getElementById('searchBox');
const resultsBox = document.getElementById('results');
let debounceTimer;

searchBox.addEventListener('input', () => {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
        const query = searchBox.value;
        fetch('?ajax=1&query=' + encodeURIComponent(query))
            .then(response => response.text())
            .then(html => { resultsBox.innerHTML = html; });
    }, 250); // wait 250ms after typing stops before searching
});
</script>

</body>
</html>