<?php
include_once ('/home/mati/git-repositorios/av/obtenerRutaOptima/mainOsrm.php');
include_once ('/home/mati/git-repositorios/av/obtenerRutaOptima/recursosOsrmPrueba.php');

use PHPUnit\Framework\TestCase;

final class solicitarMatrizAlServidorOsrm extends TestCase
{
    /**
     * @test
     */
    public  function crearUnaSolicitudValida()
    {
        $main = new mainOsrm();
        $recurso = new recursosOsrm();

        $this->assertInstanceOF(mainOsrm::Class,$main->setRecursoOsrm($recurso));

        echo "\n";
       $main -> getRecursoOsrm() -> setCantidadDeClientes(5);


        $main->solicitarMatrizAlServidorOsrm();
        

    }

     /**
     * @test
     */
    public  function crearUnaSolicitudInvalida()
    {
        $main = new mainOsrm();
        $recurso = new recursosOsrm();

        $this->expectException(TypeError::class);

        $main->setRecursoOsrm(1456);

        $main->solicitarMatrizAlServidorOsrm();


    }

      /**
     * @test
     */
    public  function crearUnaSolicitudInvalidaConCantidadDeClientesDecimales()
    {
        $main = new mainOsrm();
        $recurso = new recursosOsrm();

        $this->expectOutputString('CANTIDAD DE CLIENTES DEBE SER ENTERA');

        $main->setRecursoOsrm($recurso);

        try {
            $main -> getRecursoOsrm() -> setCantidadDeClientes(2.5);
            $main->solicitarMatrizAlServidorOsrm();
        } catch (Exception $mensaje) {
            echo $mensaje->getMessage();
        }


        


    }

     /**
     * @test
     */
    public  function cambiarLaCantidadDeClientes()
    {
        $main = new mainOsrm();
        $recurso = new recursosOsrm();

        
        $main->setRecursoOsrm($recurso);

        $main -> getRecursoOsrm() -> setCantidadDeClientes(20);

        $main->solicitarMatrizAlServidorOsrm();

        $this->assertCount(21, $main -> getRecursoOsrm() -> getCoordenadasDeClientes());
    
        

    }

     /**
     * @test
     */
    public  function crearMatrizConUnCliente()
    {
        $main = new mainOsrm();
        $recurso = new recursosOsrm();

        
        $main->setRecursoOsrm($recurso);

        $main -> getRecursoOsrm() -> setCantidadDeClientes(1);

        $main->solicitarMatrizAlServidorOsrm();

        $this->assertCount(2, $main -> getRecursoOsrm() -> getCoordenadasDeClientes());
    
        

    }

    /**
     * @test
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