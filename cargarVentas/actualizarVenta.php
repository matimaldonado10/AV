<?php
include_once('class/mysql_crud.php');
/**
* 
*/
class actualizar
{
	
	public function actualizarVenta($idVenta, $total)
	{
		$db = new Database();
		$db->connect();
		$db->update('ventas',array('Total'=>$total),'IdVentas='.$idVenta); // Table name, column names and values, WHERE conditions
		$res = $db->getResult();
		print_r($res);
	}
}
