<?php
include_once ('/home/mati/git-repositorios/av/obtenerRutaOptima/recursosOsrm.php');

use PHPUnit\Framework\TestCase;

final class construct extends TestCase{

    /**
     * @test
     */

    public function crearUnObjetoValido(){
        $recurso = new recursosOsrm();

        $this->assertInstanceOf(recursosOsrm::class, $recurso);
    }

    /**
     * @test
     */

    public function verificarLatitudPorDefectoValida(){
        $recurso = new recursosOsrm();
        $arrayDeposito = $recurso-> getDeposito();
        $this->assertEquals(-26.78427, $arrayDeposito [0] -> getLatitud());
    }

    /**
     * @test
     */

    public function verificarLongitudPorDefectoValida(){
        $recurso = new recursosOsrm();
        $arrayDeposito = $recurso-> getDeposito();

        $this->assertEquals(-60.44692, $arrayDeposito [0] -> getLongitud());

        
    }

    /**
     * @test
     */

    public function cargarUnEnteroEnDeposito(){
        $recurso = new recursosOsrm();
        
        $this->expectException(Error::class);

        $recurso -> setDeposito(145623);

    }

      /**
     * @test
     */

    public function cargarUnArrayDeDepositosConLetras(){
        $recurso = new recursosOsrm();

        $this -> expectOutputString('El array deposito debe contener objetos de tipo coordenadasGeograficas');

        try{
            $arrayDeLetras = array ('a', 'b', 'c');
            $recurso -> setDeposito($arrayDeLetras);
            $arrayDeposito = $recurso-> getDeposito();

        }catch (customException $e){
            echo $e->getMessage();
        }
        
        

    }
    
}