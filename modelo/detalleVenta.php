<?php

class detalleVenta{
    private $id;
    private $cantidad;
    private $subtotal;
    private $venta;
    private $articulo;

    public function __construct(){
        $this->setArticulo(new articulo());
        $this->setVenta(new venta());
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
     * Get the value of subtotal
     */ 
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * Set the value of subtotal
     *
     * @return  self
     */ 
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;

        return $this;
    }

    /**
     * Get the value of venta
     */ 
    public function getVenta()
    {
        return $this->venta;
    }

    /**
     * Set the value of venta
     *
     * @return  self
     */ 
    public function setVenta(venta $venta)
    {
        $this->venta = $venta;

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