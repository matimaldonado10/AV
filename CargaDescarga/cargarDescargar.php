<?php
include_once 'insertarCargaDescarga.php';

include_once 'tablas.php';
include_once 'random.php';

$insertar = new insertarCargaDescarga();
$azar = new random();
$Tabla = new tablas();

$cantidadCargas = 100; // indicas las cantidad de ventas ha generar

$registrosRepartidores = $Tabla->obtenerRepartidores();
$registrosSupervisores = $Tabla->obtenerSupervisores();
$registrosArticulos = $Tabla->obtenerArticulos();

/*
Comienza la iteración. En cada una, se inserta una tupla en la tabla "ventas" y también uno o más de una tupla en la "tabla detalle de venta" correspondiente al id de venta.
 */

echo "Supervisores";
echo "<br>";
print_r($registrosSupervisores);
echo "<br>";
echo "Repartidores";
echo "<br>";
print_r($registrosRepartidores);
echo "<br>";
echo "Articulos";
echo "<br>";

print_r($registrosArticulos);
echo "<br>";
for ($i = 0; $i < $cantidadCargas; $i++) {

	$fechaCarga = $azar->alAzarFecha();
	$plata = $azar->alAzarPlata();

	$filaSupervisor = $azar->alAzar(0, count($registrosSupervisores) - 1);

	$idSupervisor = $registrosSupervisores[$filaSupervisor]["Persona_IdSupervisor"];
	$dniSupervisor = $registrosSupervisores[$filaSupervisor]["Persona_DNISupervisor"];

	$filaRepartidor = $azar->alAzar(0, count($registrosRepartidores) - 1);

	$idRepartidor = $registrosRepartidores[$filaRepartidor]["Persona_IdRepartidor"];
	$dniRepartidor = $registrosRepartidores[$filaRepartidor]["Persona_DNIRepartidor"];

	$RegistroIdCarga = $insertar->insertarCarga($fechaCarga, $plata, $idSupervisor, $dniSupervisor, $idRepartidor, $dniRepartidor);
	echo "<br>";
	echo "insertado en  ventas";

	// obtengo el id de la última consulta a la BD
	//$RegistroIdVenta = $Tabla->obtenerIdVentas();
	echo "<br>";
	print_r($RegistroIdCarga);
	// cantidad de inserciones en la tabla Detalle Venta
	$iteracionDetalle = $azar->alAzar(1, 2);
	$idCarga = $RegistroIdCarga[0];

	for ($x = 0; $x < $iteracionDetalle; $x++) {

		$indice = $azar->alAzar(0, count($registrosArticulos) - 1);
		$idArticulo = $registrosArticulos[$indice]["IdArticulo"];
		$CantidadDetalle = $azar->alAzar(1, 10);
		$insertar->InsertarDetalleCarga($CantidadDetalle, $idCarga, $idArticulo);
	}

	echo "fin carga ";
	echo "<br> ";

	/*
	print_r($dniEnviar);
	echo " ";
	print_r($ape);
	echo " ";
	print_r($nom);
	echo " ";

	 */

	/*

FIN FOR VENTAS
 */

}
