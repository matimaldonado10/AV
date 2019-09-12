<?php
include_once ("/home/mati/git-repositorios/av/tests/integracion/areaDeClientes.php");
include_once ("/home/mati/git-repositorios/av/obtenerRutaOptima/coordenadasGeograficas.php");
use PHPUnit\Framework\TestCase;

final class testCrearCoordenadaAleatoria extends TestCase{
    /**
     * @test
     */
    public function comprobarCoordenadaGeneradaDentroDelArea(){
        $area = new areaDeClientes();
        $coordenadaVacia = new coordenadasGeograficas();

        $coordenadaGenerada = $area -> crearCoordenadaAleatoria($coordenadaVacia);

        $this->assertTrue(
            ($coordenadaGenerada->getLatitud() > -26.8000 && $coordenadaGenerada->getLongitud() > -60.4548)
        );

       
    }

    /**
     * @test
     */
    public function otra(){
        $area = new areaDeClientes();
        $coordenadaVacia = new coordenadasGeograficas();

        $coordenadaGenerada = $area -> crearCoordenadaAleatoria($coordenadaVacia);
        echo $coordenadaGenerada->getLatitud().' '.$coordenadaGenerada->getLongitud();

       
        $this->assertTrue(
            ($coordenadaGenerada->getLatitud() < -26.7680 && $coordenadaGenerada->getLongitud() < -60.4148)
        );

    }
}