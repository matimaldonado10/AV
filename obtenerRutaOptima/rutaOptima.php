<?php

/**
 * Script principal para obtener las rutas de reparto optimizadas
 * 
 * FUNCIONES PRINCIPALES
 * Envía un conjunto de coordenadas geográficas que representan las ubicaciones de los clientes
 * al servidor OSRM.
 * 
 * Obtiene de OSRM una matriz de distancia de todos los clientes.
 * 
 * Envia al servlet de OPTAPLANNER el DATASET necesario para que pueda trabajar. 
 * 
 * Solicita al servlet encontrar una solucíon óptima al problema del enrutamiento de
 * vehículos.
 * 
 * 
 */


include_once ('mainOptaplanner.php');
include_once ('mainOsrm.php');
include_once ('/home/mati/git-repositorios/av/nogit/mysql_crud.php');
include_once ('/home/mati/git-repositorios/av/modelo/constantesDB.php');

include_once ('/home/mati/git-repositorios/av/obtenerRutaOptima/recursosOsrm.php');
include_once ('/home/mati/git-repositorios/av/obtenerRutaOptima/recursosOptaplanner.php');

include_once ('/home/mati/git-repositorios/av/obtenerRutaOptima/coordenadasGeograficas.php');
include_once ('/home/mati/git-repositorios/av/obtenerRutaOptima/dataSet.php');
include_once ('jsonRutaOptimizada.php');


class rutaOptima {
    private $arrayDatosOsrm;
    private $arrayRepartidores;
    private $arrayDeClientesDeRepartidoresEnUnDia;
    private $cantidadDepositos;
    private $directorioDelDataSetAGenerar;
    private $nombreDataSet;
    

    public function __construct(){
        $this->setDirectorioDelDataSetAGenerar("/home/mati/git-repositorios/av/obtenerRutaOptima/");
    }    
    
    /**
     *  UTILIZO EL SERVICIO DE OSRM
     */
    public function iniciarBusquedaDeClientes(){

        $this->setArrayDeClientesDeRepartidoresEnUnDia($this->obtenerListaDeClientesDeTodosLosRepartidoresEnUnDia());

    }

    public function obtenerListaDeClientesDeTodosLosRepartidoresEnUnDia(){
        /**
         * Consulta la DB. Busca todos los repartidores y sus clientes en un día
         */

         //HACER
         //LLAMAR A UNA FUNCION QUE ME DEVUELVA EL DÍA ACTUAL Y PASARLO A LA CONSULTA

        $db = new Database();

        $sql = 'SELECT clientesdir.Repartidor_Persona_IdRepartidor, clientesdir.ClientesDirectos_Persona_IdCliente, clientesdir.Direccion, clientesdir.Barrio_IdBarrio, clientesdir.Referencia, clientesdir.Latitud, clientesdir.Longitud, clientesdir.Barrio, p.Apellido, p.Nombre
        FROM (SELECT idRRC.Repartidor_Persona_IdRepartidor, idRRC.ClientesDirectos_Persona_IdCliente, d.Direccion, d.Barrio_IdBarrio, d.Referencia, d.Latitud, d.Longitud, b.Nombre as Barrio
	        FROM (SELECT dr.Repartidor_Persona_IdRepartidor, cddr.ClientesDirectos_Persona_IdCliente
		        FROM (SELECT idRutaDeReparto, Repartidor_Persona_IdRepartidor FROM diadereparto WHERE Dia = "LUNES") as dr, clientesdirectos__diadereparto as cddr
		        WHERE dr.idRutaDeReparto = cddr.ZonaDeReparto_idRutaDeReparto) as idRRC, direccion as d, barrio as b 
	        WHERE idRRC.ClientesDirectos_Persona_IdCliente = d.Persona_IdPersona AND d.Barrio_IdBarrio = b.IdBarrio) as clientesdir , persona p 
        WHERE p.IdPersona = clientesdir.ClientesDirectos_Persona_IdCliente';

        $db->connect();
        $db->sql($sql);
        $resultado = $db->getResult();
        $db->disconnect();

        return($resultado);

    }
    
    public function enviarClientesAlServidorOsrm(){

        $this->setArrayRepartidores($this->obtenerRepartidores());
        $arrayObjetosDeOsrm = array();
        for ($indice=0; $indice < 1; $indice++) { 

//count($this->getArrayRepartidores()

            $arrayDeCoordenadasDeClientes = $this->obtenerClientesDelRepartidor($indice); 

            $osrm = new mainOsrm();
            $recurso = new recursosOsrm();

            $osrm->setRecursoOsrm($recurso);
            $osrm->setArrayClientes($arrayDeCoordenadasDeClientes);

            $osrm->solicitarMatrizAlServidorOsrmConDepositoPorDefecto();
    
            $arrayObjetosDeOsrm[] = $osrm;
            }
            
           
        

        $this->setArrayDatosOsrm($arrayObjetosDeOsrm);
    }

