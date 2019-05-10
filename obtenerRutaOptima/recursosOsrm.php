<?php
/**
 * REALIZA LAS TAREAS DE COMUNICACIÓN CON EL SERVIDOR OSRM 
 *  OBTIENE UNA MATRIZ DE DISTANCIA 
 *  
 */

include_once ('coordenadasGeograficas.php');

class recursosOsrm {
    
    private function crearCoordenadas(){
        $random = new coordenadasGeograficas();
        //coordenadas de aqua vital
        $coordenadas = '-60.44692,-26.78427;';
    
        for ($i=0; $i < 19; $i++) { 
            $lat = $random->latitud();
            $latDeciaml = $random->latitudDecimal();
    
    
            $long = $random->longitud();
            $longDecimal = $random->longitudDecimal();
    
            if (empty($coordenadas)) {
                $coordenadas = "$long" .'.'."$longDecimal" .',' ."$lat".'.'."$latDeciaml".';';
            }
            else {
                $coordenadas .= "$long" .'.'."$longDecimal" .',' ."$lat".'.'."$latDeciaml".';';
            }
        }
        $coordenadas = trim($coordenadas, ';');
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
    
    
  
}
