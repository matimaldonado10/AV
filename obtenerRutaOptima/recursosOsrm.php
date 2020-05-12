<?php
/**
 * REALIZA LAS TAREAS DE COMUNICACIÓN CON EL SERVIDOR OSRM 
 * OBTIENE UNA MATRIZ DE DISTANCIA 
 * 
 * SE PUEDE UTILIZAR CON EL mainOsrm.php O REALIZAR OTRO DISTINTO
 * QUE TRABAJE CON ESTA CLASE
 * 
 *  
 */

include_once ('coordenadasGeograficas.php');
include_once ('/home/mati/git-repositorios/av/customException.php');
class recursosOsrm {
    private $deposito; //por defecto se carga con las coordenadas de av
    private $coordenadasDeClientes;
    private $nombreDeposito;
    private $responseOsrm;
   
    public function __construct(){
        $this->setDeposito(array(coordenadasGeograficas::construirObjetoConLatitudLongitud(-26.78427,-60.44692)));
        $this->setNombreDeposito(array('Envasadora'));
    }

    /**
     * OSRM necesita pares de coordenadas de la forma (Longitud,Latitud) al revés de otros servicios
     */
    public function traducirCoordenadasParaOsrm(){

        for ($indice=0; $indice < count($this->getDeposito()) ; $indice++) {
            if ($indice == 0) {
                $coordenadasParaOsrm = $this->getDeposito()[$indice] -> getLongitud().','.$this->getDeposito()[$indice]->getLatitud().';';
            }else {
                $coordenadasParaOsrm .= $this->getDeposito()[$indice] -> getLongitud().','.$this->getDeposito()[$indice]->getLatitud().';';
            }
            
        }


        for ($indice=0; $indice < count($this->getCoordenadasDeClientes()) ; $indice++) {
            
            
            $coordenadasParaOsrm .= $this->getCoordenadasDeClientes()[$indice] -> getLongitud().','.$this->getCoordenadasDeClientes()[$indice]->getLatitud().';';
        }

        $coordenadasParaOsrm = trim($coordenadasParaOsrm, ';');
        return $coordenadasParaOsrm;

    }

    private function crearSolicitudYEnviar(){
        $ch = curl_init();
        $coordenadas = $this->traducirCoordenadasParaOsrm();

        $url = 'http://127.0.0.1:5000/table/v1/driving/';
        $url .= $coordenadas;
    
        $anotation = '?annotations=distance';
        $url .= $anotation;
    
    
        //'http://127.0.0.1:5000/trip/v1/driving/-60.44634,-26.77638;-60.41733,-26.79080;-60.44657,-26.80139'
        curl_setopt($ch, CURLOPT_URL, $url );
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        
        $data = curl_exec($ch);
        
        curl_close($ch);

        return $data;
    }

    private function crearSolicitudTripYEnviar(){
        $ch = curl_init();
        $coordenadas = $this->traducirCoordenadasParaOsrm();

        $url = 'http://127.0.0.1:5000/trip/v1/driving/';
        $url .= $coordenadas;
    
        $anotation = '?source=first&destination=any';
        $url .= $anotation;
    
    
        //'http://127.0.0.1:5000/trip/v1/driving/-60.44634,-26.77638;-60.41733,-26.79080;-60.44657,-26.80139'
        curl_setopt($ch, CURLOPT_URL, $url );
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        
        $data = curl_exec($ch);
        
        curl_close($ch);

        return $data;
    }

    public function crearSolicitudRouteYEnviar(){
        $ch = curl_init();
        $coordenadas = $this->traducirCoordenadasParaOsrm();

        $url = 'http://127.0.0.1:5000/route/v1/driving/';
        $url .= $coordenadas;
    
        //$anotation = '?annotations=distance';
        $anotation = '?geometries=geojson&continue_straight=true&overview=full';
        $url .= $anotation;
    
    
        //'http://127.0.0.1:5000/trip/v1/driving/-60.44634,-26.77638;-60.41733,-26.79080;-60.44657,-26.80139'
        curl_setopt($ch, CURLOPT_URL, $url );
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        
        $data = curl_exec($ch);
        
        curl_close($ch);

        return $data;
    }

    public function obtenerMatrizDeDistancia(){
    
        $data = $this->crearSolicitudYEnviar();
            
        $respuestaDelServidor = json_decode($data);

        $this->setResponseOsrm(json_decode($this->crearSolicitudRouteYEnviar()));




        return $this->extraerMatrizDelResponse($respuestaDelServidor);

        
    }

    private function extraerMatrizDelResponse($respuestaDelServidor){
       
        if  ($respuestaDelServidor->code == "Ok") {
            $matriz = array();
            foreach  ( $respuestaDelServidor->distances as $key ) {
                    $matriz[]= $key; 
            }
            
            
            return $matriz;
        }else {
            throw new customException('no existe matriz');
            
        }
 
        
    }
    
    
  
    /**
     * Get the value of deposito
     */ 
    public function getDeposito()
    {
        return $this->deposito;
    }

    /**
     * Set the value of deposito
     *
     * @return  self
     */ 
    public function setDeposito(array $deposito)
    {
        foreach ($deposito as $indice) {
            if (!$indice instanceof coordenadasGeograficas ) {
                throw new customException("El array deposito debe contener objetos de tipo coordenadasGeograficas");
                
            }
        }
        
        $this->deposito = $deposito;

        return $this;
    }

    /**
     * Get the value of coordenadasDeClientes
     */ 
    public function getCoordenadasDeClientes()
    {
        return $this->coordenadasDeClientes;
    }

    /**
     * Set the value of coordenadasDeClientes
     *
     * @return  self
     */ 
    public function setCoordenadasDeClientes(array $coordenadasDeClientes)
    {
        foreach ($coordenadasDeClientes as $indice) {
            if (!$indice instanceof coordenadasGeograficas ) {
                throw new customException("El array coordenadasDeClientes debe contener objetos de tipo coordenadasGeograficas");
                
            }
        }
        
        $this->coordenadasDeClientes = $coordenadasDeClientes;

        return $this;
    }

    

    /**
     * Get the value of nombreDeposito
     */ 
    public function getNombreDeposito()
    {
        return $this->nombreDeposito;
    }

    /**
     * Set the value of nombreDeposito
     *
     * @return  self
     */ 
    public function setNombreDeposito($nombreDeposito)
    {
        $this->nombreDeposito = $nombreDeposito;

        return $this;
    }

    /**
     * Get the value of responseOsrm
     */ 
    public function getResponseOsrm()
    {
        return $this->responseOsrm;
    }

    /**
     * Set the value of responseOsrm
     *
     * @return  self
     */ 
    public function setResponseOsrm($responseOsrm)
    {
        $this->responseOsrm = $responseOsrm;

        return $this;
    }
}
