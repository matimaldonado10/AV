<?php
include_once('persona.php');
include_once('interface.php');

class supervisor extends persona implements interfaceArticulos{
    private $usuario;
    private $contraseña;

    public function __construct(){

    }


    ////chequear esto más adelante
    function obtenerTablaDeArticulos(){
        $db = new Database();
		$db->connect();
		$db->select('articulo','IdArticulo, Nombre, Precio',NULL,NULL,'IdArticulo ASC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
        $Registros = $db->getResult();
        

        //HACER esto puede llevarse a una función 
        for ($i=0;$i<count($Registros) ; $i++) {
            $Registros[$i]["Nombre"] = utf8_encode($Registros[$i]["Nombre"]);
            //$Registros[$i]["Nombre"] = iconv("CP1255", "UTF-8", $Registros[$i]["Nombre"]);

 
        }



        $db->disconnect();


		return $Registros;
    }
    

    /**
     * Get the value of usuario
     */ 
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set the value of usuario
     *
     * @return  self
     */ 
    public function setUsuario(string $usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get the value of contraseña
     */ 
    public function getContraseña()
    {
        return $this->contraseña;
    }

    /**
     * Set the value of contraseña
     *
     * @return  self
     */ 
    public function setContraseña(string $contraseña)
    {
        $this->contraseña = $contraseña;

        return $this;
    }
}