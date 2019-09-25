<?php
/*
	
	RECIBE LOS DATOS DE UNA PERSONA (DNI, APELLIDO, NOMBRE, TELEFONO, MAIL) E INSERTA EN LA TABLA PERSONA DE AQUA VITAL

*/
include_once('/home/mati/git-repositorios/av/path.php');
include_once(path::dirMysql);
include_once(path::dirConstantesDB);
class insertarCargaDescarga {
	

	

	public function insertarCarga($fechaCarga, $plataCarga, $plataDescarga, $idSupervisor, $dniSupervisor, $idRepartidor, $dniRepartidor)
	{
		$db = new Database();
		$db->connect();
		
		$fechaCarga = $db->escapeString($fechaCarga); // Escape any input before insert
		$plataCarga = $db->escapeString($plataCarga);
		$plataDescarga = $db->escapeString($plataDescarga);
		$idSupervisor = $db->escapeString($idSupervisor);
		$dniSupervisor = $db->escapeString($dniSupervisor);
		$idRepartidor = $db->escapeString($idRepartidor);
		$dniRepartidor = $db->escapeString($dniRepartidor);
		
		

		$db->insert('cargadescarga',array('Fecha'=>$fechaCarga,'PlataCarga'=>$plataCarga,'PlataDescarga'=>$plataDescarga,'Supervisor_Persona_IdSupervisor'=>$idSupervisor,'Supervisor_Persona_DNISupervisor'=>$dniSupervisor,'Repartidor_Persona_IdRepartidor'=>$idRepartidor,'Repartidor_Persona_DNIRepartidor'=>$dniRepartidor));
			
			
		
		

		
		$res = $db->getResult(); 	
		$db->disconnect();
		print_r($res);
		echo "<br> ";
		return $res;



		
		
		
	}


	public function InsertarDetalleCarga($carga, $idCarga, $idArticulo, $descarga)
	{
		$db = new Database();
		$db->connect();
		$carga = $db->escapeString($carga);
		$descarga = $db->escapeString($descarga);
		$idCarga = $db->escapeString($idCarga);
		$idArticulo = $db->escapeString($idArticulo);
		
		$db->insert('detallecargadescarga',array( constantesDB::$detalleCargaDescarga_carga => $carga,'Carga_idCarga'=>$idCarga,'Articulo_IdArticulo'=>$idArticulo,constantesDB::$detalleCargaDescarga_descarga => $descarga));

		$res = $db->getResult();	
		$db->disconnect();
		print_r($res);
	}
	
}
