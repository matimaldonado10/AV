<?php
class recursosOptaplanner {
    /**
     * Contiene las solicitudes necesarias para comunicarse con el servlet de
     * OPTAPLANNER y resolver el problema del enrutamiento de vehículos
     * 
     * DataSet contiene el conjunto de todos los clientes y sus ubicaciones, la 
     * cantidad de repartidores y una matriz de distancia entre todos los clientes.
     */

    public function enviarArchivoDataSet($cookie){

        $solicitudAlServlet = $this -> crearSolicitudParaOptaplanner($cookie,"upload","POST",true);

        $respuestaDelServidor = array('respuestaDeOptaplanner' => curl_exec($solicitudAlServlet));
        $respuestaDelServidor['errorDelServidor'] =  curl_error($solicitudAlServlet);
        curl_close($solicitudAlServlet);
        
        return $respuestaDelServidor;
        
    }

    public function cargarDataSetEnMemoria($cookie)
    {
        $solicitudAlServlet = $this -> crearSolicitudParaOptaplanner($cookie,'rest/vehiclerouting/solution/dataSet','POST', false);


        $respuestaDelServidor = array('respuestaDeOptaplanner' => curl_exec($solicitudAlServlet));
        $respuestaDelServidor['errorDelServidor'] =  curl_error($solicitudAlServlet);
        curl_close($solicitudAlServlet);
        
        return $respuestaDelServidor;
     
    }

    public function verificarDataSetCorrecto($cookie){

        $solicitudAlServlet = $this -> crearSolicitudParaOptaplanner($cookie,'rest/vehiclerouting/solution','GET', false);
              
        $respuestaDelServidor = array('respuestaDeOptaplanner' => curl_exec($solicitudAlServlet));
        $respuestaDelServidor['errorDelServidor'] =  curl_error($solicitudAlServlet);
        curl_close($solicitudAlServlet);
        
        return $respuestaDelServidor;

    }

    public function actualizarSolucion($cookie){

        $solicitudAlServlet = $this -> crearSolicitudParaOptaplanner($cookie,"rest/vehiclerouting/solution","GET",false);
                       
        $respuestaDelServidor = array('respuestaDeOptaplanner' => curl_exec($solicitudAlServlet));
        $respuestaDelServidor['errorDelServidor'] =  curl_error($solicitudAlServlet);
        curl_close($solicitudAlServlet);
        
        return $respuestaDelServidor;
    }

    public function resolverProblema($cookie){
        $solicitudAlServlet = $this -> crearSolicitudParaOptaplanner($cookie,"rest/vehiclerouting/solution/solve","POST",false);

        $respuestaDelServidor = array('respuestaDeOptaplanner' => curl_exec($solicitudAlServlet));
        $respuestaDelServidor['errorDelServidor'] =  curl_error($solicitudAlServlet);
        curl_close($solicitudAlServlet);
        
        return $respuestaDelServidor;

    }

    public function terminarEjecucion($cookie){

        $solicitudAlServlet = $this -> crearSolicitudParaOptaplanner($cookie,"rest/vehiclerouting/solution/terminateEarly","POST",false);
        
        $respuestaDelServidor = array('respuestaDeOptaplanner' => curl_exec($solicitudAlServlet));
        $respuestaDelServidor['errorDelServidor'] =  curl_error($solicitudAlServlet);
        curl_close($solicitudAlServlet);
        
        return $respuestaDelServidor;

    }

    public function obtenerArchivoDataSet(){
        //$cfile = curl_file_create('/home/mati/Escritorio/ruta03-PorTiempo-n10-k3.vrp','text/plain','ruta03-PorTiempo-n10-k3.vrp');
        $cfile = curl_file_create('/home/mati/Escritorio/sp-n11-k3.vrp','text/plain','sp-n11-k3.vrp');

        return $archivoDataSet = array('fileName1' => $cfile);
    }
    
    public function crearSolicitudParaOptaplanner($cookie,$url,$method,$esEnviarArchivo){
        $solicitudAlServlet = curl_init();

        curl_setopt_array($solicitudAlServlet, array(
        CURLOPT_PORT => "8080",
        CURLOPT_URL => "http://127.0.0.1:8080/optaplanner-webexamples/".$url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SHARE => $cookie,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method
        
        ));



        if ($esEnviarArchivo &&  strcmp($method, 'POST') == 0) {
            curl_setopt($solicitudAlServlet, CURLOPT_POSTFIELDS, $this -> obtenerArchivoDataSet() );
            curl_setopt($solicitudAlServlet, CURLOPT_HTTPHEADER, array(
                "Content-Type: multipart/form-data",
                "cache-control: no-cache") );

        } else {
            curl_setopt($solicitudAlServlet, CURLOPT_HTTPHEADER, array(
            "cache-control: no-cache") ); 

            }
           

        return $solicitudAlServlet;
    }
}
