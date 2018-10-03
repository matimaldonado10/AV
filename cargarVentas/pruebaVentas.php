<?php

//extract($_POST);

$str_datos = file_get_contents("activityVentas.json");
$datos = json_decode($str_datos,true);



echo "articulo: ".$datos["data"]["detalleventa"][1]["articulo"];




