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
		$where = 'zonadereparto.idRutaDeReparto =  clientesdirectos__zonadereparto.ZonaDeReparto_idRutaDeReparto AND  clientesdirectos__zonadereparto.ClientesDirectos_Persona_DNICliente = persona.DNI AND persona.IdPersona = clientesdirectos__zonadereparto.ClientesDirectos_Persona_IdCliente AND direccion.Persona_DNI = persona.DNI AND barrio.IdBarrio = direccion.Barrio_IdBarrio AND  persona.DNI  IN (SELECT DISTINCT persona.DNI FROM zonadereparto JOIN clientesdirectos__zonadereparto JOIN persona JOIN direccion JOIN barrio ON zonadereparto.idRutaDeReparto =  clientesdirectos__zonadereparto.ZonaDeReparto_idRutaDeReparto AND clientesdirectos__zonadereparto.ClientesDirectos_Persona_DNICliente = persona.DNI AND persona.IdPersona = clientesdirectos__zonadereparto.ClientesDirectos_Persona_IdCliente AND direccion.Persona_DNI = persona.DNI AND barrio.IdBarrio = direccion.Barrio_IdBarrio WHERE zonadereparto.Repartidor_Persona_DNIRepartidor = "'.$dni.'") ';

		$db->select('persona','DISTINCT persona.IdPersona, persona.DNI, persona.Apellido, persona.Nombre, persona.Telefono, persona.Email, direccion.Direccion, direccion.Referencia, barrio.Barrio, zonadereparto.Dia','direccion JOIN barrio JOIN clientesdirectos__zonadereparto JOIN zonadereparto',$where);
				// Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$Registros = $db->getResult();
		$db->disconnect();
		//print_r($Registros, "/n");

		return $Registros;


	}




}
