<?php

include_once ('recursosOptaplanner.php');
$recursos = new recursosOptaplanner();

// Para mantener la sesión entre varias solicitudes al servidor se crea una cookie
$cookie = curl_share_init();
curl_share_setopt($cookie, CURLSHOPT_SHARE, CURL_LOCK_DATA_COOKIE);


$respuestaDelServidor = $recursos -> enviarArchivoDataSet($cookie);

if (esRespuestaValida($respuestaDelServidor)){
      $respuestaDelServidor = $recursos -> cargarDataSetEnMemoria($cookie);
      if (esRespuestaValida($respuestaDelServidor)) {

         $respuestaDelServidor = $recursos -> verificarDataSetCorrecto($cookie);
         if (esRespuestaValida($respuestaDelServidor)) {
            $respuestaDelServidor = $recursos -> resolverProblema($cookie);
            if (esRespuestaValida($respuestaDelServidor)) {
               sleep(20);
               $respuestaDelServidor = $recursos -> terminarEjecucion($cookie);
               if (esRespuestaValida($respuestaDelServidor)) {

                  $respuestaDelServidor = $recursos -> actualizarSolucion($cookie);
                  if (esRespuestaValida($respuestaDelServidor)) {
                     echo $respuestaDelServidor['respuestaDeOptaplanner'];
      
                     
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