<?php
include_once ('/home/mati/git-repositorios/av/obtenerRutaOptima/areaDeClientes.php');
include_once ('/home/mati/git-repositorios/av/obtenerRutaOptima/coordenadasGeograficas.php');

$area = new areaDeClientes();
$coordenada = new coordenadasGeograficas();

$coordenada = $area->crearCoordenadaAleatoria($coordenada);

echo $coordenada -> getLatitud()."\n";
echo $coordenada -> getLongitud()."\n";
