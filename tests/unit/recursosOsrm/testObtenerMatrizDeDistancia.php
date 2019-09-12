<?php
include_once ('/home/mati/git-repositorios/av/obtenerRutaOptima/recursosOsrm.php');
include_once ('/home/mati/git-repositorios/av/tests/integracion/areaDeClientes.php');
include_once ('/home/mati/git-repositorios/av/obtenerRutaOptima/coordenadasGeograficas.php');

use PHPUnit\Framework\TestCase;

final class testObtenerMatrizDeDistancia extends TestCase{
    /**
     * @test
     */
    public function probarSolicitudValidaDevuelveArray(){
        $recurso = new recursosOsrm();
        $area = new areaDeClientes();

        $cantidadDeClientes = 10;

        for ($i=0; $i < $cantidadDeClientes ; $i++) { 
            $coordenadaVacia = new coordenadasGeograficas();
            $arrayClientes[] =  $area->crearCoordenadaAleatoria($coordenadaVacia);
        }

        $recurso -> setCoordenadasDeClientes($arrayClientes);
        
        $matriz = $recurso-> obtenerMatrizDeDistancia();

        $this->assertIsArray($matriz);

       
        return $matriz;
        
       
       

    }
    /**
     * @depends probarSolicitudValidaDevuelveArray
     */

    public function testImprimirMatriz(array $matriz){

        $this->assertIsArray($matriz);

        echo "\n";

        if (is_array($matriz)) {
            foreach ($matriz as $key ) {
            foreach ($key as $key2) {
                echo "$key2 ";

            } 
            echo "\n";
            };

            echo "\n";
            

        }else {
            throw new Exception('no existe matriz');
        }   
    }
}