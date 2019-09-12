<?php
include_once ('repartidor.php');

class diaDeReparto{
    private $idRutaDeReparto;
    private $dia;
    private $repartidor;

    public function __construct(){
        $this->setRepartidor(new repartidor());
    }

    /**
     * Get the value of idRutaDeReparto
     */ 
    public function getIdRutaDeReparto()
    {
        return $this->idRutaDeReparto;
    }

    /**
     * Set the value of idRutaDeReparto
     *
     * @return  self
     */ 
    public function setIdRutaDeReparto($idRutaDeReparto)
    {
        $this->idRutaDeReparto = $idRutaDeReparto;

        return $this;
    }

    /**
     * Get the value of dia
     */ 
    public function getDia()
    {
        return $this->dia;
    }

    /**
     * Set the value of dia
     *
     * @return  self
     */ 
    public function setDia($dia)
    {
        $this->dia = $dia;

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

}