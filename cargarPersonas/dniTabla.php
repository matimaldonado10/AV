<?php
include_once ('class/mysql_crud.php');

class dniTabla 
{
	
	public function obtenerDniTabla()
	{
		$db = new Database();
		$db->connect();
		$db->select('persona','DNI',NULL,NULL,'DNI DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$dniRegristros = $db->getResult();
		$db->disconnect();
		return $dniRegristros;

		
	}

	
}

