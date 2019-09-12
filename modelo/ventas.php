<?php
include_once ('repartidor');
include_once ('distribuidor');
include_once ('clienteDirecto');



class ventas{
    private $idVentas;
    private $envasesVacios;
    private $fecha;
    private $pago;
    private $clienteDirecto;
    private $distribuidor;
    private $repartidor;
    private $comprobado;
    private $total;

    public function __construct(){
        $this->setClienteDirecto(new clienteDirecto());
        $this->setDistribuidor(new distribuidor());
        $this->setRepartidor(new repartidor());
    }
    

    /**
     * Get the value of idVentas
     */ 
    public function getIdVentas()
    {
        return $this->idVentas;
    }

    /**
     * Set the value of idVentas
     *
     * @return  self
     */ 
    public function setIdVentas($idVentas)
    {
        $this->idVentas = $idVentas;

        return $this;
    }

    /**
     * Get the value of envasesVacios
     */ 
    public function getEnvasesVacios()
    {
        return $this->envasesVacios;
    }

    /**
     * Set the value of envasesVacios
     *
     * @return  self
     */ 
    public function setEnvasesVacios($envasesVacios)
    {
        $this->envasesVacios = $envasesVacios;

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

    /**
     * Get the value of pago
     */ 
    public function getPago()
    {
        return $this->pago;
    }

    /**
     * Set the value of pago
     *
     * @return  self
     */ 
    public function setPago($pago)
    {
        $this->pago = $pago;

        return $this;
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
     * Get the value of distribuidor
     */ 
    public function getDistribuidor()
    {
        return $this->distribuidor;
    }

    /**
     * Set the value of distribuidor
     *
     * @return  self
     */ 
    public function setDistribuidor(distribuidor $distribuidor)
    {
        $this->distribuidor = $distribuidor;

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
     * Get the value of comprobado
     */ 
    public function getComprobado()
    {
        return $this->comprobado;
    }

    /**
     * Set the value of comprobado
     *
     * @return  self
     */ 
    public function setComprobado($comprobado)
    {
        $this->comprobado = $comprobado;

        return $this;
    }

    /**
     * Get the value of total
     */ 
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set the value of total
     *
     * @return  self
     */ 
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }
}