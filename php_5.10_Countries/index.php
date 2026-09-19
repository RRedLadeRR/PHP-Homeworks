<?php
// Example 4.1 "Countries" — key: country name, value: capital/area/population
$countries = [
    "Ukraine" => ["capital" => "Kyiv",     "area" => 603628, "population" => 41167336],
    "France"  => ["capital" => "Paris",    "area" => 551695, "population" => 68170228],
    "Germany" => ["capital" => "Berlin",   "area" => 357588, "population" => 84075075],
    "Japan"   => ["capital" => "Tokyo",    "area" => 377975, "population" => 123753041],
    "Brazil"  => ["capital" => "Brasilia", "area" => 8515767, "population" => 216422446],
    "Poland"  => ["capital" => "Warsaw",   "area" => 312696, "population" => 36753736],
];

// Prints one country as a styled list item.
// Matches array_walk()'s callback signature: ($value, $key).
function printCountry($info, $name)
{
    echo "<li>"
       . "<span class='name'>{$name}</span>"
       . " <span class='capital'>{$info['capital']}</span>"
       . " <span class='area'>" . number_format($info['area']) . " km&sup2;</span>"
       . " <span class='population'>" . number_format($info['population']) . "</span>"
       . "</li>\n";
}

echo "<style>
    body { font-family: 'Segoe UI', sans-serif; background: #f8fafc; color: #1e293b; padding: 20px; }
    h2 { color: #0f172a; border-bottom: 2px solid #0ea5e9; padding-bottom: 4px; max-width: 480px; }
    ul.country-list { list-style: none; padding: 0; max-width: 480px; }
    ul.country-list li {
        display: flex; justify-content: space-between; gap: 8px;
        padding: 8px 12px; margin-bottom: 6px;
        background: #ffffff; border-left: 4px solid #0ea5e9;
        border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.08);
    }
    ul.country-list .name { font-weight: bold; flex: 1; }
    ul.country-list .capital { color: #475569; flex: 1; }
    ul.country-list .area { color: #0369a1; flex: 1; text-align: right; }
    ul.country-list .population { color: #ffffff; background: #0ea5e9; padding: 1px 8px; border-radius: 10px; font-size: 12px; }
    .stat-box {
        max-width: 480px; margin-top: 20px; padding: 14px 18px;
        background: #ecfdf5; border-left: 4px solid #10b981; border-radius: 4px;
        font-weight: bold; color: #065f46;
    }
</style>";

// 1) Sort by country name (the key) -- alphabetical, no callback needed
$byName = $countries;
ksort($byName);
echo "<h2>Sorted by country name</h2><ul class='country-list'>";
array_walk($byName, 'printCountry');
echo "</ul>";

// 2) Sort by capital city -- uasort() + spaceship operator
$byCapital = $countries;
uasort($byCapital, function ($a, $b) {
    return $a['capital'] <=> $b['capital'];
});
echo "<h2>Sorted by capital city</h2><ul class='country-list'>";
array_walk($byCapital, 'printCountry');
echo "</ul>";

// 3) Sort by area -- uasort() + spaceship operator
$byArea = $countries;
uasort($byArea, function ($a, $b) {
    return $a['area'] <=> $b['area'];
});
echo "<h2>Sorted by area</h2><ul class='country-list'>";
array_walk($byArea, 'printCountry');
echo "</ul>";

// 4) Sort by population -- uasort() + spaceship operator
$byPopulation = $countries;
uasort($byPopulation, function ($a, $b) {
    return $a['population'] <=> $b['population'];
});
echo "<h2>Sorted by population</h2><ul class='country-list'>";
array_walk($byPopulation, 'printCountry');
echo "</ul>";

// Average population across all countries
$populations = array_column($countries, 'population');
$averagePopulation = array_sum($populations) / count($populations);

echo "<div class='stat-box'>Average population: " . number_format($averagePopulation) . "</div>";