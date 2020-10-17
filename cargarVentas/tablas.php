<?php
include_once 'class/mysql_crud.php';

class tablas
{

	public function obtenerClientes()
	{
		$db = new Database();
		$db->connect();
		$db->select('clientesdirectos', 'Persona_IdCliente, Persona_DNICliente', null, null, 'Persona_IdCliente DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
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

	public function obtenerDistribuidores()
	{
		$db = new Database();
		$db->connect();
		$db->select('distribuidores', 'Persona_IdDistribuidor, Persona_DNIDistribuidor', null, null, 'Persona_IdDistribuidor DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
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

	public function obtenerIdVentas()
	{
		$db = new Database();
		$db->connect();
		$Regristros = $db->insert_id;
		$db->disconnect();
		return $Regristros;

	}
}
