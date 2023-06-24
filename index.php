<?php

$apiKey = "e95cf470715b92e1616e7cab5055d0d6";
$user_city = $_POST["user_city"] ?? "Libreville";
$url = "https://api.openweathermap.org/data/2.5/weather?q=".urlencode($user_city)."&units=metric&appid=".$apiKey;
$raw = file_get_contents($url);
$json = json_decode($raw);

$lon = $json->coord->lon;
$lat = $json->coord->lat;

$urlSun = "https://api.sunrisesunset.io/json?lat=".$lat."&lng=".$lon;

$rawSun = file_get_contents($urlSun);
$jsonSun = json_decode($rawSun);


$city = $json->name;
$country = $json->sys->country;
$weather = $json->weather[0]->main;
$desc = $json->weather[0]->description;
$temp = $json->main->temp;
$feel_like = $json->main->feels_like;

$humidity = $json->main->humidity;
$sunriseTemp =  $jsonSun->results->sunrise;
$sunsetTemp = $jsonSun->results->sunset;

$icon = $json->weather[0]->icon;

$sunrise = date('H:i A',strtotime($sunriseTemp));
$sunset = date('H:i A',strtotime($sunsetTemp));

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Weather Sun</title>
</head>
<body>
    <header>
        <nav>
            <div class="logo">
            <img src="WeatherSun_Logo.png" width="150px" height="auto" alt="Logo">
            </div>
        
            <ul id="menu">
                <li><a href="#">Information</a></li>
                <li><a href="#">Weather</a></li>
                <li><a href="#">Sunrise & Sunset</a></li>
                <li><a href="#">Air Quality</a></li>
            </ul>
        </nav>
    </header>
    <form action="index.php" method="POST">
        <label for="city">Indiquez une ville </label> <br>
        <input type="text" name="user_city"> <br>
        <input type="submit" value="Valider">
    </form>
<div class="data">
    <div class="Info">
        <h2>Information about the city</h2>
        <p class="cityName"><strong>City : <?php echo $city ?></strong></p>
        <p>Country : <?php echo $country ?></p>
        <p>Longitude : <?php echo $lon ?></p>
        <p>Latitude : <?php echo $lat ?></p>
    </div>
    <div class="weather">
    <h2>Weather</h2>
        <p>Weather : <?php echo $weather ?></p> <br>
        <?php echo '<img src="http://openweathermap.org/img/w/' . $icon . '.png" alt="Weather Icon">' ?>
        <p>Temp: <?php echo $temp ?></p>
        <p>Feel like: <?php echo $feel_like ?></p>
        <p>Humidity: <?php echo $humidity ?></p>
    </div>
    <div class="weather">
    <h2>Sunrise & Sunset Time</h2>
        <p>Sunrise : <?php echo $sunrise ?></p>
        <p>Sunset: <?php echo $sunset ?></p>
    </div>
    </div>
</body>
</html>