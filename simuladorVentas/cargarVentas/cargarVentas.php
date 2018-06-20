<?php
include_once('insertarVenta.php');

include_once('C:\xampp\htdocs\test\simuladorVentas\tablas.php');
include_once ('C:\xampp\htdocs\test\simuladorVentas\random.php');
include_once('actualizarVenta.php');

/**
 *
 */
class cargarVentas
{

	public function cargaDeVentas($fechaVenta, $registrosClientes)
	{
		$insertar = new insertarTablaVenta();
		$azar = new random();
		$Tabla = new tablas();
		$actualizar = new actualizar();


		$cantidadVentas = 10; // indicas las cantidad de ventas ha generar

		//$registrosClientes = $Tabla->obtenerClientes();
		$registrosRepartidores = $Tabla->obtenerRepartidores();
		$registrosDistribuidores = $Tabla->obtenerDistribuidores();
		$registrosArticulos = $Tabla->obtenerArticulos();

		/*
			Comienza la iteración. En cada una, se inserta una tupla en la tabla "ventas" y también uno o más de una tupla en la "tabla detalle de venta" correspondiente al id de venta.
		*/
/*
		echo "Clientes";
		echo "<br>";
		print_r($registrosClientes);
		echo "<br>";
		echo"Repartidores";
		echo "<br>";
		print_r($registrosRepartidores);
		echo "<br>";
		echo"Distribuidores";
		echo "<br>";
		print_r($registrosDistribuidores);
		echo "<br>";
*/
		for ($i=0; $i<$cantidadVentas ; $i++)
			{

				$cantidadEnvases = $azar->alAzar(0,10);

				$pago = $azar->alAzarPago();
				$total = 0;
				$comprobado = 0;

				$caso = 1;
				switch ($caso)
					// Existen 6 posibles casos de inserción en la tabla de ventas. Se elige uno al azar
				{
				    case 1:
				    	// prepara la venta de un cliente y repartidor

				    	$idDistribuidor = NULL;
				    	$dniDistribuidor = NULL;

						$filaCliente = $azar->alAzar(0,count($registrosClientes)-1);

						$idCliente = $registrosClientes[$filaCliente]["ClientesDirectos_Persona_IdCliente"];
						$dniCliente = $registrosClientes[$filaCliente]["ClientesDirectos_Persona_DNICliente"];

						$filaRepartidor = $azar->alAzar(0,count($registrosRepartidores)-1);



						$idRepartidor = $registrosRepartidores[$filaRepartidor]["Persona_IdRepartidor"];
						$dniRepartidor = $registrosRepartidores[$filaRepartidor]["Persona_DNIRepartidor"];

				       	$RegistroIdVenta =  $insertar->insertarVenta($cantidadEnvases, $fechaVenta, $pago, $idCliente, $dniCliente, $idDistribuidor, $dniDistribuidor, $idRepartidor, $dniRepartidor, $comprobado, $total, $caso);
				       	echo "<br>";
				       	echo "insertado en  ventas. CLIENTE/REPARTIDOR";
				       	echo "<br>";
				        break;
				    case 2:
				    	// prepara la venta de un cliente y distribuidor. Este es un caso no permitido en la BD

				      $idRepartidor = NULL;
				    	$dniRepartidor = NULL;


						$filaCliente = $azar->alAzar(0,count($registrosClientes)-1);

						$idCliente = $registrosClientes[$filaCliente]["Persona_IdCliente"];
						$dniCliente = $registrosClientes[$filaCliente]["Persona_DNICliente"];

						$filaDistribuidor = $azar->alAzar(0,count($registrosDistribuidores)-1);

						$idDistribuidor = $registrosDistribuidores[$filaDistribuidor]["Persona_IdDistribuidor"];
						$dniDistribuidor = $registrosDistribuidores[$filaDistribuidor]["Persona_DNIDistribuidor"];

				       	$RegistroIdVenta =  $insertar->insertarVenta($cantidadEnvases, $fechaVenta, $pago, $idCliente, $dniCliente, $idDistribuidor, $dniDistribuidor, $idRepartidor, $dniRepartidor, $comprobado, $total, $caso);
						echo "<br>";
				       	echo "insertado en  ventas. CLIENTE/DISTRIBUIDOR NO PERMITIDO";
				       	echo "<br>";

				        break;
				    case 3:
				        // prepara la venta de un cliente, distribuidor y repartidor. Este es un caso no permitido en la BD



						$filaCliente = $azar->alAzar(0,count($registrosClientes)-1);

						$idCliente = $registrosClientes[$filaCliente]["Persona_IdCliente"];
						$dniCliente = $registrosClientes[$filaCliente]["Persona_DNICliente"];

						$filaRepartidor = $azar->alAzar(0,count($registrosRepartidores)-1);

						$idRepartidor = $registrosRepartidores[$filaRepartidor]["Persona_IdRepartidor"];
						$dniRepartidor = $registrosRepartidores[$filaRepartidor]["Persona_DNIRepartidor"];

						$filaDistribuidor = $azar->alAzar(0,count($registrosDistribuidores)-1);

						$idDistribuidor = $registrosDistribuidores[$filaDistribuidor]["Persona_IdDistribuidor"];
						$dniDistribuidor = $registrosDistribuidores[$filaDistribuidor]["Persona_DNIDistribuidor"];

				       	$RegistroIdVenta =  $insertar->insertarVenta($cantidadEnvases, $fechaVenta, $pago, $idCliente, $dniCliente, $idDistribuidor, $dniDistribuidor, $idRepartidor, $dniRepartidor, $comprobado, $total, $caso);

				       	echo "<br>";
				       	echo "insertado en  ventas. CLIENTE/REPARTIDOR/REPARTIDOR NO PERMITIDO";
				       	echo "<br>";

				        break;

				    case 4:

				        // prepara la venta de un cliente. Este caso simula la venta en el negocio

				    	$idDistribuidor = null;
				    	$dniDistribuidor = null;

				    	$idRepartidor = null;
				    	$dniRepartidor = null;


						$filaCliente = $azar->alAzar(0,count($registrosClientes)-1);

						$idCliente = $registrosClientes[$filaCliente]["Persona_IdCliente"];
						$dniCliente = $registrosClientes[$filaCliente]["Persona_DNICliente"];



				       	$RegistroIdVenta =  $insertar->insertarVenta($cantidadEnvases, $fechaVenta, $pago, $idCliente, $dniCliente, $idDistribuidor, $dniDistribuidor, $idRepartidor, $dniRepartidor, $comprobado, $total, $caso);
						echo "<br>";
				       	echo "insertado en  ventas. CLIENTE";
				       	echo "<br>";

				        break;

				    case 5:
				         // prepara la venta de un Repartidor. Este es un caso no permitido en la BD

				    	$idDistribuidor = null;
				    	$dniDistribuidor = null;

				    	$idCliente = null;
				    	$dniCliente = null;


						$filaRepartidor = $azar->alAzar(0,count($registrosRepartidores)-1);

						$idRepartidor = $registrosRepartidores[$filaRepartidor]["Persona_IdRepartidor"];
						$dniRepartidor = $registrosRepartidores[$filaRepartidor]["Persona_DNIRepartidor"];




				       	$RegistroIdVenta =  $insertar->insertarVenta($cantidadEnvases, $fechaVenta, $pago, $idCliente, $dniCliente, $idDistribuidor, $dniDistribuidor, $idRepartidor, $dniRepartidor, $comprobado, $total, $caso);
				       	echo "<br>";
				       	echo "insertado en  ventas. REPARTIDOR NO PERMITIDO";
				       	echo "<br>";

				        break;

				    case 6:

				        // prepara la venta de un repartidor y distribuidor.

				        $idCliente = null;
				    	$dniCliente = null;


						$filaDistribuidor = $azar->alAzar(0,count($registrosDistribuidores)-1);

						$idDistribuidor = $registrosDistribuidores[$filaDistribuidor]["Persona_IdDistribuidor"];
						$dniDistribuidor = $registrosDistribuidores[$filaDistribuidor]["Persona_DNIDistribuidor"];

						$filaRepartidor = $azar->alAzar(0,count($registrosRepartidores)-1);

						$idRepartidor = $registrosRepartidores[$filaRepartidor]["Persona_IdRepartidor"];
						$dniRepartidor = $registrosRepartidores[$filaRepartidor]["Persona_DNIRepartidor"];

				       	$RegistroIdVenta =  $insertar->insertarVenta($cantidadEnvases, $fechaVenta, $pago, $idCliente, $dniCliente, $idDistribuidor, $dniDistribuidor, $idRepartidor, $dniRepartidor, $comprobado, $total, $caso);

				       	echo "<br>";
				       	echo "insertado en  ventas. DISTRIBUIDOR/REPARTIDOR";
				       	echo "<br>";

				        break;

				    case 7:

				        // prepara la venta de un distribuidor.

				      $idCliente = null;
				    	$dniCliente = null;
				    	$idRepartidor = null;
				    	$dniRepartidor = null;


						$filaDistribuidor = $azar->alAzar(0,count($registrosDistribuidores)-1);

						$idDistribuidor = $registrosDistribuidores[$filaDistribuidor]["Persona_IdDistribuidor"];
						$dniDistribuidor = $registrosDistribuidores[$filaDistribuidor]["Persona_DNIDistribuidor"];

						$RegistroIdVenta =  $insertar->insertarVenta($cantidadEnvases, $fechaVenta, $pago, $idCliente, $dniCliente, $idDistribuidor, $dniDistribuidor, $idRepartidor, $dniRepartidor, $comprobado, $total, $caso);

						echo "<br>";
				       	echo "insertado en  ventas. DISTRIBUIDOR";
				       	echo "<br>";


				        break;
				}

				// obtengo el id de la última consulta a la BD
				//$RegistroIdVenta = $Tabla->obtenerIdVentas();
				echo "<br>";
				//print_r($RegistroIdVenta);
				// cantidad de inserciones en la tabla Detalle Venta
				$iteracionDetalle = $azar->alAzar(1,2);
				$idVenta = $RegistroIdVenta[0];


				//print_r($registrosArticulos);


				for ($x=0; $x < $iteracionDetalle ; $x++)
					{


						$indice = $azar->alAzar(0,count($registrosArticulos)-1);
						$idArticulo = $registrosArticulos[$indice]["IdArticulo"];
						$CantidadDetalle = $azar->alAzar(1,10);
						$subtotal = $CantidadDetalle * $registrosArticulos[$indice]["Precio"];
						$total = $total + $subtotal;
						$insertar->InsertarDetalleVenta($CantidadDetalle, $subtotal, $idVenta, $idArticulo);

					}

				$actualizar->actualizarVenta($idVenta, $total);


			/*

			 	FIN FOR VENTAS
			*/

			}


	}


}
