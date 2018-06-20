<?php
/*

	RECIBE LOS DATOS DE UNA PERSONA (DNI, APELLIDO, NOMBRE, TELEFONO, MAIL) E INSERTA EN LA TABLA PERSONA DE AQUA VITAL

*/
include_once ('C:\xampp\htdocs\test\simuladorVentas\mysql_crud.php');
class insertarTablaVenta {




	public function insertarVenta($envasesVacios, $fechaVenta, $pago, $idCliente, $dniCliente, $idDistribuidor, $dniDistribuidor, $idRepartidor, $dniRepartidor, $comprobado, $total, $caso)
	{
		$db = new Database();
		$db->connect();
		$envasesVacios = $db->escapeString($envasesVacios);
		$fechaVenta = $db->escapeString($fechaVenta); // Escape any input before insert
		$pago = $db->escapeString($pago);
		$idCliente = $db->escapeString($idCliente);
		$dniCliente = $db->escapeString($dniCliente);
		$idDistribuidor = $db->escapeString($idDistribuidor);
		$dniDistribuidor = $db->escapeString($dniDistribuidor); // Escape any input before insert
		$idRepartidor = $db->escapeString($idRepartidor);
		$dniRepartidor = $db->escapeString($dniRepartidor);
		$comprobado = $db->escapeString($comprobado);
		$total = $db->escapeString($total);


		switch ($caso) {
			case '1':
				$db->insert('ventas',array('EnvasesVacios'=>$envasesVacios,'Fecha'=>$fechaVenta,'Pago'=>$pago,'ClienteDirecto_Persona_IdCliente'=>$idCliente,'ClienteDirecto_Persona_DNICliente'=>$dniCliente,'Repartidor_Persona_IdRepartidor'=>$idRepartidor,'Repartidor_Persona_DNIRepartidor'=>$dniRepartidor,'Comprobado'=>$comprobado,'Total'=>$total));
				break;

			case '2':
				$db->insert('ventas',array('EnvasesVacios'=>$envasesVacios,'Fecha'=>$fechaVenta,'Pago'=>$pago,'ClienteDirecto_Persona_IdCliente'=>$idCliente,'ClienteDirecto_Persona_DNICliente'=>$dniCliente,'Distribuidores_Persona_IdDistribuidor'=>$idDistribuidor,'Distribuidores_Persona_DNIDistribuidor'=>$dniDistribuidor,'Comprobado'=>$comprobado,'Total'=>$total));
				break;

			case '3':
				$db->insert('ventas',array('EnvasesVacios'=>$envasesVacios,'Fecha'=>$fechaVenta,'Pago'=>$pago,'ClienteDirecto_Persona_IdCliente'=>$idCliente,'ClienteDirecto_Persona_DNICliente'=>$dniCliente,'Distribuidores_Persona_IdDistribuidor'=>$idDistribuidor,'Distribuidores_Persona_DNIDistribuidor'=>$dniDistribuidor,'Repartidor_Persona_IdRepartidor'=>$idRepartidor,'Repartidor_Persona_DNIRepartidor'=>$dniRepartidor,'Comprobado'=>$comprobado,'Total'=>$total));
				break;

			case '4':
				$db->insert('ventas',array('EnvasesVacios'=>$envasesVacios,'Fecha'=>$fechaVenta,'Pago'=>$pago,'ClienteDirecto_Persona_IdCliente'=>$idCliente,'ClienteDirecto_Persona_DNICliente'=>$dniCliente,'Comprobado'=>$comprobado,'Total'=>$total));
				break;

			case '5':
				$db->insert('ventas',array('EnvasesVacios'=>$envasesVacios,'Fecha'=>$fechaVenta,'Pago'=>$pago,'Repartidor_Persona_IdRepartidor'=>$idRepartidor,'Repartidor_Persona_DNIRepartidor'=>$dniRepartidor,'Comprobado'=>$comprobado,'Total'=>$total));
				break;

			case '6':
				$db->insert('ventas',array('EnvasesVacios'=>$envasesVacios,'Fecha'=>$fechaVenta,'Pago'=>$pago,'Repartidor_Persona_IdRepartidor'=>$idRepartidor,'Repartidor_Persona_DNIRepartidor'=>$dniRepartidor, 'Distribuidores_Persona_IdDistribuidor'=>$idDistribuidor,'Distribuidores_Persona_DNIDistribuidor'=>$dniDistribuidor,'Comprobado'=>$comprobado,'Total'=>$total));
				break;

			case '7':
				$db->insert('ventas',array('EnvasesVacios'=>$envasesVacios,'Fecha'=>$fechaVenta,'Pago'=>$pago,'Distribuidores_Persona_IdDistribuidor'=>$idDistribuidor,'Distribuidores_Persona_DNIDistribuidor'=>$dniDistribuidor,'Comprobado'=>$comprobado,'Total'=>$total));
				break;
		}





		$res = $db->getResult();
		$db->disconnect();
		print_r($res);
		echo "<br> ";
		return $res;






	}


	public function InsertarDetalleVenta ($cantidad, $subtotal, $idVenta, $idArticulo)
	{
		$db = new Database();
		$db->connect();
		$cantidad = $db->escapeString($cantidad);
		$subtotal = $db->escapeString($subtotal); // Escape any input before insert
		$idVenta = $db->escapeString($idVenta);
		$idArticulo = $db->escapeString($idArticulo);

		$db->insert('detalleventa',array('Cantidad'=>$cantidad,'SubTotal'=>$subtotal,'Venta_IdVentas'=>$idVenta,'Articulo_IdArticulo'=>$idArticulo));

		$res = $db->getResult();
		$db->disconnect();
		echo "<br>";
		echo "insertado en  detalleventa ";
		echo "<br>";
		print_r($res);
		echo "<br>";

	}

}
