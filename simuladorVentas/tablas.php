<?php
include_once 'C:\xampp\htdocs\test\simuladorVentas\mysql_crud.php';

class tablas
{
	public function obtenerArticulos()
	{
		$db = new Database();
		$db->connect();
		$db->select( 'articulo', 'IdArticulo, Precio', null, null,
			'IdArticulo DESC' ); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$Regristros = $db->getResult();
		$db->disconnect();
		return $Regristros;

	}

	public function obtenerClientes()
	{
		$db = new Database();
		$db->connect();
		$db->select( 'clientesdirectos',
			'Persona_IdCliente, Persona_DNICliente', null, null,
			'Persona_IdCliente DESC' );
		// Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$Regristros = $db->getResult();
		$db->disconnect();
		return $Regristros;

	}

	public function obtenerClientesDeRepartidor( $dia )
	{
		$db = new Database();
		$db->connect();

		$db->select( 'zonadereparto',
			'ClientesDirectos_Persona_IdCliente,
					ClientesDirectos_Persona_DNICliente',
			'clientesdirectos__zonadereparto',
			'ZonaDeReparto_idRutaDeReparto = idRutaDeReparto AND
	 				Dia="' . $dia . '"' );
		// Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$Registros = $db->getResult();
		$db->disconnect();

		return $Registros;

	}

	public function obtenerDistribuidores()
	{
		$db = new Database();
		$db->connect();
		$db->select( 'distribuidores',
			'Persona_IdDistribuidor, Persona_DNIDistribuidor', null
			, null,
			'Persona_IdDistribuidor DESC' ); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$Regristros = $db->getResult();
		$db->disconnect();
		return $Regristros;

	}

	public function obtenerRepartidores()
	{
		$db = new Database();
		$db->connect();
		$db->select( 'repartidor',
			'Persona_IdRepartidor, Persona_DNIRepartidor', null,
			null,
			'Persona_IdRepartidor DESC' ); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$Regristros = $db->getResult();
		$db->disconnect();
		return $Regristros;

	}

	public function obtenerSupervisores()
	{
		$db = new Database();
		$db->connect();
		$db->select( 'supervisor',
			'Persona_IdSupervisor, Persona_DNISupervisor', null,
			null,
			'Persona_IdSupervisor DESC' ); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$Regristros = $db->getResult();
		$db->disconnect();
		return $Regristros;

	}
}
