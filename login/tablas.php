<?php
include_once('../path.php');

include_once (path::dirMysql);
include_once (path::dirConstantesDB);
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

		$where = constantesDB::$repartidor_id.' = '.constantesDB::$persona_id.' AND  '.constantesDB::$repartidor_dni.' = '.constantesDB::$persona_dni;


		$db->select('repartidor','Persona_IdRepartidor, Persona_DNIRepartidor, Nombre, Apellido','persona',$where,'Persona_IdRepartidor DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$Regristros = $db->getResult();
		$db->disconnect();

		return $Regristros;


	}



	public function obtenerArticulos()
	{
		$db = new Database();
		$db->connect();
		$db->select('articulo','IdArticulo, Nombre, Precio',NULL,NULL,'IdArticulo ASC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
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
		$where = constantesDB::$diaDeReparto_id.' = '.constantesDB::$clientesDirectosDiaDeReparto_idRutaDeReparto.' AND  '.constantesDB::$clientesDirectosDiaDeReparto_dniCliente.' = '.constantesDB::$persona_dni.'  AND '.constantesDB::$persona_id.' = '.constantesDB::$clientesDirectosDiaDeReparto_idCliente.' AND direccion.Persona_DNI = persona.DNI AND barrio.IdBarrio = direccion.Barrio_IdBarrio AND  persona.DNI  IN (SELECT DISTINCT persona.DNI FROM diadereparto JOIN clientesdirectos__diadereparto JOIN persona JOIN direccion JOIN barrio ON diadereparto.idRutaDeReparto =  clientesdirectos__diadereparto.ZonaDeReparto_idRutaDeReparto AND clientesdirectos__diadereparto.ClientesDirectos_Persona_DNICliente = persona.DNI AND persona.IdPersona = clientesdirectos__diadereparto.ClientesDirectos_Persona_IdCliente AND direccion.Persona_DNI = persona.DNI AND barrio.IdBarrio = direccion.Barrio_IdBarrio WHERE diadereparto.Repartidor_Persona_DNIRepartidor = "'.$dni.'") ';

		$db->select('persona','DISTINCT persona.IdPersona, persona.DNI, persona.Apellido, persona.Nombre, persona.Telefono, persona.Email, direccion.Direccion, direccion.Referencia, barrio.Nombre as Barrio, diadereparto.Dia','direccion JOIN barrio JOIN clientesdirectos__diadereparto JOIN diadereparto',$where);
				// Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$Registros = $db->getResult();
		$db->disconnect();
		//print_r($Registros, "/n");

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

	public function obtenerDiasDeReparto($dni)

	{

		$db = new Database();

		$db->connect();



		$db->select('zonadereparto','Dia, Orden','clientesdirectos__zonadereparto','clientesdirectos__zonadereparto.ClientesDirectos_Persona_DNICliente="'.$dni.'" AND zonadereparto.idRutaDeReparto = clientesdirectos__zonadereparto.ZonaDeReparto_idRutaDeReparto');

			// Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions

		$Registros = $db->getResult();

		$db->disconnect();

		//print_r($Registros, "/n");



		return $Registros;





	}



}
