<?php
include_once ('/home/mati/git-repositorios/av/obtenerRutaOptima/mainOsrm.php');
include_once ('/home/mati/git-repositorios/av/obtenerRutaOptima/recursosOsrm.php');
include_once ('/home/mati/git-repositorios/av/tests/integracion/areaDeClientes.php');
include_once ('/home/mati/git-repositorios/av/obtenerRutaOptima/coordenadasGeograficas.php');

use PHPUnit\Framework\TestCase;

final class solicitarMatrizAlServidorOsrm extends TestCase
{
    /**
     * @test
     */
    public  function crearUnaSolicitudValida()
    {
        echo "\n";

        $main = new mainOsrm();
        $recurso = new recursosOsrm();
        $area = new areaDeClientes();


        for ($indice=0; $indice < 5 ; $indice++) { 
            $coordenadaVacia = new coordenadasGeograficas();
            $arrayClientes[] = $area->crearCoordenadaAleatoria($coordenadaVacia);
        }

        $main->setRecursoOsrm($recurso);
        $main->setArrayClientes($arrayClientes);
        $main->solicitarMatrizAlServidorOsrmConDepositoPorDefecto();

        $this->assertIsArray(
            $main->getMatrizOsrm()
        );

        $this->assertCount(
            6,
            $main->getMatrizOsrm()
        );

        var_dump($main->getMatrizOsrm());
        

    }

     /**
     * @test
     */
    public  function crearUnaSolicitudInvalida()
    {
        $main = new mainOsrm();
        $recurso = new recursosOsrm();

        $this->expectException(Error::class);

        $main->setArrayClientes(array('a','b','c'));
        $main->solicitarMatrizAlServidorOsrmConDepositoPorDefecto();


    }

    

   

     /**
     * @test
     */
    public  function crearMatrizConUnCliente(){
        
        echo "\n";

        $main = new mainOsrm();
        $recurso = new recursosOsrm();
        $area = new areaDeClientes();


        for ($indice=0; $indice < 1 ; $indice++) { 
            $coordenadaVacia = new coordenadasGeograficas();
            $arrayClientes[] = $area->crearCoordenadaAleatoria($coordenadaVacia);
        }

        $main->setRecursoOsrm($recurso);

        $main->setArrayClientes($arrayClientes);
        $main->solicitarMatrizAlServidorOsrmConDepositoPorDefecto();

        $this->assertIsArray(
            $main->getMatrizOsrm()
        );

        $this->assertCount(
            2,
            $main->getMatrizOsrm()
        );

        var_dump($main->getMatrizOsrm());
        

        

    }


    /**
     * 
     * 
     * 
     */
    public  function crearSolicitudSinCantidadDeClientes()
    {
        $main = new mainOsrm();
        $recurso = new recursosOsrm();

        $this->expectOutputString('Mensaje: no existe matriz');

        
        $main->setRecursoOsrm($recurso);
        
        //$main -> getRecursoOsrm() -> setCantidadDeClientes(20);

        $main->solicitarMatrizAlServidorOsrm();

    
        

    }
}