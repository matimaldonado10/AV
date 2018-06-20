<?php
/*
	
	RECIBE LOS DATOS DE UNA PERSONA (DNI, APELLIDO, NOMBRE, TELEFONO, MAIL) E INSERTA EN LA TABLA PERSONA DE AQUA VITAL

*/
include_once ('class/mysql_crud.php');
class insertarClienteZona{
	

	

	public function insertarClienteEnZona($Orden, $idCliente, $dniCliente, $idZonaReparto)
	{
		$db = new Database();
		$db->connect();
		
		$Orden = $db->escapeString($Orden); // Escape any input before insert
		$idCliente = $db->escapeString($idCliente);
		$dniCliente = $db->escapeString($dniCliente);
		$idZonaReparto = $db->escapeString($idZonaReparto);
		

		$db->insert('clientesdirectos__zonadereparto',array('ClientesDirectos_Persona_IdCliente'=>$idCliente,'ClientesDirectos_Persona_DNICliente'=>$dniCliente, 'ZonaDeReparto_idRutaDeReparto'=>$idZonaReparto,'Orden'=>$Orden));
			
			
		
		

		
		$res = $db->getResult(); 	
		$db->disconnect();
		print_r($res);
		echo "<br> ";
		



		
		
		
	}



	
}
