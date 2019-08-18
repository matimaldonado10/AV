<?php
class dataSet {
    private $nombre;
    private $tipoDeProblema;
    private $tipoDePeso;
    private $nodosClientes;
    private $depositos;
    private $demandaDeClientes;
    private $unidadDeMedida;
    private $matrizDeClientes;
    private $dimension;
    private $capacidad;
    private $formatoDePeso;
    private $comentario;
    private $cantidadDeVehiculos;

    public function _construct(){

    }

    public static function construirInstanciaConParametros(
        $nombre, $tipoDeProblema, $tipoDePeso,
        $nodosClientes, $depositos, $demandaDeClientes,
        $unidadDeMedida, $matrizDeClientes, $dimension,
        $capacidad, $formatoDePeso, $comentario, $cantidadDeVehiculos){
        
        $instancia = new self();

        $instancia->setNombre($nombre);
        $instancia->setTipoDeProblema($tipoDeProblema);
        $instancia->setTipoDePeso($tipoDePeso);
        $instancia->setNodosClientes($nodosClientes);
        $instancia->setDepositos($depositos);
        $instancia->setDemandaDeClientes($demandaDeClientes);
        $instancia->setUnidadDeMedida($unidadDeMedida);
        $instancia->setMatrizDeClientes($matrizDeClientes);
        $instancia->setDimension($dimension);
        $instancia->setCapacidad($capacidad);
        $instancia->setFormatoDePeso($formatoDePeso);
        $instancia->setComentario($comentario);
        $instancia->setCantidadDeVehiculos($cantidadDeVehiculos);


		

		
		return $instancia;
	}

    public function crearArchivoDataSet(){
        /**PORHACER
         * 
         * nombrar al archivo con
         * n=cantidad de nodos
         * k = cantidad de vehículos
         */


        
        $fp = fopen("/home/mati/git-repositorios/av/obtenerRutaOptima/".$this->getNombre()."-n".$this->getDimension()."-k".$this->getCantidadDeVehiculos().".vrp","w");
        fwrite($fp, 'NAME: '.$this->getNombre().PHP_EOL );
        fwrite($fp, 'COMMENT: '.$this->getComentario().PHP_EOL  );
        fwrite($fp, 'TYPE: '.$this->getTipoDeProblema().PHP_EOL  );
        fwrite($fp, 'DIMENSION: '.$this->getDimension().PHP_EOL  );
        fwrite($fp, 'EDGE_WEIGHT_TYPE: '.$this->getTipoDePeso().PHP_EOL  );
        fwrite($fp, 'EDGE_WEIGHT_FORMAT: '.$this->getFormatoDePeso().PHP_EOL  );
        fwrite($fp, 'EDGE_WEIGHT_UNIT_OF_MEASUREMENT: '.$this->getUnidadDeMedida().PHP_EOL  );
        fwrite($fp, 'CAPACITY: '.$this->getCapacidad().PHP_EOL  );
        fwrite($fp, 'NODE_COORD_SECTION'.PHP_EOL  );

        for ($i=0; $i <count($this->getNodosClientes()) ; $i++) { 
            fwrite($fp, $i.' '.$this->getNodosClientes()[$i][0]->getLatitud().' '.$this->getNodosClientes()[$i][0]->getLongitud().' '.$this->getNodosClientes()[$i][1].PHP_EOL  );

        }

        fwrite($fp, 'EDGE_WEIGHT_SECTION'.PHP_EOL  );

        $matriz = $this->getMatrizDeClientes();
       

        for ($i=0; $i <count($matriz) ; $i++) { 
           $fila = $matriz[$i];
            
           for ($columna=0; $columna < count($fila); $columna++) { 
            $resultado = $fila[$columna] / 1000;
            fwrite($fp, $resultado.' ');
           }
           fwrite($fp, PHP_EOL  );


       }

       fwrite($fp, 'DEMAND_SECTION'.PHP_EOL  );

       for ($i=0; $i <count($this->getNodosClientes()) ; $i++) { 
        fwrite($fp, $i." ".$this->getDemandaDeClientes().PHP_EOL  );
       }

       fwrite($fp, 'DEPOT_SECTION'.PHP_EOL  );

       for ($i=0; $i < $this->getDepositos() ; $i++) {

        fwrite($fp, $i.PHP_EOL  );

       }

       fwrite($fp, '-1'.PHP_EOL  );

       fwrite($fp, 'EOF'  );




       

        fclose($fp);   

    }
    

    
    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

  
    

