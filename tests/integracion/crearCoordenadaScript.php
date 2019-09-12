<?php
include_once ('/home/mati/git-repositorios/av/tests/integracion/areaDeClientes.php');
include_once ('/home/mati/git-repositorios/av/obtenerRutaOptima/coordenadasGeograficas.php');
include_once ('/home/mati/git-repositorios/av/nogit/mysql_crud.php');
include_once ('/home/mati/git-repositorios/av/modelo/constantesDB.php');

//hacer un for de 1 a 1024

$area = new areaDeClientes();
$coordenada = new coordenadasGeograficas();
$db = new Database();
$db->connect();


for ($i=1025; $i <1027 ; $i++) { 
    $parCoordenado = $area->crearCoordenadaAleatoria($coordenada);
    $arrayClaveValor = array(constantesDB::$direccion_latitud => $parCoordenado->getLatitud(), constantesDB::$direccion_longitud => $parCoordenado->getLongitud());
    $where = constantesDB::$direccion_idPersona . '='.$i;
    $db->update('direccion', $arrayClaveValor, $where );
}




$db->disconnect();



//comprobar
/**echo $db->select('direccion',constantesDB::$direccion_latitud. ' , '. constantesDB::$direccion_longitud,null,constantesDB::$direccion_id . '= 1');
$resultado = $db->getResult();




print_r($resultado) ."\n";

$parCoordenadoAComprobar = coordenadasGeograficas::construirObjetoConLatitudLongitud($resultado[0][constantesDB::$direccion_latitud],$resultado[0][constantesDB::$direccion_longitud]);


echo $parCoordenadoAComprobar->getLatitud() ."\n";
echo $parCoordenadoAComprobar->getLongitud() ."\n";

 */