    public function obtenerRepartidores(){

        $db = new Database();

        $sql = 'SELECT r.Persona_IdRepartidor FROM repartidor r ';

        $db->connect();
        $db->sql($sql);
        $resultado = $db->getResult();
        $db->disconnect();

        return($resultado);

    }

    public function obtenerClientesDelRepartidor($indice){
        /**
         * 
         * Recibe array con todos los clientes de cada repartidor
         * 
         * DEVUELVE
         * Array de clientes de un repartidor
         *       
         *      coordenadasGeograficas
         *          latitud
         *          longitud
         */

        $arrayDeClientes = array();

        for ($i=0; $i <count($this->getArrayDeClientesDeRepartidoresEnUnDia()) ; $i++) {

            if ($this->getArrayDeClientesDeRepartidoresEnUnDia()[$i][constantesDB::$diaDeReparto_idRepartidor] === $this->getArrayRepartidores()[$indice][constantesDB::$repartidor_id]) {
                $arrayDeClientes[] = coordenadasGeograficas::construirObjetoConLatitudLongitud($this->getArrayDeClientesDeRepartidoresEnUnDia()[$i][constantesDB::$direccion_latitud],$this->getArrayDeClientesDeRepartidoresEnUnDia()[$i][constantesDB::$direccion_longitud]);
            }


        } 

        return $arrayDeClientes;

    }

    public function obtenerNodosClientesDelRepartidorParaOptaplanner($indice){
        /**
         * 
         * 
         * 
         * DEVUELVE
         * Array de clientes de un repartidor
         *       
         *      coordenadasGeograficas
         *          latitud
         *          longitud
         *      idCliente
         */  
        $recurso = new recursosOsrm();
        $arrayDeNodosClientes = array();
        $depositos = $recurso->getDeposito();
        $nombresDeposito = $recurso->getNombreDeposito();

        $this->setCantidadDepositos(count($depositos));

        for ($i=0; $i < $this->getCantidadDepositos(); $i++) { 
            $arrayDeNodosClientes[] = array($depositos[$i],$nombresDeposito[$i]);
        }

        for ($i=0; $i <count($this->getArrayDeClientesDeRepartidoresEnUnDia()) ; $i++) {

            if ($this->getArrayDeClientesDeRepartidoresEnUnDia()[$i][constantesDB::$diaDeReparto_idRepartidor] === $this->getArrayRepartidores()[$indice][constantesDB::$repartidor_id]) {
                $arrayDeNodosClientes[] = array(coordenadasGeograficas::construirObjetoConLatitudLongitud($this->getArrayDeClientesDeRepartidoresEnUnDia()[$i][constantesDB::$direccion_latitud],$this->getArrayDeClientesDeRepartidoresEnUnDia()[$i][constantesDB::$direccion_longitud]),$this->getArrayDeClientesDeRepartidoresEnUnDia()[$i][constantesDB::$clientesDirectosDiaDeReparto_idCliente]);
            }


        } 

        return $arrayDeNodosClientes;

    }


    /**
     * SE SELECCIONAN CIERTOS DATOS DE LA SALIDA DE OSRM. 
     * SE CONVIERTEN ESOS DATOS EN UNA ARCHIVO DATASET.
     * ESTE ARCHIVO DATASET ES NECESARIO PARA QUE OPTAPLANNER PUEDA FUNCIONAR.
     * 
     */


    public function transformarDatosParaOptaplanner(){

        $matriz = $this->getArrayDatosOsrm()[0]->getMatrizOsrm();

        $nodosclientes = $this->obtenerNodosClientesDelRepartidorParaOptaplanner(0);
        
        $dataSet = dataSet::construirInstanciaConParametros(
            'prueba',
            'CVRP',
            'EXPLICIT',
            $nodosclientes,
            $this->getCantidadDepositos(),
            '1',
            'km',
            $matriz,
            count($nodosclientes),
            '100',
            'FULL_MATRIX',
            'ESTO ES UNA PRUEBA PARA CREAR UN DATASET by Matias Maldonado',
            '1',
            $this->getDirectorioDelDataSetAGenerar()
        
        
        );
        
        
        $resultado = $dataSet->crearArchivoDataSet();
        $this->setNombreDataSet($resultado);
    } 


