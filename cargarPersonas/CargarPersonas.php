<?php
include 'insert.php';
include 'nombres.php';
include 'apellidos.php';
include 'generarDni.php';
include_once 'random.php';
include_once 'direccion.php';
include_once 'obtenerBarrio.php';

$gd        = new generarDni();
$apellidos = new apellidos();
$nombres   = new nombres();
$insertar  = new Insertar();
$azar      = new random();
$dir       = new direccion();
$barrio    = new obtenerBarrio();

$cantidadDni = 10; // indicas las cantidad de DNIs ha generar

$dniAceptados       = $gd->generarDniAleatorio($cantidadDni); //recibe un arreglo con DNIs únicos
$nombresHombres     = $nombres->obtenerNombreHombres(); //se obtiene un nombre  del archivo hombres.csv
$nombresMujeres     = $nombres->obtenerNombreMujeres(); //se obtiene un nombre  del archivo mujeres.csv
$apellidosRegistros = $apellidos->obtenerApellido(); //se obtiene un apellido del archivo apellidos.csv de forma aleatoria
$direcciones        = $dir->obtenerDireccion();
$referencias        = $dir->obtenerReferencia();
$barrios            = $barrio->obtenerBarrios();

echo "<br>";
print_r($dniAceptados);
echo "<br>";
echo "<br>";
print_r($referencias);
echo "<br>";
echo "<br>";
print_r($direcciones);
echo "<br>";

for ($i = 0; $i < $cantidadDni; $i++) {
	$ape = $apellidosRegistros[$azar->alAzar()];

	if (rand(1, 2) == 1) {
		$nom = $nombresMujeres[$azar->alAzar()];
	} else {
		$nom = $nombresHombres[$azar->alAzar()];
	}

	$dniEnviar = $dniAceptados[$i]; //

	$direccionEnviar  = $azar->alAzarBarrios($direcciones);
	$referenciaEnviar = $azar->alAzarBarrios($referencias);

	print_r($dniEnviar);
	echo " ";
	print_r($ape);
	echo " ";
	print_r($nom);
	echo " ";

	$insertar->insertarDatosPersona($dniEnviar, $ape, $nom);

	$idPersona = $barrio->obtenerIdTabla($dniEnviar);
	$unId      = implode("", $idPersona[0]);

	$idBarrio = $azar->alAzarBarrios($barrios);

	echo " ";
	print_r($direcciones[$direccionEnviar]);
	echo " ";
	print_r($referencias[$referenciaEnviar]);
	echo " ";
	echo "<br>";

	// inserta datos de la persona en la tabla direccion
	$insertar->insertarDireccion($direcciones[$direccionEnviar], $referencias[$referenciaEnviar], $unId, $dniEnviar, $idBarrio);

	/*
	Preparamos para insertar datos en las tablas Repartidor/Distribuidor/clienteDirecto

	 */
	//$azar->alAzarRol()
	switch ($azar->alAzarRol(3, 3)) {
	case 1:
		$insertar->insertarClienteDirecto($unId, $dniEnviar);

		break;
	case 2:
		$insertar->insertarRepartidor($unId, $dniEnviar);
		break;
	case 3:
		$insertar->insertarDistribuidor($unId, $dniEnviar);
		break;
	}

}
