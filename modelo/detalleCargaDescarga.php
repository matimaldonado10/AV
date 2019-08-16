<?php
include_once ('cargaDescarga.php');
include_once ('articulo.php');  

class detalleCargaDescarga{
    private $id;
    private $cantidad;
    private $cargaDescarga;
    private $articulo;

    private function __construct(){
        $this->setCargaDescarga(new cargaDescarga());
        $this->setArticulo(new articulo());
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
     * Get the value of cantidad
     */ 
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set the value of cantidad
     *
     * @return  self
     */ 
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get the value of cargaDescarga
     */ 
    public function getCargaDescarga()
    {
        return $this->cargaDescarga;
    }

    /**
     * Set the value of cargaDescarga
     *
     * @return  self
     */ 
    public function setCargaDescarga(cargaDescarga $cargaDescarga)
    {
        $this->cargaDescarga = $cargaDescarga;

        return $this;
    }

    /**
     * Get the value of articulo
     */ 
    public function getArticulo()
    {
        return $this->articulo;
    }

    /**
     * Set the value of articulo
     *
     * @return  self
     */ 
    public function setArticulo(articulo $articulo)
    {
        $this->articulo = $articulo;

        return $this;
    }
}