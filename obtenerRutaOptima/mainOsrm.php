<?php
/**
 * ESTO ES UNA PRUEBA PARA OBTENER UNA MATRIZ DE DISTACIA DE X CANTIDAD DE CLIENTES
 * LOS CLIENTES NO SON REALES
 * TODOS LAS COORDENADAS SON CREADAS DE FORMA ALEATORIA
 */
include_once ("recursosOsrmPrueba.php");

class mainOsrm {

    private $recursoOsrm;

    private $matrizOsrm;
    
    public function __construct(){

    }


    public function  solicitarMatrizAlServidorOsrm(){
        
       
        try {
            $matriz = $this->recursoOsrm-> obtenerMatrizDeDistancia();

            $this->setMatrizOsrm($matriz);
    
            $this->imprimirMatriz($matriz);
    
            $this->imprimirCoordenadas();
            
        } catch (Exception $mensajeDeExcepcion) {
            echo 'Mensaje: '. $mensajeDeExcepcion->getMessage();
        } 
        

    }

    public function imprimirMatriz($matriz){
        if (is_array($matriz)) {
            foreach ($matriz as $key ) {
            foreach ($key as $key2) {
                echo "$key2 ";

            } 
            echo "\n";
            };

            echo "\n";
            

        }else {
            throw new Exception('no existe matriz');
        }   
    }

    public function imprimirCoordenadas(){
        foreach ($this->recursoOsrm->getCoordenadasDeClientes() as $indice) {
            echo $indice."\n" ;
        }
    }

    


    /**
     * Get the value of recursoOsrm
     */ 
    public function getRecursoOsrm()
    {
        return $this->recursoOsrm;
    }

    /**
     * Set the value of recursoOsrm
     *
     * @return  self
     */ 
    public function setRecursoOsrm(recursosOsrm $recursoOsrm)
    {
        $this->recursoOsrm = $recursoOsrm;

        return $this;
    }

    /**
     * Get the value of matrizOsrm
     */ 
    public function getMatrizOsrm()
    {
        return $this->matrizOsrm;
    }

    /**
     * Set the value of matrizOsrm
     *
     * @return  self
     */ 
    public function setMatrizOsrm(array $matrizOsrm)
    {
        $this->matrizOsrm = $matrizOsrm;

        return $this;
    }
}