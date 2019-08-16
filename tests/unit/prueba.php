<?php
declare(strict_types=1);
include_once ("/home/mati/git-repositorios/av/tests/integracion/areaDeClientes.php");
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
            $obj = $areaDeClientes->crearCoordenadaAleatoria($coordenadas)
        );


echo $obj -> getLatitud()."\n";
echo $obj -> getLongitud()."\n";

        
    }

    public function imprimirCoordenada()
    {
        
    }
    

}