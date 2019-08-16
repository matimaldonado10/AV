<?php
class barrio{
    private $idBarrio;
    private $nombre;
    

    /**
     * Get the value of idBarrio
     */ 
    public function getIdBarrio()
    {
        return $this->idBarrio;
    }

    /**
     * Set the value of idBarrio
     *
     * @return  self
     */ 
    public function setIdBarrio(int $idBarrio)
    {
        $this->idBarrio = $idBarrio;

        return $this;
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
    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }
}