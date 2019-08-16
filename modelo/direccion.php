<?php
include_once ('persona.php');
include_once ('barrio');

class direccion{
    private $idDireccion;
    private $direccion;
    private $barrio;
    private $persona;
    private $referencia;
    private $coordenadas;

    public function __construct(){
        $this->setBarrio(new barrio());
        $this->setPersona(new persona());
    }

    /**
     * Get the value of idDireccion
     */ 
    public function getIdDireccion()
    {
        return $this->idDireccion;
    }

    /**
     * Set the value of idDireccion
     *
     * @return  self
     */ 
    public function setIdDireccion($idDireccion)
    {
        $this->idDireccion = $idDireccion;

        return $this;
    }

    /**
     * Get the value of direccion
     */ 
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     *
     * @return  self
     */ 
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get the value of barrio
     */ 
    public function getBarrio()
    {
        return $this->barrio;
    }

    /**
     * Set the value of barrio
     *
     * @return  self
     */ 
    public function setBarrio(barrio $barrio)
    {
        $this->barrio = $barrio;

        return $this;
    }

    /**
     * Get the value of persona
     */ 
    public function getPersona()
    {
        return $this->persona;
    }

    /**
     * Set the value of persona
     *
     * @return  self
     */ 
    public function setPersona(persona $persona)
    {
        $this->persona = $persona;

        return $this;
    }

    /**
     * Get the value of referencia
     */ 
    public function getReferencia()
    {
        return $this->referencia;
    }

    /**
     * Set the value of referencia
     *
     * @return  self
     */ 
    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;

        return $this;
    }

    /**
     * Get the value of coordenadas
     */ 
    public function getCoordenadas()
    {
        return $this->coordenadas;
    }

    /**
     * Set the value of coordenadas
     *
     * @return  self
     */ 
    public function setCoordenadas($coordenadas)
    {
        $this->coordenadas = $coordenadas;

        return $this;
    }
}