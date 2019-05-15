<?php
include_once ('/home/mati/git-repositorios/av/obtenerRutaOptima/areaDeClientes.php');
include_once ('/home/mati/git-repositorios/av/obtenerRutaOptima/coordenadasGeograficas.php');

$area = new areaDeClientes();
$coordenada = new coordenadasGeograficas();

$obj = $area->crearCoordenadaAleatoria($coordenada);

echo $obj -> getLatitud()."\n";
echo $obj -> getLongitud()."\n";
