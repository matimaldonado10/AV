<?php
include_once 'insertarZonaRepartidor.php';

include_once 'tablas.php';

$insertar = new insertarZonaRepartidor();

$Tabla = new tablas();

$registrosRepartidores = $Tabla->obtenerRepartidores();

/*
Comienza la iteración. En cada una, se inserta una tupla en la tabla "zona de reparto"
 */

echo "Repartidores";
echo "<br>";
print_r($registrosRepartidores);
echo "<br>";
$dias = array("LUNES", "MARTES", "MIERCOLES", "JUEVES", "VIERNES", "SABADO");

for ($i = 0; $i < count($registrosRepartidores); $i++) {

	$idRepartidor = $registrosRepartidores[$i]["Persona_IdRepartidor"];
	$dniRepartidor = $registrosRepartidores[$i]["Persona_DNIRepartidor"];

	for ($x = 0; $x < 6; $x++) {
		$insertar->insertarZona($dias[$x], $idRepartidor, $dniRepartidor);
		echo "<br>";

	}

	echo "fin carga ";
	echo "<br> ";

}
