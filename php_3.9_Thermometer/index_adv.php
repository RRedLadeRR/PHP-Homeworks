<?php
/**
 * Real-time thermometer powered by the OpenWeatherMap API.
 * Save into your XAMPP htdocs folder and open in the browser.
 */

// ====================== CONFIGURATION ======================
// Secrets live in config.php (not this file), so they never end up in a
// screenshot, a shared zip, or a git commit of this script.
$config = require __DIR__ . '/config.php';
$apiKey = $config['api_key'];
$city   = $config['city'];
// =============================================================

$apiUrl = "https://api.openweathermap.org/data/2.5/weather?"
        . "q=" . urlencode($city)
        . "&appid=" . urlencode($apiKey)
        . "&units=metric&lang=en";

$weather      = null;
$errorMessage = null;

// @ suppresses the warning if the request fails; we handle it ourselves below
$response = @file_get_contents($apiUrl);

if ($response === false) {
    $errorMessage = "Could not reach OpenWeatherMap (check your internet connection, "
                  . "or that allow_url_fopen is enabled in php.ini).";
} else {
    $data = json_decode($response, true);
    if (!isset($data['main']['temp'])) {
        $errorMessage = isset($data['message'])
            ? "API error: " . $data['message'] . " (did you set a valid API key?)"
            : "Unexpected API response.";
    } else {
        $weather = $data;
    }
}

// Fall back to a random temperature so the page still works while you're testing
$t = $weather ? (int) round($weather['main']['temp']) : rand(-20, 20);

$cityName    = $weather['name'] ?? $city;
$description = $weather['weather'][0]['description'] ?? null;
$icon        = $weather['weather'][0]['icon'] ?? null;
$humidity    = $weather['main']['humidity'] ?? null;
$feelsLike   = isset($weather['main']['feels_like']) ? (int) round($weather['main']['feels_like']) : null;

/**
 * Returns a colour for a given degree, blue (cold) -> red (hot).
 */
function tempColor(int $deg): string
{
    if ($deg <= -15) return "#1e3a8a";
    if ($deg <= -5)  return "#2563eb";
    if ($deg <= 0)   return "#38bdf8";
    if ($deg <= 10)  return "#22c55e";
    if ($deg <= 20)  return "#facc15";
    if ($deg <= 30)  return "#f97316";
    return "#dc2626";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Real-Time Thermometer</title>
<style>
    * { box-sizing: border-box; }
    body {
        margin: 0;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', system-ui, sans-serif;
        background: linear-gradient(135deg, #0f172a, #1e293b);
        color: #f1f5f9;
    }
    .wrapper {
        display: flex;
        gap: 30px;
        align-items: flex-start;
        flex-wrap: wrap;
        justify-content: center;
        padding: 30px;
    }
    .card, .thermo-card {
        background: rgba(255,255,255,0.06);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.15);
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.4);
    }
    .card {
        padding: 25px 30px;
        min-width: 260px;
        text-align: center;
        border-top: 4px solid <?= tempColor($t) ?>;
    }
    .card h2 { margin: 0 0 5px; font-size: 22px; }
    .card .desc { text-transform: capitalize; color: #cbd5e1; margin-bottom: 6px; }
    .card .icon { width: 90px; height: 90px; }
    .big-temp { font-size: 48px; font-weight: 700; margin: 10px 0; }
    .meta { font-size: 14px; color: #94a3b8; margin-top: 6px; }
    .error-box {
        background: rgba(220,38,38,0.15);
        border: 1px solid #dc2626;
        color: #fecaca;
        padding: 10px 15px;
        border-radius: 10px;
        margin-top: 12px;
        font-size: 13px;
        text-align: left;
    }
    .thermo-card { padding: 20px; }
    table { border-collapse: collapse; }
    td { text-align: center; font-size: 12px; padding: 0; }
    .deg-cell { width: 34px; color: #cbd5e1; }
    .bar-cell { width: 34px; height: 8px; border-radius: 4px; transition: background 0.3s ease; }
    .bar-cell.current { outline: 2px solid #ffffff; }
</style>
</head>
<body>

<div class="wrapper">

    <div class="card">
        <h2><?= htmlspecialchars($cityName) ?></h2>

        <?php if ($icon): ?>
            <img class="icon"
                 src="https://openweathermap.org/img/wn/<?= htmlspecialchars($icon) ?>@2x.png"
                 alt="<?= htmlspecialchars($description ?? '') ?>">
        <?php endif; ?>

        <?php if ($description): ?>
            <div class="desc"><?= htmlspecialchars($description) ?></div>
        <?php endif; ?>

        <div class="big-temp"><?= $t ?>&deg;C</div>

        <?php if ($feelsLike !== null): ?>
            <div class="meta">Feels like <?= $feelsLike ?>&deg;C</div>
        <?php endif; ?>
        <?php if ($humidity !== null): ?>
            <div class="meta">Humidity: <?= $humidity ?>%</div>
        <?php endif; ?>

        <?php if ($errorMessage): ?>
            <div class="error-box">
                &#9888; <?= htmlspecialchars($errorMessage) ?><br>
                Showing a random value instead.
            </div>
        <?php endif; ?>
    </div>

    <div class="thermo-card">
        <table>
            <?php for ($i = 20; $i >= -20; $i--): ?>
                <tr>
                    <td class="deg-cell"><?= $i ?>&deg;</td>
                    <td class="bar-cell <?= $i === $t ? 'current' : '' ?>"
                        style="background: <?= $i <= $t ? tempColor($i) : 'rgba(255,255,255,0.08)' ?>;">
                    </td>
                </tr>
            <?php endfor; ?>
        </table>
    </div>

</div>

</body>
</html>