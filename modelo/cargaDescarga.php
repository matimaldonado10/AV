<?php
include_once ('repartidor.php');
include_once ('supervisor.php');

class cargaDescarga{
    private $idCarga;
    private $fecha;
    private $repartidor;
    private $plata;
    private $supervisor;

    public function __construct(){
        $this->setRepartidor(new repartidor());
        $this->setSupervisor(new supervisor());
    }

    

    /**
     * Get the value of idCarga
     */ 
    public function getIdCarga()
    {
        return $this->idCarga;
    }

    /**
     * Set the value of idCarga
     *
     * @return  self
     */ 
    public function setIdCarga(int $idCarga)
    {
        $this->idCarga = $idCarga;

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
    public function setFecha(string $fecha)
    {
        $this->fecha = $fecha;

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
    public function setPlata(float $plata)
    {
        $this->plata = $plata;

        return $this;
    }

    /**
     * Get the value of supervisor
     */ 
    public function getSupervisor()
    {
        return $this->supervisor;
    }

    /**
     * Set the value of supervisor
     *
     * @return  self
     */ 
    public function setSupervisor(supervisor $supervisor)
    {
        $this->supervisor = $supervisor;

        return $this;
    }
}