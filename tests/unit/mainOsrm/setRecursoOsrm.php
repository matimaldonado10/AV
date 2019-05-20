<?php
include_once ('/home/mati/git-repositorios/av/obtenerRutaOptima/mainOsrm.php');
include_once ('/home/mati/git-repositorios/av/obtenerRutaOptima/recursosOsrmPrueba.php');

use PHPUnit\Framework\TestCase;

final class setRecursoOsrm extends TestCase
{
    /**
     * @test
     */
    public  function crearUnObjetoValido()
    {
        $main = new mainOsrm();
        $recurso = new recursosOsrm();

        $this->assertInstanceOF(mainOsrm::Class,$main->setRecursoOsrm($recurso));
        

    }

     /**
     * @test
     */
    public  function crearUnObjetoInvalidoConValorEntero()
    {
        $main = new mainOsrm();
        $recurso = new recursosOsrm();

        $this->expectException(TypeError::class);

        $main->setRecursoOsrm(1456);
        

    }

     /**
     * @test
     */
    public  function crearUnObjetoInvalidoConString()
    {
        $main = new mainOsrm();
        $recurso = new recursosOsrm();

        $this->expectException(TypeError::class);

        $main->setRecursoOsrm("jasñldkfjañlksjdflña");
        

    }
}