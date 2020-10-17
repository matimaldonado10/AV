<?php
/*
Permite insertar datos a la tabla cargas y al detalle de cargas

 */
include_once 'C:\xampp\htdocs\test\simuladorVentas\mysql_crud.php';
class insertarCargaDescarga
{
	public function InsertarDetalleCarga( $cantidad, $idCarga, $idArticulo
	) {
		$db = new Database();
		$db->connect();
		$cantidad   = $db->escapeString( $cantidad );
		$idCarga    = $db->escapeString( $idCarga );
		$idArticulo = $db->escapeString( $idArticulo );

		$db->insert( 'detallecargadescarga', array( 'Cantidad' =>
			$cantidad, 'Carga_idCarga' => $idCarga,
			'Articulo_IdArticulo'                                =>
			$idArticulo ) )
		;

		$res = $db->getResult();
		$db->disconnect();
		print_r( $res );
	}

	public function insertarCarga( $fechaCarga, $plata, $idSupervisor,
		$dniSupervisor, $idRepartidor, $dniRepartidor ) {
		$db = new Database();
		$db->connect();

		$fechaCarga    = $db->escapeString( $fechaCarga ); // Escape any input before insert
		$plata         = $db->escapeString( $plata );
		$idSupervisor  = $db->escapeString( $idSupervisor );
		$dniSupervisor = $db->escapeString( $dniSupervisor );
		$idRepartidor  = $db->escapeString( $idRepartidor );
		$dniRepartidor = $db->escapeString( $dniRepartidor );

		$db->insert( 'cargadescarga', array( 'Fecha' => $fechaCarga,
			'Plata'                                    => $plata,
			'Supervisor_Persona_IdSupervisor'          =>
			$idSupervisor,
			'Supervisor_Persona_DNISupervisor'         =>
			$dniSupervisor,
			'Repartidor_Persona_IdRepartidor'          =>
			$idRepartidor,
			'Repartidor_Persona_DNIRepartidor'         =>
			$dniRepartidor ) );

		$res = $db->getResult();
		$db->disconnect();
		print_r( $res );
		//echo "<br> ";
		return $res;

	}
}
