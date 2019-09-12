<?php
include_once ('repartidor.php');
class faltanteSobrante{
    private $id;
    private $plata;
    private $repartidor;
    private $fecha;
    
    public function __construct(){
        $this->setRepartidor(new repartidor());
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of plata
     */ 
    public function getPlata()
    {
        return $this->plata;
    }

    /**
     * Set the value of plata
     *
     * @return  self
     */ 
    public function setPlata($plata)
    {
        $this->plata = $plata;

        return $this;
    }

    /**
     * Get the value of repartidor
     */ 
    public function getRepartidor()
    {
        return $this->repartidor;
    }

    /**
     * Set the value of repartidor
     *
     * @return  self
     */ 
    public function setRepartidor(repartidor $repartidor)
    {
        $this->repartidor = $repartidor;

        return $this;
    }

    /**
     * Get the value of fecha
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }
}