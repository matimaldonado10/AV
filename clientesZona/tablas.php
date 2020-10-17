<?php
include_once 'class/mysql_crud.php';

class tablas
{

	public function obtenerClientes()
	{
		$db = new Database();
		$db->connect();
		$db->select('clientesdirectos',
				'Persona_IdCliente, Persona_DNICliente', null, null, 'Persona_IdCliente DESC');
		$Registros = $db->getResult();
		$db->disconnect();
		return $Registros;

	}

	public function obtenerZonas()
	{
		$db = new Database();
		$db->connect();
		$db->select('zonadereparto', 'idRutaDeReparto', null, null,
'idRutaDeReparto DESC'); 
		$Registros = $db->getResult();
		$db->disconnect();
		return $Registros;

	}

	public function obtenerClientesZona($idZona)
	{
		$db = new Database();
		$db->connect();
		$db->select('clientesdirectos__zonadereparto',
      'ZonaDeReparto_idRutaDeReparto', null, 'ZonaDeReparto_idRutaDeReparto=' .
$idZona, 'ZonaDeReparto_idRutaDeReparto ASC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$Registros = $db->getResult();
		$db->disconnect();
		return $Registros;

	}

}
