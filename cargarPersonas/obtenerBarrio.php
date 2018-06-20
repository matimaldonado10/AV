<?php
include_once ('class/mysql_crud.php');

class obtenerBarrio 
{
	
	public function obtenerIdTabla($dni)
	{
		$db = new Database();
		$db->connect();
		$db->select('persona','IdPersona',NULL,'DNI='.$dni,'IdPersona DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$dniTabla = $db->getResult();
		return $dniTabla;
		
	}

	public function obtenerBarrios()
	{
		$db = new Database();
		$db->connect();
		$db->select('barrio','IdBarrio',NULL,null,'IdBarrio ASC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$idBarrioTabla = $db->getResult();
		return $idBarrioTabla;
		
	}
	
}

