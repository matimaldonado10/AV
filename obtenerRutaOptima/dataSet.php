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
    public function setMatrizDeClientes(array $matrizDeClientes)
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

    public function crearArchivoDataSet(){
        /**PORHACER
         * 
         * nombrar al archivo con
         * n=cantidad de clientes
         * k = cantidad de vehículos
         */

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

    
}