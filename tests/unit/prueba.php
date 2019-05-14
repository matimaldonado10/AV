<?php
declare(strict_types=1);
include_once ("/home/mati/git-repositorios/av/obtenerRutaOptima/areaDeClientes.php");
include_once ("/home/mati/git-repositorios/av/obtenerRutaOptima/coordenadasGeograficas.php");

use PHPUnit\Framework\TestCase;


final class prueba extends TestCase
{
    /**
     * @test
     */
    public function comprobarTrue()
    {
        $areaDeClientes = new areaDeclientes();
        $this->assertEquals(true, $areaDeClientes->esExistenCoordenadasDeZona());
    }

    /**
     * @test
     */
    public function crearCoordenadaAleatoria()
    {
        $areaDeClientes = new areaDeclientes();
        $coordenadas = new coordenadasGeograficas();

        $this->assertInstanceOf(
            coordenadasGeograficas::class,
            $areaDeClientes->crearCoordenadaAleatoria($coordenadas)
        );
        
    }

    public function imprimirCoordenada()
    {
        
    }
    

}