<?php
include_once ('/home/mati/git-repositorios/av/obtenerRutaOptima/recursosOsrm.php');
include_once ('/home/mati/git-repositorios/av/tests/integracion/areaDeClientes.php');
include_once ('/home/mati/git-repositorios/av/obtenerRutaOptima/coordenadasGeograficas.php');

use PHPUnit\Framework\TestCase;

final class testTraducirCoordenadasParaOsrm extends TestCase{
    /**
     * @test
     */
    public function probarConCoordenadasValidas(){
        $recurso = new recursosOsrm();
        $area = new areaDeClientes();

        $cantidadDeClientes = 10;

        for ($i=0; $i < $cantidadDeClientes ; $i++) { 
            $coordenadaVacia = new coordenadasGeograficas();

           // $nuevaCoordenadaCreada = $area->crearCoordenadaAleatoria($coordenadaVacia);

            $arrayClientes[] =  $area->crearCoordenadaAleatoria($coordenadaVacia);
    
        }

        $this->assertCount(10,$arrayClientes);
        $recurso -> setCoordenadasDeClientes($arrayClientes);
        var_dump($recurso->traducirCoordenadasParaOsrm()) ;

       

    }
}