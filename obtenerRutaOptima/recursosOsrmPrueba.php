<?php
/**
 * REALIZA LAS TAREAS DE COMUNICACIÓN CON EL SERVIDOR OSRM 
 *  OBTIENE UNA MATRIZ DE DISTANCIA 
 *  
 */

include_once ('coordenadasGeograficas.php');

class recursosOsrm {
    private $cantidadDeClientes;
    private $deposito; //permite sólo 1 depósito
    private $coordenadasDeClientes;
   
    
    
    private function crearCoordenadas(){
        $coordenadasGeograficas = new coordenadasGeograficas();
        //coordenadas del depósito aqua vital
        $coordenadas = '-60.44692,-26.78427;';
        $arrayClientes = array('-26.78427 -60.44692 ');
    
        for ($i=0; $i < $this->getCantidadDeClientes(); $i++) { 
            $lat = $coordenadasGeograficas->latitud();
            $latDecimal = $coordenadasGeograficas->latitudDecimal();
    
    
            $long = $coordenadasGeograficas->longitud();
            $longDecimal = $coordenadasGeograficas->longitudDecimal();
    
            $coordenadas .= "$long" .'.'."$longDecimal" .',' ."$lat".'.'."$latDecimal".';';
            $arrayClientes[] = "$lat".'.'."$latDecimal".' ' . "$long" .'.'."$longDecimal" ;

        }
        $coordenadas = trim($coordenadas, ';');
        $this->setCoordenadasDeClientes($arrayClientes);
        return $coordenadas;

    }

    private function crearSolicitudYEnviar(){
        $ch = curl_init();
        $coordenadas = $this->crearCoordenadas();

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

    public function obtenerMatrizDeDistancia(){
    
        $data = $this->crearSolicitudYEnviar();
            
        $respuestaDelServidor = json_decode($data);

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
            return false;
        }

    }
    
    
  

    /**
     * Get the value of cantidadDeClientes
     */ 
    public function getCantidadDeClientes()
    {
        return $this->cantidadDeClientes;
    }

    /**
     * Set the value of cantidadDeClientes
     *
     * @return  self
     */ 
    public function setCantidadDeClientes($cantidadDeClientes)
    {
        $this->cantidadDeClientes = $cantidadDeClientes;

        return $this;
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
    public function setDeposito($deposito)
    {
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
    private function setCoordenadasDeClientes(array $coordenadasDeClientes)
    {
        $this->coordenadasDeClientes = $coordenadasDeClientes;

        return $this;
    }

    
}
