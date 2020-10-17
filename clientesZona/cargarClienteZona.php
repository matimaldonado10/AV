<?php
include_once 'insertarClienteZona.php';
include_once 'random.php';
include_once 'tablas.php';
include_once 'generarOrdenZona.php';

$insertar = new insertarClienteZona();
$azar = new random();
$Tabla = new tablas();
$orden = new generarOrdenZona();

$registrosClientes = $Tabla->obtenerClientes();
$registrosZonas = $Tabla->obtenerZonas();

/*
Comienza la iteración. En cada una, se inserta una tupla en la tabla "zona de reparto"
 */

echo "Clientes";
echo "<br>";
print_r($registrosClientes);
echo "<br>";
echo "Zonas";
echo "<br>";
print_r($registrosZonas);
echo "<br>";

for ($i = 0; $i < count($registrosClientes); $i++) {

	$idCliente = $registrosClientes[$i]["Persona_IdCliente"];
	$dniCliente = $registrosClientes[$i]["Persona_DNICliente"];

	$cantidadPaso = $azar->alAzar(1, 3);

	for ($x = 0; $x < $cantidadPaso; $x++) {
		$zona = $azar->alAzar(0, count($registrosZonas) - 1);
		$idZonaReparto = $registrosZonas[$zona]["idRutaDeReparto"];

		$Orden = $orden->generarOrden($idZonaReparto);
		$insertar->insertarClienteEnZona($Orden, $idCliente,
						   $dniCliente, $idZonaReparto);
		echo "<br>";

	}

	echo "fin carga ";
	echo "<br> ";

}
