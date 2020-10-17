<?php
include_once 'class/mysql_crud.php';

class tablas
{

	public function obtenerSupervisores()
	{
		$db = new Database();
		$db->connect();
		$db->select('supervisor', 'Persona_IdSupervisor, Persona_DNISupervisor', null, null, 'Persona_IdSupervisor DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$Regristros = $db->getResult();
		$db->disconnect();
		return $Regristros;

	}

	public function obtenerRepartidores()
	{
		$db = new Database();
		$db->connect();
		$db->select('repartidor', 'Persona_IdRepartidor, Persona_DNIRepartidor', null, null, 'Persona_IdRepartidor DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$Regristros = $db->getResult();
		$db->disconnect();
		return $Regristros;

	}

	public function obtenerArticulos()
	{
		$db = new Database();
		$db->connect();
		$db->select('articulo', 'IdArticulo, Precio', null, null, 'IdArticulo DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$Regristros = $db->getResult();
		$db->disconnect();
		return $Regristros;

	}

}
