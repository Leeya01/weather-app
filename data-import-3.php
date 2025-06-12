<?php

    $url = 'https://api.openweathermap.org/data/2.5/weather?q=' . $_GET['city'] . '&appid=f0f1b38ea1941cfca1effa7389241e02&units=metric';
    // Get data from openweathermap and store in JSON object
    $data = file_get_contents($url);
    $json = json_decode($data, true);

    // Fetch required fields
    $weather_description = $json['weather'][0]['description'];
    $weather_humidity	= $json['main']['humidity'];
    $weather_temperature = $json['main']['temp'];
    $weather_pressure	= $json['main']['pressure'];     	
    $weather_when = date("Y-m-d H:i:s"); // now
    $city = $json['name']; // name of city     

    // Build INSERT SQL statement
    $sql_insert = "INSERT INTO `weather`(`weather_description`, `weather_humidity`, `weather_temperature`, `weather_pressure`, `weather_when`, `city`)
	VALUES ('{$weather_description}','{$weather_humidity}','{$weather_temperature}','{$weather_pressure}','{$weather_when}','{$city}')";
	
	

    // Run SQL statement and report errors
    if (!$mysqli -> query($sql_insert)) {
        echo("<h4>SQL error description: " . $mysqli -> error . "</h4>");
    }

?>
