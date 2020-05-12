<?php

include_once ('recursosOptaplanner.php');


class mainOptaplanner {

   private $recursos;

   public function __construct(){
      $this->setRecursos(new recursosOptaplanner());

   }

   public function iniciarSolicitudAlServidorOptaplanner(){

      // Para mantener la sesión entre varias solicitudes al servidor se crea una cookie
      $cookie = curl_share_init();
      curl_share_setopt($cookie, CURLSHOPT_SHARE, CURL_LOCK_DATA_COOKIE);
      
      
      $respuestaDelServidor = $this->getRecursos() -> enviarArchivoDataSet($cookie);
      
      if ($this->esRespuestaValida($respuestaDelServidor)){
            $respuestaDelServidor = $this->getRecursos() -> cargarDataSetEnMemoria($cookie);
            if ($this->esRespuestaValida($respuestaDelServidor)) {
      
               $respuestaDelServidor = $this->getRecursos() -> verificarDataSetCorrecto($cookie);
               if ($this->esRespuestaValida($respuestaDelServidor)) {
                  $respuestaDelServidor = $this->getRecursos() -> resolverProblema($cookie);
                  if ($this->esRespuestaValida($respuestaDelServidor)) {
                     sleep(20);
                     $respuestaDelServidor = $this->getRecursos() -> terminarEjecucion($cookie);
                     if ($this->esRespuestaValida($respuestaDelServidor)) {
      
                        $respuestaDelServidor = $this->getRecursos() -> actualizarSolucion($cookie);
                        if ($this->esRespuestaValida($respuestaDelServidor)) {
                           //echo $respuestaDelServidor['respuestaDeOptaplanner'];
                           return $respuestaDelServidor['respuestaDeOptaplanner']; 
            
                           
                        } else {
                           exit($respuestaDelServidor['respuestaDeOptaplanner']);
                        }
                     } else {
                        exit($respuestaDelServidor['respuestaDeOptaplanner']);
                     }
                  } else {
                     exit($respuestaDelServidor['respuestaDeOptaplanner']);
                  }
               } else {
                  exit($respuestaDelServidor['respuestaDeOptaplanner']);
               }
            } else {
               exit($respuestaDelServidor['respuestaDeOptaplanner']);
            }
      }else {
         exit($respuestaDelServidor['respuestaDeOptaplanner']);
      }
   }

   
   
   
     function esRespuestaValida($respuestaDelServidor){
      
      $res = preg_match("/\ERROR\b/i", $respuestaDelServidor['respuestaDeOptaplanner']);
      // === 1 si hay coincidencia
      // === 0 no hay coincidencia
      if ($res===0){
      // no existe un error 
          return true;
      }
      return false;   
    }

   /**
    * Get the value of recursos
    */ 
   public function getRecursos()
   {
      return $this->recursos;
   }

   /**
    * Set the value of recursos
    *
    * @return  self
    */ 
   public function setRecursos($recursos)
   {
      $this->recursos = $recursos;

      return $this;
   }
}
