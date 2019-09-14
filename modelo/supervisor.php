<?php
include_once ('persona.php');
class supervisor extends persona{
    private $usuario;
    private $contraseña;

    public function __construct(){

    }

    /**
     * Get the value of usuario
     */ 
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set the value of usuario
     *
     * @return  self
     */ 
    public function setUsuario(string $usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get the value of contraseña
     */ 
    public function getContraseña()
    {
        return $this->contraseña;
    }

    /**
     * Set the value of contraseña
     *
     * @return  self
     */ 
    public function setContraseña(string $contraseña)
    {
        $this->contraseña = $contraseña;

        return $this;
    }
}