<?php
include_once('/home/mati/git-repositorios/av/path.php');
include_once(path::dirProyecto.'modelo/cargaDescarga.php');
use PHPUnit\Framework\TestCase;

final class testSetPlataDescarga extends TestCase{

    /**
     * @test
     */

    public function insertarPlataDescargaVálida(){
        $cargaDescarga = new cargaDescarga();
        $cargaDescarga->setPlataDescarga(1200.5);

        $this->assertEquals(1200.5, $cargaDescarga->getPlataDescarga());
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