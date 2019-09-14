<?php
include_once('../path.php');
include_once(path::dirMysql);
include_once ('cargaDescarga.php');
include_once ('articulo.php');  

class detalleCargaDescarga{
    private $id;
    private $carga;
    private $descarga;
    private $cargaDescarga;
    private $articulo;

    function __construct(){
        
    }


    public static function instanciarDetalleCargaDescarga($carga, $descarga, $cargaDescarga, $idArticulo){
        $instancia = new self();

        $instancia->setCarga($carga);
        $instancia->setDescarga($descarga);
        
        $instancia->setArticulo(new articulo());
        $instancia->getArticulo()->setIdArticulo($idArticulo);

        $instancia->setCargaDescarga($cargaDescarga);

        return $instancia;

    }

    public function insertarEnBd(){
        //copiar código de alguna inserción en BD

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

    /**
     * Get the value of carga
     */ 
    public function getCarga()
    {
        return $this->carga;
    }

    /**
     * Set the value of carga
     *
     * @return  self
     */ 
    public function setCarga(int $carga)
    {
        $this->carga = $carga;

        return $this;
    }

    /**
     * Get the value of descarga
     */ 
    public function getDescarga()
    {
        return $this->descarga;
    }

    /**
     * Set the value of descarga
     *
     * @return  self
     */ 
    public function setDescarga(int $descarga)
    {
        $this->descarga = $descarga;

        return $this;
    }
}