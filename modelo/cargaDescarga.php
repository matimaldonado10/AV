<?php
include_once('../path.php');
include_once(path::dirMysql);
include_once(path::dirConstantesDB);

include_once ('repartidor.php');
include_once ('supervisor.php');
include_once ('insertarCargaDescarga.php');
include_once('detalleCargaDescarga.php');




//data es la clave json dónde estarán el resto de los atributos
//$data = $_POST["data"];


$fecha = $_POST["fecha"];
$idRepartidor = $_POST["idRepartidor"];
$dniRepartidor = $_POST["dniRepartidor"];
$plata = $_POST["plata"];
$idSupervisor = $_POST["idSupervisor"];
$dniSupervisor = $_POST["dniSupervisor"];

$carga = $_POST["carga"];
$descarga = $_POST["descarga"];
$idArticulo = $_POST["idArticulo"];



$cargaDescarga = cargaDescarga::instanciarCargaDescarga(
    $dniSupervisor,
    $idSupervisor,
    $fecha,
    $plata,
    $idRepartidor,
    $dniRepartidor
);



$insertar = new insertarCargaDescarga();
$resultado = $insertar->insertarCarga(
    $cargaDescarga->getFecha(),
    $cargaDescarga->getPlata(),
    $cargaDescarga->getSupervisor()->getIdPersona(),
    $cargaDescarga->getSupervisor()->getDni(),
    $cargaDescarga->getRepartidor()->getIdPersona(),
    $cargaDescarga->getRepartidor()->getDni()
);

echo $resultado;

$cargaDescarga->setIdCarga($resultado[0]);




$detalleCargaDescarga = detalleCargaDescarga::instanciarDetalleCargaDescarga(
    $carga,
    $descarga,
    $cargaDescarga,
    $idArticulo
);

$resultado = $insertar->InsertarDetalleCarga(
    $detalleCargaDescarga->getCarga(),
    $detalleCargaDescarga->getCargaDescarga()->getIdCarga(),
    $detalleCargaDescarga->getArticulo()->getIdArticulo(),
    $detalleCargaDescarga->getDescarga()
    
);

echo $resultado;
 //var_dump($cargaDescarga);







class cargaDescarga{
    private $idCarga;
    private $fecha;
    private $repartidor;
    private $plata;
    private $supervisor;

    public function __construct(){
     
    }

    public static function instanciarCargaDescarga(
        $dniSupervisor,
        $idSupervisor,
        $fecha,
        $plata,
        $idRepartidor,
        $dniRepartidor


    ){
        $instancia = new self();


        $instancia->setSupervisor(new supervisor());
        $instancia->getSupervisor()->setIdPersona($idSupervisor);
        $instancia->getSupervisor()->setDni($dniSupervisor);

        $instancia->setRepartidor(new repartidor());
        $instancia->getRepartidor()->setIdPersona($idRepartidor);
        $instancia->getRepartidor()->setDni($dniRepartidor);

        $instancia->setFecha($fecha);
        $instancia->setPlata($plata);






        return $instancia;
    }

    public function insertarEnBd( ){

     


        //var_dump($this);

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


