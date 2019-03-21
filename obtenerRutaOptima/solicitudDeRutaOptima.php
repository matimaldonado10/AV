<?php
include_once ('random.php');
$random = new random();

for ($i=0; $i < 5; $i++) { 
    $lat = $random->latitud();
    $long = $random->longitud();

    $coordenadas .= $long+','+$lat+';';
}
$coordenadas = trim($coordenadas, ';');


$ch = curl_init();

$url = 'http://127.0.0.1:5000/trip/v1/driving/';
$url .= $coordenadas;
echo $url;
//'http://127.0.0.1:5000/trip/v1/driving/-60.44634,-26.77638;-60.41733,-26.79080;-60.44657,-26.80139'
//Set the URL that you want to GET by using the CURLOPT_URL option.
curl_setopt($ch, CURLOPT_URL, $url );
 
//Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
//Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
 
//Execute the request.
$data = curl_exec($ch);
 
//Close the cURL handle.
curl_close($ch);
 
//Print the data out onto the page.
echo $data;