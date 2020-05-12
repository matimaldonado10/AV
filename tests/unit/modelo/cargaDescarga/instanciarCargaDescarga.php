<?php
include_once('/home/mati/git-repositorios/av/path.php');
include_once(path::dirProyecto.'modelo/cargaDescarga.php');
use PHPUnit\Framework\TestCase;

final class testInstanciarCargaDescarga extends TestCase{

    /**
     * @test
     */

    public function insertarInstanciaVálida(){
       
        $cargaDescarga = cargaDescarga::instanciarCargaDescarga(
            33148074,3,'2019-25-09',1000,0,5,25888999
        );

        $this->assertEquals(33148074, $cargaDescarga->getSupervisor()->getDni());
        $this->assertEquals(3, $cargaDescarga->getSupervisor()->getIdPersona());
        $this->assertEquals('2019-25-09', $cargaDescarga->getFecha());
        $this->assertEquals(1000, $cargaDescarga->getPlataCarga());
        $this->assertEquals(0, $cargaDescarga->getPlataDescarga());
        $this->assertEquals(5, $cargaDescarga->getRepartidor()->getIdPersona());
        $this->assertEquals(25888999, $cargaDescarga->getRepartidor()->getDni());

    }

     /**
     * @test
     */

    public function insertarEntero(){
        $cargaDescarga = new cargaDescarga();
        $cargaDescarga->setPlataDescarga(2000);

        $this->assertEquals(2000, $cargaDescarga->getPlataDescarga());
    }

    
    public function cargarUnEnteroEnDeposito(){
        $cargaDescarga = new cargaDescarga();
        
        $this->expectException(Error::class);

        $cargaDescarga -> setDeposito(145623);

    }

    /**
     * 
     */

    public function probarcustomException(){
        $cargaDescarga = new cargaDescarga();

        $this -> expectOutputString('El array deposito debe contener objetos de tipo coordenadasGeograficas');

        try{
            

        }catch (customException $e){
            echo $e->getMessage();
        }
        
        

    }
    
}