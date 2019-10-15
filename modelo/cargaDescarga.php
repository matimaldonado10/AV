<?php
include_once('/home/mati/git-repositorios/av/path.php');
include_once(path::dirMysql);
include_once(path::dirConstantesDB);

include_once ('repartidor.php');
include_once ('supervisor.php');
include_once ('insertarCargaDescarga.php');
include_once('detalleCargaDescarga.php');



class cargaDescarga{
    private $idCarga;
    private $fecha;
    private $repartidor;
    private $plataCarga;
    private $plataDescarga;
    private $supervisor;

    public function __construct(){
     
    }

    public static function instanciarCargaDescarga(
        $dniSupervisor,
        $idSupervisor,
        $fecha,
        $plataCarga,
        $plataDescarga,
        $idRepartidor,
        $dniRepartidor


    ){
        $instancia = new self();


        $instancia->setSupervisor(new supervisor());
        $instancia->getSupervisor()->setIdPersona((int)$idSupervisor);
        $instancia->getSupervisor()->setDni((int)$dniSupervisor);

        $instancia->setRepartidor(new repartidor());
        $instancia->getRepartidor()->setIdPersona((int)$idRepartidor);
        $instancia->getRepartidor()->setDni((int)$dniRepartidor);

        $instancia->setFecha((string)$fecha);
        $instancia->setPlataCarga((float)$plataCarga);

        $instancia->setPlataDescarga((float)$plataDescarga);






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

    /**
     * Get the value of plataCarga
     */ 
    public function getPlataCarga()
    {
        return $this->plataCarga;
    }

    /**
     * Set the value of plataCarga
     *
     * @return  self
     */ 
    public function setPlataCarga(float $plataCarga)
    {
        $this->plataCarga = $plataCarga;

        return $this;
    }

    /**
     * Get the value of plataDescarga
     */ 
    public function getPlataDescarga()
    {
        return $this->plataDescarga;
    }

    /**
     * Set the value of plataDescarga
     *
     * @return  self
     */ 
    public function setPlataDescarga(float $plataDescarga)
    {
        $this->plataDescarga = $plataDescarga;

        return $this;
    }
}


function ejecutarCargaDescarga(){

    $archivo = file_get_contents("/home/mati/Documentos/aquavital/cargaDescarga.json");
    $post = json_decode($archivo, true);



    // Datos obtenidos del json
    $data = $post['data'];

    $fecha = $data['fecha'];
    $idRepartidor = $data['idRepartidor'];
    $dniRepartidor = $data['dniRepartidor'];
    $idSupervisor = $data['idSupervisor'];
    $dniSupervisor = $data['dniSupervisor'];
    $tandas = $data['tandas'];

    if (!empty($tandas)) {
        
        for($i=0;$i<count($tandas);$i++){
            $plataCarga = 0;
            $plataDescarga = 0;
          

            $artículo = $tandas[$i];

            if (!empty($artículo[0]['plataCarga'])) {
                $plataCarga = $artículo[0]['plataCarga'];
            }
            if(!empty ($artículo[0]['plataDescarga'])) {
                $plataDescarga = $artículo[0]['plataDescarga'];
            }

            $cargaDescarga = cargaDescarga::instanciarCargaDescarga(
                $dniSupervisor,
                $idSupervisor,
                $fecha,
                $plataCarga,
                $plataDescarga,
                $idRepartidor,
                $dniRepartidor
            );
        
            
        
            $insertar = new insertarCargaDescarga();
        
            //LA FUNCION INSERTAR CARGA DEBE ESTAR EN CARGADESCARGA
            $resultado = $insertar->insertarCarga(
                $cargaDescarga->getFecha(),
                $cargaDescarga->getPlataCarga(),
                $cargaDescarga->getPlataDescarga(),
                $cargaDescarga->getSupervisor()->getIdPersona(),
                $cargaDescarga->getSupervisor()->getDni(),
                $cargaDescarga->getRepartidor()->getIdPersona(),
                $cargaDescarga->getRepartidor()->getDni()
            );
        
            //echo $resultado;
        
            $cargaDescarga->setIdCarga((int)$resultado[0]);
        
            echo $plataCarga.' '.$plataDescarga;


            for($j=1;$j<count($artículo);$j++){
               
               
                
                
                if (empty($artículo[$j]['carga'])) {
                    $carga = 0;
                }else {
                    $carga = $artículo[$j]['carga'];
                }

                if (empty($artículo[$j]['descarga'])) {
                    $descarga = 0;
                }else {
                    $descarga = $artículo[$j]['descarga'];

                }

                
             
                $idArticulo = $artículo[$j]['idArtículo'];

                echo '<br>';

                echo $carga.' '.$descarga.' '.$idArticulo;



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
                
            }
            
        }

       


   

        
    
      
    }else{
       return false; 
    }


   

    





$data = new stdClass();
$response = new stdClass();
$response->exito = true;
$data->resultado = $resultado;
$response->data =$data;
echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK );



}

ejecutarCargaDescarga();