    /**
     * UTILIZO EL SERVICIO DE OPTAPLANNER
     * 
     */


    public function enviarDataSetAOptaplannerParaOptimizacionDeRutas(){

        $optaPlanner = new mainOptaplanner();

        $optaPlanner->getRecursos()->setDirectorioDelDataSet($this->getDirectorioDelDataSetAGenerar());
        $optaPlanner->getRecursos()->setNombreDataSet($this->getNombreDataSet());

        $resultado = $optaPlanner->iniciarSolicitudAlServidorOptaplanner();
        $this->extraerDatosDelResultadoDeOptaplanner($resultado);

        
        
        
    } 

    public function extraerDatosDelResultadoDeOptaplanner($resultadoDeOptaplanner){
        
        $optaPlanner = new mainOptaplanner();

        

        if ($optaPlanner->esRespuestaValida($resultadoDeOptaplanner)) {

            $resultadoDeOptaplanner = json_decode($resultadoDeOptaplanner);
            if ($resultadoDeOptaplanner->feasible == "true") {

                $rutaDeClientesOptimizada = array();
            
                $rutaDeClientesOptimizada = $resultadoDeOptaplanner->vehicleRouteList[0]->customerList;

                

            }else {
                //HACER crear archivo de error
            }
        }else {
            //HACER crear archivo de error
        }


        
            
            
      
    }

/**
 * GETTERS AND SETTERS
 */

    /**
     * Get the value of arrayDatosOsrm
     */ 
    public function getArrayDatosOsrm()
    {
        return $this->arrayDatosOsrm;
    }

    /**
     * Set the value of arrayDatosOsrm
     *
     * @return  self
     */ 
    public function setArrayDatosOsrm(array $arrayDatosOsrm)
    {
        $this->arrayDatosOsrm = $arrayDatosOsrm;

        return $this;
    }

    /**
     * Get the value of arrayRepartidores
     */ 
    public function getArrayRepartidores()
    {
        return $this->arrayRepartidores;
    }

    /**
     * Set the value of arrayRepartidores
     *
     * @return  self
     */ 
    public function setArrayRepartidores($arrayRepartidores)
    {
        $this->arrayRepartidores = $arrayRepartidores;

        return $this;
    }

    /**
     * Get the value of arrayDeClientesDeRepartidoresEnUnDia
     */ 
    public function getArrayDeClientesDeRepartidoresEnUnDia()
    {
        return $this->arrayDeClientesDeRepartidoresEnUnDia;
    }

    /**
     * Set the value of arrayDeClientesDeRepartidoresEnUnDia
     *
     * @return  self
     */ 
    public function setArrayDeClientesDeRepartidoresEnUnDia($arrayDeClientesDeRepartidoresEnUnDia)
    {
        $this->arrayDeClientesDeRepartidoresEnUnDia = $arrayDeClientesDeRepartidoresEnUnDia;

        return $this;
    }

    /**
     * Get the value of cantidadDepositos
     */ 
    public function getCantidadDepositos()
    {
        return $this->cantidadDepositos;
    }

    /**
     * Set the value of cantidadDepositos
     *
     * @return  self
     */ 
    public function setCantidadDepositos($cantidadDepositos)
    {
        $this->cantidadDepositos = $cantidadDepositos;

        return $this;
    }

    /**
     * Get the value of directorioDelDataSetAGenerar
     */ 
    public function getDirectorioDelDataSetAGenerar()
    {
        return $this->directorioDelDataSetAGenerar;
    }

    /**
     * Set the value of directorioDelDataSetAGenerar
     *
     * @return  self
     */ 
    public function setDirectorioDelDataSetAGenerar($directorioDelDataSetAGenerar)
    {
        $this->directorioDelDataSetAGenerar = $directorioDelDataSetAGenerar;

        return $this;
    }

    /**
     * Get the value of nombreDataSet
     */ 
    public function getNombreDataSet()
    {
        return $this->nombreDataSet;
    }

    /**
     * Set the value of nombreDataSet
     *
     * @return  self
     */ 
    public function setNombreDataSet($nombreDataSet)
    {
        $this->nombreDataSet = $nombreDataSet;

        return $this;
    }
}

$rutaOptima = new rutaOptima();

$rutaOptima->iniciarBusquedaDeClientes();
$rutaOptima->enviarClientesAlServidorOsrm();
$rutaOptima->transformarDatosParaOptaplanner();
$rutaOptima->enviarDataSetAOptaplannerParaOptimizacionDeRutas();



