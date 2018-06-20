<?php
/*
	
	RECIBE LOS DATOS DE UNA PERSONA (DNI, APELLIDO, NOMBRE, TELEFONO, MAIL) E INSERTA EN LA TABLA PERSONA DE AQUA VITAL

*/
include_once ('class/mysql_crud.php');
class idVenta {
	

	
	public function obtener ($cantidad, $subtotal, $idVenta, $idArticulo)
	{
		$db = new Database();
		$db->connect();
		$cantidad = $db->escapeString($cantidad);
		$subtotal = $db->escapeString($subtotal); // Escape any input before insert
		$idVenta = $db->escapeString($idVenta);
		$idArticulo = $db->escapeString($idArticulo);
		
		$db->insert('detalleventa',array('Cantidad'=>$cantidad,'SubTotal'=>$subtotal,'Venta_IdVentas'=>$idVenta,'Articulo_IdArticulo'=>$idArticulo));
			
		$db->disconnect();
		//print_r($res);
	}
	
}
