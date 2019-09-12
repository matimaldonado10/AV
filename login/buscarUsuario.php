<?php
/*



*/

include_once('../av/path.php');

include_once (path::dirMysql);
class buscarUsuario {

	public function getSupervisor ($usuario)
	{
		$db = new Database();
		$db->connect();

		$usuario = $db->escapeString($usuario);
		//$contraseña = $db->escapeString($contraseña); // Escape any input before insert

  //  $db->select('supervisor','*',NULL,'Usuario= '.$usuario , null, null); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
	$db->select('supervisor','*',NULL,'Usuario="'.$usuario.'"' , null, null);
    $res = $db->getResult();

/*	ESTE CODIGO SIRVE PARA HACER UN DEBUG DE LA CONSULTA SQL
		$debug = $db->getSql();
		echo "muestra la consulta sql para debug ";
		echo "<br>";
		print_r($debug);
		echo "<br>";
*/

		$db->disconnect();
		return $res;

	}

	public function getRepartidor ($usuario)
	{
		$db = new Database();
		$db->connect();

		$usuario = $db->escapeString($usuario);
		//$contraseña = $db->escapeString($contraseña); // Escape any input before insert

  //  $db->select('supervisor','*',NULL,'Usuario= '.$usuario , null, null); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
	  $db->select('repartidor','*',NULL,'Usuario="'.$usuario.'"' , null, null);
    $res = $db->getResult();
		//$res = htmlentities($db->getResult());
		//$string = htmlentities($string, ENT_QUOTES,'UTF-8');
/*	ESTE CODIGO SIRVE PARA HACER UN DEBUG DE LA CONSULTA SQL
		$debug = $db->getSql();
		echo "muestra la consulta sql para debug ";
		echo "<br>";
		print_r($debug);
		echo "<br>";
*/

		$db->disconnect();
		return $res;

	}

}
