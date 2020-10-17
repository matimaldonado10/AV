<?php
// Lee el fichero en una variable,
// y convierte su contenido a una estructura de datos
$str_datos = file_get_contents("datos.json");
$datos = json_decode($str_datos, true);

echo "Aficiones del jefe: " . $datos["responsable"]["Aficiones"][0] . "n";

// Modifica el valor, y escribe el fichero json de salida
//
$datos["responsable"]["Aficiones"][0] = "Natación";

$fh = fopen("datos_out.json", 'w')
or die("Error al abrir fichero de salida");
fwrite($fh, json_encode($datos, JSON_UNESCAPED_UNICODE));
fclose($fh);
