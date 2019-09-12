<?php
include_once ('/home/mati/git-repositorios/av/obtenerRutaOptima/rutaOptima.php');

use PHPUnit\Framework\TestCase;

final class testIniciarBusquedaDeRutasOptimas extends TestCase{


    /**
     * @test
     */
    public function crearPruebaValida(){
        $rutaOptima = new rutaOptima();
        $this->assertTrue($rutaOptima->IniciarBusquedaDeRutasOptimas());
    }
}