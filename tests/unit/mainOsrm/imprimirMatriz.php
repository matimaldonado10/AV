<?php
include_once ('/home/mati/git-repositorios/av/obtenerRutaOptima/mainOsrm.php');
include_once ('/home/mati/git-repositorios/av/obtenerRutaOptima/recursosOsrmPrueba.php');

use PHPUnit\Framework\TestCase;

final class imprimirMatriz extends TestCase
{
    /**
     * @test
     */
    public  function enviarUnaMatrizMultidimensional()
    {
        $main = new mainOsrm();

        $this->assertInstanceOF(mainOsrm::Class,$main);
        
        $matriz = [
            'fruits' => ['apple', 'raspberry', 'pear', 'banana'],
            'vegetables' => ['peas', 'carrots', 'cabbage'],
            'grains' => ['wheat', 'rice', 'oats']
        ];

        $main->imprimirMatriz($matriz);

    }


    /**
     * @test
     */
    public  function enviarUnEntero()
    {
        $main = new mainOsrm();

        $this->expectException(Exception::class);
        $main->imprimirMatriz(142);
    }

     /**
     * @test
     */
    public  function enviarUnString()
    {
        $main = new mainOsrm();

        $this->expectException(Exception::class);
        $main->imprimirMatriz('fasdfadsfasf');
    }

    
}