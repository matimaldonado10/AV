<?php
include_once ('mysql_crud.php');
class tablas
{

	public function obtenerClientes()
	{
		$db = new Database();
		$db->connect();
		$db->select('clientesdirectos','Persona_IdCliente, Persona_DNICliente',NULL,NULL,'Persona_IdCliente DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$Regristros = $db->getResult();
		$db->disconnect();
		return $Regristros;


	}

	public function obtenerSupervisores()
	{
		$db = new Database();
		$db->connect();
		$db->select('supervisor','Persona_IdSupervisor, Persona_DNISupervisor',NULL,NULL,'Persona_IdSupervisor DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$Regristros = $db->getResult();
		$db->disconnect();
		return $Regristros;


	}

	public function obtenerRepartidores()
	{
		$db = new Database();
		$db->connect();
		$db->select('repartidor','Persona_IdRepartidor, Persona_DNIRepartidor',NULL,NULL,'Persona_IdRepartidor DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$Regristros = $db->getResult();
		$db->disconnect();
		return $Regristros;


	}



	public function obtenerArticulos()
	{
		$db = new Database();
		$db->connect();
		$db->select('articulo','IdArticulo, Precio',NULL,NULL,'IdArticulo DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$Regristros = $db->getResult();
		$db->disconnect();
		return $Regristros;


	}

	public function obtenerDistribuidores()
	{
		$db = new Database();
		$db->connect();
		$db->select('distribuidores','Persona_IdDistribuidor, Persona_DNIDistribuidor',NULL,NULL,'Persona_IdDistribuidor DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$Regristros = $db->getResult();
		$db->disconnect();
		return $Regristros;


	}


	public function obtenerClientesDeRepartidor($dni)
	{
		$db = new Database();
		$db->connect();

		$db->select('zonadereparto','clientesdirectos__zonadereparto.ClientesDirectos_Persona_IdCliente, clientesdirectos__zonadereparto.ClientesDirectos_Persona_DNICliente, persona.Apellido, persona.Nombre, persona.Telefono, persona.Email, direccion.Direccion, direccion.Referencia, barrio.Barrio, zonadereparto.Dia','clientesdirectos__zonadereparto JOIN persona JOIN direccion JOIN barrio','zonadereparto.Repartidor_Persona_DNIRepartidor="'.$dni.'" AND clientesdirectos__zonadereparto.ZonaDeReparto_idRutaDeReparto= zonadereparto.idRutaDeReparto and clientesdirectos__zonadereparto.ClientesDirectos_Persona_IdCliente = persona.IdPersona AND clientesdirectos__zonadereparto.ClientesDirectos_Persona_DNICliente = persona.DNI AND direccion.Persona_IdPersona=persona.IdPersona AND direccion.Persona_DNI=persona.DNI and barrio.IdBarrio=direccion.Barrio_IdBarrio');
			// Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$Registros = $db->getResult();
		$db->disconnect();
		print_r($Registros, "/n");

		return $Registros;


	}
/*
	public function obtenerClientesDeRepartidor($dni)
	{
		$db = new Database();
		$db->connect();

		$db->select('zonadereparto','ClientesDirectos_Persona_IdCliente, ClientesDirectos_Persona_DNICliente, Apellido, Nombre, Telefono, Email, Direccion, Referencia, Barrio','clientesdirectos__zonadereparto JOIN persona JOIN direccion JOIN barrio JOIN ventas','zonadereparto.Repartidor_Persona_DNIRepartidor="'.$dni.'"');
			// Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$Registros = $db->getResult();
		$db->disconnect();


		return $Registros;


	}
*/

public function obtenerDiasDeRepartos($dni)
{
	$db = new Database();
	$db->connect();

	$db->select('zonadereparto','Dia, Orden','clientesdirectos__zonadereparto','zonadereparto.Repartidor_Persona_DNIRepartidor="'.$dni.'" AND clientesdirectos__zonadereparto.ZonaDeReparto_idRutaDeReparto= zonadereparto.idRutaDeReparto and clientesdirectos__zonadereparto.ClientesDirectos_Persona_IdCliente = persona.IdPersona AND clientesdirectos__zonadereparto.ClientesDirectos_Persona_DNICliente = persona.DNI AND direccion.Persona_IdPersona=persona.IdPersona AND direccion.Persona_DNI=persona.DNI and barrio.IdBarrio=direccion.Barrio_IdBarrio');
		// Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
	$Registros = $db->getResult();
	$db->disconnect();
	print_r($Registros, "/n");

	return $Registros;


}

}
