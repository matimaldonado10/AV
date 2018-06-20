<?php
/*
	Clase modificada de la original cargarDescargar
	Para esta se añadió una función cargarDescargar que recibe parámetros

*/

include_once('insertarCargaDescarga.php');//Permite insertar datos a la tabla cargas y al detalle de cargas
include_once ('C:\xampp\htdocs\test\simuladorVentas\random.php');// random permite devolver valores aleatorios, fechas y plata aleatoria

class cargarDescargar
{

	public function cargasDescargas($idSupervisor,$idRepartidor,$dniSupervisor,$dniRepartidor, $fechaCarga,$cantidadCargas, array $registrosArticulos)
	{
		$insertar = new insertarCargaDescarga();
		$azar = new random();
		//echo "<br>";

		for ($i=0; $i<$cantidadCargas ; $i++)
			{


				$plata = $azar->alAzarPlata();
				//RegistroIdCarga tiene el id de la tupla donde fue insertado
				$RegistroIdCarga =  $insertar->insertarCarga($fechaCarga, $plata, $idSupervisor, $dniSupervisor, $idRepartidor, $dniRepartidor);
				echo "<br>";
				echo "insertado en  cargas";


				echo "<br>";
				//print_r($RegistroIdCarga);
				// cantidad de inserciones en la tabla Detalle Venta
				$iteracionDetalle = $azar->alAzar(1,2);
				$idCarga = $RegistroIdCarga[0];




				for ($x=0; $x < $iteracionDetalle ; $x++)
					{


						$indice = $azar->alAzar(0,count($registrosArticulos)-1);
						$idArticulo = $registrosArticulos[$indice]["IdArticulo"];
						$CantidadDetalle = $azar->alAzar(1,10);// es la cantidad que se le vendio por un artículo
						$insertar->InsertarDetalleCarga($CantidadDetalle, $idCarga, $idArticulo);
					}


					echo "fin carga detalle de carga";
					echo "<br> ";
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
	}



}
