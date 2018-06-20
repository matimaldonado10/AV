<?php

/*
		cargo las librerías de php de otras funciones para poder reutilizarlas
*/

include_once('cargarVentas/cargarVentas.php');

include_once('CargaDescarga/cargarDescargar.php');

include_once ('C:\xampp\htdocs\test\simuladorVentas\random.php');// random permite devolver valores aleatorios, fechas y plata aleatoria
include_once ('C:\xampp\htdocs\test\simuladorVentas\tablas.php');// consulta la BD, puede obtener todos los supervisores, repartidores, artículos y los clientes de un repartidor. Devuelve un arreglo
date_default_timezone_set('America/Argentina/Buenos_Aires');

$azar = new random();
$Tabla = new tablas();
$descarga = new cargarDescargar();
$ventas = new cargarVentas();




$registrosClientes = $Tabla->obtenerClientes();
$registrosRepartidores = $Tabla->obtenerRepartidores();
$registrosDistribuidores = $Tabla->obtenerDistribuidores();
$registrosSupervisores = $Tabla->obtenerSupervisores();
$registrosArticulos = $Tabla->obtenerArticulos();

/*
	Comienza la iteración. En cada una, se inserta una tupla en la tabla "ventas" y también uno o más de una tupla en la "tabla detalle de venta" correspondiente al id de venta.
*/

echo "Clientes";
echo "<br>";
//print_r($registrosClientes);
echo "<br>";
echo"Repartidores";
echo "<br>";
print_r($registrosRepartidores);
echo "<br>";
echo"Distribuidores";
echo "<br>";
print_r($registrosDistribuidores);
echo "<br>";
echo "<br> ";


/*
		inicia for para las cargas y descargas de bidones dispenser
		canilla. Todo controlado por un supervisor aleatorio y
		asignado a un repartidor

*/

if ($azar->alAzar(2,2) == 1)//modificar los parámetros de alAzar(,)
{
	$fecha = $azar->alAzarFecha();
	switch ($azar->alAzar(1,6))
			{
				case '1':
					$dia = "LUNES";
					break;
				case '2':
					$dia = "MARTES";
					break;
				case '3':
					$dia = "MIERCOLES";
					break;
				case '4':
					$dia = "JUEVES";
					break;
				case '5':
					$dia = "VIERNES";
					break;
				case '6':
					$dia = "SABADO";
					break;
			}

}
else
{
	$fecha = date("Y-m-d");
			switch (date("N"))
			{
				case '1':
					$dia = "LUNES";
					break;
				case '2':
					$dia = "MARTES";
					break;
				case '3':
					$dia = "MIERCOLES";
					break;
				case '4':
					$dia = "JUEVES";
					break;
				case '5':
					$dia = "VIERNES";
					break;
				case '6':
					$dia = "SABADO";
					break;
			}
}

for ($i=0; $i<count($registrosRepartidores)-1 ; $i++)
	{
		$filaSupervisor = $azar->alAzar(0,count($registrosSupervisores)-1);

		//obtiene id y dni de un supervisor al azar
		$idSupervisor = $registrosSupervisores[$filaSupervisor]["Persona_IdSupervisor"];
		$dniSupervisor = $registrosSupervisores[$filaSupervisor]["Persona_DNISupervisor"];

		//obtiene id y dni de un repartidor al azar
		$idRepartidor = $registrosRepartidores[$i]["Persona_IdRepartidor"];
		$dniRepartidor = $registrosRepartidores[$i]["Persona_DNIRepartidor"];

		// Cuántas cargas realiza el repartidor?
		// de 1 a 4 al azar
		$cantidadCargas = $azar->alAzar(1,4);

		$descarga->cargasDescargas($idSupervisor,$idRepartidor,$dniSupervisor,$dniRepartidor, $fecha,$cantidadCargas,$registrosArticulos);


	/*

				Inicio la segunda etapa que consiste en realizar ventas
				a clientes que corresponden con el día de reparto y REPARTIDOR

	*/

	//Devuelve todos los clientes del repartidor de ese día

	}
	
 echo $dia;
 echo "<br>";
	$RegistroClientesRepartidor = $Tabla->obtenerClientesDeRepartidor($dia);

	$ventas->cargaDeVentas($fecha, $RegistroClientesRepartidor );

















	/*

	 	FIN SIMULADOR DE VENTAS
	*/
