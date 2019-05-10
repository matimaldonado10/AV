<?php
include_once ("coordenasGeograficas.php");
class areaDeclientes{
	private $coordenadaDeInicio;
	private $coordenadaDeFin;


    public function __construct(){
        $this->coordenadaDeInicio = coordenadasGeograficas::construirObjetoConLatitudLongitud(-26.8000,-60.4548);
        $this->coordenadaDeFin = coordenadasGeograficas::construirObjetoConLatitudLongitud(-26.7680,-60.4148);
    }
        

	public function crearCoordenadaAleatoria(coordenasGeograficas $ubicacionDeCliente ){

		if (esExistenCoordenadasDeZona()) {
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
		if (esCoordenadaContieneDecimal($this->coordenadaDeInicio->latitud,$this->coordenadaDeFin->latitud)) {
			$coordenadaEntera = obtenerCoordenadaValorAleatorio($this->coordenadaDeInicio->latitud,$this->coordenadaDeFin->latitud);
		
			$coordenadaDecimal = obtenerCoordenadaValorAleatorio(extraerCoordenadaDecimal($this->coordenadaDeInicio->latitud), extraerCoordenadaDecimal($this->coordenadaDeFin->latitud));
			return floatval('$coordenadaEntera'.'.'.'$coordenadaDecimal');  

		}else {

			$coordenadaEntera = obtenerCoordenadaValorAleatorio($this->coordenadaDeInicio->latitud,$this->coordenadaDeFin->latitud);
			return floatval('$coordenadaEntera');  

		}
		

	}
	public function esCoordenadaContieneDecimal($coordenadaDeInicio, $coordenadaDeFin){
		$flag = false;
		if ( count($arrayCoordenadas = explode(“.”,$coordenadaDeInicio)) == 2 ){
			if (count($arrayCoordenadas = explode(“.”,$coordenadaDeFin)) == 2 ) {
				return $flag = true;			
			}
		}

		return $flag;
	}

	
	public function crearLongitud()
	{
		if (esCoordenadaContieneDecimal($this->coordenadaDeInicio->longitud,$this->coordenadaDeFin->longitud)) {
			$coordenadaEntera = obtenerCoordenadaValorAleatorio($this->coordenadaDeInicio->longitud,$this->coordenadaDeFin->longitud);
		
			$coordenadaDecimal = obtenerCoordenadaValorAleatorio(extraerCoordenadaDecimal($this->coordenadaDeInicio->longitud), extraerCoordenadaDecimal($this->coordenadaDeFin->longitud));
			return floatval('$coordenadaEntera'.'.'.'$coordenadaDecimal');  

		}else {

			$coordenadaEntera = obtenerCoordenadaValorAleatorio($this->coordenadaDeInicio->latitud,$this->coordenadaDeFin->latitud);
			return floatval('$coordenadaEntera');  

		}	
	  
	}	

	

	public function extraerCoordenadaDecimal(Double $coordenada){
		$arrayCoordenadas = explode(“.”,$coordenada);
		return intval($arrayCoordenadas[1]) ;
	}

	public function obtenerCoordenadaValorAleatorio($mínimo, $maximo){
		return mt_rand($mínimo,$maximo);
	}



	
	public function getCoordenadaDeInicio()
	{
		return $this->coordenadaDeInicio;
	}

	
	public function setCoordenadaDeInicio(coordenadaGeografica $coordenadaDeInicio)
	{
		$this->coordenadaDeInicio = $coordenadaDeInicio;

		return $this;
	}

	
	public function getCoordenadaDeFin()
	{
		return $this->coordenadaDeFin;
	}

	
	public function setCoordenadaDeFin(coordenadaGeografica $coordenadaDeFin)
	{
		$this->coordenadaDeFin = $coordenadaDeFin;

		return $this;
	}
}