<?php
/**
 * ESTO ES UNA PRUEBA PARA OBTENER UNA MATRIZ DE DISTACIA DE X CANTIDAD DE CLIENTES
 * LOS CLIENTES NO SON REALES
 * TODOS LAS COORDENADAS SON CREADAS DE FORMA ALEATORIA
 */
include_once ("recursosOsrmPrueba.php");
$recursoOsrm = new recursosOsrm;


$recursoOsrm->setCantidadDeClientes(10);
$matriz = $recursoOsrm-> obtenerMatrizDeDistancia();

if (is_array($matriz)) {
    foreach ($matriz as $key ) {
       foreach ($key as $key2) {
        echo "$key2 ";

       } 
       echo "<br>";
    };

    echo "<br>";
    foreach ($recursoOsrm->getCoordenadasDeClientes() as $indice) {
        echo "$indice<br> ";
    }

}else {
echo "le erraste algo";
}

