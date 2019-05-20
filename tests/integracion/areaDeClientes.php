<?php
include_once ('/home/mati/git-repositorios/av/obtenerRutaOptima/coordenadasGeograficas.php');
class areaDeclientes{
	private $coordenadaDeInicio;
	private $coordenadaDeFin;


    public function __construct(){
		//coordenadas dentro de saenz peña
        $this->coordenadaDeInicio = coordenadasGeograficas::construirObjetoConLatitudLongitud(-26.8000,-60.4548);
        $this->coordenadaDeFin = coordenadasGeograficas::construirObjetoConLatitudLongitud(-26.7680,-60.4148);
    }
        

	public function crearCoordenadaAleatoria(coordenadasGeograficas $ubicacionDeCliente ){

		if ($this->esExistenCoordenadasDeZona()) {
			$ubicacionDeCliente->setLatitud($this->crearLatitud());
			$ubicacionDeCliente->setLongitud($this->crearLongitud());
			return $ubicacionDeCliente;
			
		}else{
			return false;
		}
	}

	public function esExistenCoordenadasDeZona(){
		return ($this->coordenadaDeInicio != null && $this->coordenadaDeFin != null );
		
	}
	
	public function crearLatitud()
	{
		if ($this->esCoordenadaContieneDecimal($this->coordenadaDeInicio->getLatitud(),$this->coordenadaDeFin->getLatitud())) {
			$coordenadaEntera = $this->obtenerCoordenadaValorAleatorio($this->coordenadaDeInicio->getLatitud(),$this->coordenadaDeFin->getLatitud());
		
			$coordenadaDecimal = $this->obtenerCoordenadaValorAleatorio($this->extraerCoordenadaDecimal($this->coordenadaDeInicio->getLatitud()), $this->extraerCoordenadaDecimal($this->coordenadaDeFin->getLatitud()));
			return floatval($coordenadaEntera.'.'.$coordenadaDecimal);  

		}else {

			$coordenadaEntera = $this->obtenerCoordenadaValorAleatorio($this->coordenadaDeInicio->getLatitud(),$this->coordenadaDeFin->getLatitud());
			return floatval($coordenadaEntera);  

		}
		

	}
	private function esCoordenadaContieneDecimal($coordenadaDeInicio, $coordenadaDeFin){
		$flag = false;
		if ( count($arrayCoordenadas = explode('.',$coordenadaDeInicio)) == 2 ){
			if (count($arrayCoordenadas = explode('.',$coordenadaDeFin)) == 2 ) {
				return $flag = true;			
			}
		}

		return $flag;
	}

	
	public function crearLongitud()
	{
		if ($this->esCoordenadaContieneDecimal($this->coordenadaDeInicio->getLongitud(),$this->coordenadaDeFin->getLongitud())) {
			$coordenadaEntera = $this->obtenerCoordenadaValorAleatorio($this->coordenadaDeInicio->getLongitud(),$this->coordenadaDeFin->getLongitud());
		
			$coordenadaDecimal = $this->obtenerCoordenadaValorAleatorio($this->extraerCoordenadaDecimal($this->coordenadaDeFin->getLongitud()), $this->extraerCoordenadaDecimal($this->coordenadaDeInicio->getLongitud()));
			return floatval($coordenadaEntera.'.'.$coordenadaDecimal);  

		}else {

			$coordenadaEntera = $this->obtenerCoordenadaValorAleatorio($this->coordenadaDeInicio->getLongitud(),$this->coordenadaDeFin->getLongitud());
			return floatval($coordenadaEntera);  

		}	
	  
	}	

	

	public function extraerCoordenadaDecimal(Float $coordenada){
		$arrayCoordenadas = explode('.',$coordenada);
		return intval($arrayCoordenadas[1]) ;
	}

	public function obtenerCoordenadaValorAleatorio($mínimo, $maximo){
		return mt_rand($mínimo,$maximo);
	}



	
	public function getCoordenadaDeInicio()
	{
		return $this->coordenadaDeInicio;
	}

	
	public function setCoordenadaDeInicio(coordenadasGeograficas $coordenadaDeInicio)
	{
		$this->coordenadaDeInicio = $coordenadaDeInicio;

		return $this;
	}

	
	public function getCoordenadaDeFin()
	{
		return $this->coordenadaDeFin;
	}

	
	public function setCoordenadaDeFin(coordenadasGeograficas $coordenadaDeFin)
	{
		$this->coordenadaDeFin = $coordenadaDeFin;

		return $this;
	}
}