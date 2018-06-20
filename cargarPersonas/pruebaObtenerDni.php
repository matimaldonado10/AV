<?php
include_once ('class/mysql_crud.php');
$dni = 24256852;
$db = new Database();
		$db->connect();
		$db->select('persona','IdPersona',NULL,'DNI='.$dni,'IdPersona DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$dniTabla = $db->getResult();
		//return $dniTabla;
		print_r($dniTabla);