    /**
     * Get the value of depositos
     */ 
    public function getDepositos()
    {
        return $this->depositos;
    }

    /**
     * Set the value of depositos
     *
     * @return  self
     */ 
    public function setDepositos($depositos)
    {
        $this->depositos = $depositos;

        return $this;
    }

    /**
     * Get the value of unidadDeMedida
     */ 
    public function getUnidadDeMedida()
    {
        return $this->unidadDeMedida;
    }

    /**
     * Set the value of unidadDeMedida
     *
     * @return  self
     */ 
    public function setUnidadDeMedida($unidadDeMedida)
    {
        $this->unidadDeMedida = $unidadDeMedida;

        return $this;
    }

    

    /**
     * Get the value of dimension
     */ 
    public function getDimension()
    {
        return $this->dimension;
    }

    /**
     * Set the value of dimension
     *
     * @return  self
     */ 
    public function setDimension($dimension)
    {
        $this->dimension = $dimension;

        return $this;
    }

    /**
     * Get the value of formatoDePeso
     */ 
    public function getFormatoDePeso()
    {
        return $this->formatoDePeso;
    }

    /**
     * Set the value of formatoDePeso
     *
     * @return  self
     */ 
    public function setFormatoDePeso($formatoDePeso)
    {
        if ($formatoDePeso==="FULL_MATRIX") {
            $this->formatoDePeso = $formatoDePeso;
        }
             

        return $this;
    }

    /**
     * Get the value of tipoDePeso
     */ 
    public function getTipoDePeso()
    {
        return $this->tipoDePeso;
    }

    /**
     * Set the value of tipoDePeso
     *
     * @return  self
     */ 
    public function setTipoDePeso($tipoDePeso)
    {
        $this->tipoDePeso = $tipoDePeso;

        return $this;
    }

    /**
     * Get the value of tipoDeProblema
     */ 
    public function getTipoDeProblema()
    {
        return $this->tipoDeProblema;
    }

    /**
     * Set the value of tipoDeProblema
     *
     * @return  self
     */ 
    public function setTipoDeProblema($tipoDeProblema)
    {
        $this->tipoDeProblema = $tipoDeProblema;

        return $this;
    }

    /**
     * Get the value of nodosClientes
     */ 
    public function getNodosClientes()
    {
        return $this->nodosClientes;
    }

    /**
     * Set the value of nodosClientes
     *
     * @return  self
     */ 
    public function setNodosClientes(array $nodosClientes)
    {
        $this->nodosClientes = $nodosClientes;

        return $this;
    }

    /**
     * Get the value of matrizDeClientes
     */ 
    public function getMatrizDeClientes()
    {
        return $this->matrizDeClientes;
    }

    /**
     * Set the value of matrizDeClientes
     *
     * @return  self
     */ 
    public function setMatrizDeClientes( $matrizDeClientes)
    {
        $this->matrizDeClientes = $matrizDeClientes;

        return $this;
    }

    /**
     * Get the value of demandaDeClientes
     */ 
    public function getDemandaDeClientes()
    {
        return $this->demandaDeClientes;
    }

    /**
     * Set the value of demandaDeClientes
     *
     * @return  self
     */ 
    public function setDemandaDeClientes($demandaDeClientes)
    {
        $this->demandaDeClientes = $demandaDeClientes;

        return $this;
    }

    /**
     * Get the value of comentario
     */ 
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set the value of comentario
     *
     * @return  self
     */ 
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

 

    /**
     * Get the value of cantidadDeVehiculos
     */ 
    public function getCantidadDeVehiculos()
    {
        return $this->cantidadDeVehiculos;
    }

    /**
     * Set the value of cantidadDeVehiculos
     *
     * @return  self
     */ 
    public function setCantidadDeVehiculos($cantidadDeVehiculos)
    {
        $this->cantidadDeVehiculos = $cantidadDeVehiculos;

        return $this;
    }

    

    /**
     * Get the value of capacidad
     */ 
    public function getCapacidad()
    {
        return $this->capacidad;
    }

    /**
     * Set the value of capacidad
     *
     * @return  self
     */ 
    public function setCapacidad($capacidad)
    {
        $this->capacidad = $capacidad;

        return $this;
    }
}