<?php
declare(strict_types=1);
include_once ("/home/mati/git-repositorios/av/obtenerRutaOptima/coordenadasGeograficas.php");

Use PHPUnit\Framework\TestCase;

Final class construirObjetoConLatitudLongitud extends TestCase
{



    /**
     * @test
     */
    public function conCoordenadasDecimalesCorrectas()
    {
        $this->assertInstanceOf(
            coordenadasGeograficas::class,
            coordenadasGeograficas::construirObjetoConLatitudLongitud(-26.8000,-60.4548)

        );
    }

   
    /**
     * @test
     */
    public function conLetras()
    {

        
        $this->expectException(TypeError::class);
        coordenadasGeograficas::construirObjetoConLatitudLongitud('dsfasdf','asdfsdf');
    }

    /**
     * @test
     */
    public function conCoordenadasEnterasCorrectas()
    {
        $this->assertInstanceOf(
            coordenadasGeograficas::class,
            coordenadasGeograficas::construirObjetoConLatitudLongitud(-26,-60)

        );
    }


    /**
     * @test
     */
    public function comprobarLatitudNulaSiLatitudEsIncorrecta()
    {
        $coordenadas = coordenadasGeograficas::construirObjetoConLatitudLongitud(-26200,-60);

        $this->assertEquals(
            null,
            $coordenadas->getLatitud()
        );

    
    }

    /**
     * @test
     */
    public function comprobarLatitudNulaSiLongitudEsIncorrecta()
    {
        $coordenadas = coordenadasGeograficas::construirObjetoConLatitudLongitud(-26.200,-205);

        $this->assertEquals(
            null,
            $coordenadas->getLatitud()
        );

    
    }

    /**
     * @test
     */
    public function comprobarLongitudNulaSiLatitudEsIncorrecta()
    {
        $coordenadas = coordenadasGeograficas::construirObjetoConLatitudLongitud(-26200,-60);

       
        $this->assertEquals(
            null,
            $coordenadas->getLongitud()
        );
    }

    /**
     * @test
     */
    public function comprobarLongitudNulaSiLongitudEsIncorrecta()
    {
        $coordenadas = coordenadasGeograficas::construirObjetoConLatitudLongitud(-26.200,-181);

        $this->assertEquals(
            null,
            $coordenadas->getLongitud()
        );
    }
   

}