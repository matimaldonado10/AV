<?php
include_once ('clienteDirecto.php');
include_once ('diaDeReparto.php');

class clientesDirecto_diaDeReparto{
    private $clienteDirecto;
    private $diaDeReparto;
    private $orden;

    public function __construct(){
        $this->setClienteDirecto(new clienteDirecto());
        $this->setDiaDeReparto(new diaDeReparto());
    }

    


    /**
     * Get the value of clienteDirecto
     */ 
    public function getClienteDirecto()
    {
        return $this->clienteDirecto;
    }

    /**
     * Set the value of clienteDirecto
     *
     * @return  self
     */ 
    public function setClienteDirecto(clienteDirecto $clienteDirecto)
    {
        $this->clienteDirecto = $clienteDirecto;

        return $this;
    }

    /**
     * Get the value of diaDeReparto
     */ 
    public function getDiaDeReparto()
    {
        return $this->diaDeReparto;
    }

    /**
     * Set the value of diaDeReparto
     *
     * @return  self
     */ 
    public function setDiaDeReparto(diaDeReparto $diaDeReparto)
    {
        $this->diaDeReparto = $diaDeReparto;

        return $this;
    }

    /**
     * Get the value of orden
     */ 
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set the value of orden
     *
     * @return  self
     */ 
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }
}