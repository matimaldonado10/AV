<?php
/*

RECIBE LOS DATOS DE UNA PERSONA (DNI, APELLIDO, NOMBRE, TELEFONO, MAIL) E INSERTA EN LA TABLA PERSONA DE AQUA VITAL

 */
include_once 'class/mysql_crud.php';
class insertarZonaRepartidor
{

	public function insertarZona($dias, $idRepartidor, $dniRepartidor)
	{
		$db = new Database();
		$db->connect();

		$dias = $db->escapeString($dias); // Escape any input before insert
		$idRepartidor = $db->escapeString($idRepartidor);
		$dniRepartidor = $db->escapeString($dniRepartidor);

		$db->insert('zonadereparto', array('Dia' => $dias, 'Repartidor_Persona_IdRepartidor' => $idRepartidor, 'Repartidor_Persona_DNIRepartidor' => $dniRepartidor));

		$res = $db->getResult();
		$db->disconnect();
		print_r($res);
		echo "<br> ";

	}

}
