<?php

/**
* 
*/
class coordenadasGeograficas{

	private $latitud;
	private $longitud;

	public function __construct(){}

	public static function construirObjetoConLatitudLongitud($latitud, $longitud){
		$instancia = new self();
		$instancia->setLatitud($latitud);
		$instancia->setLongitud($longitud);
		return $instancia;
	}

	

		
	public function latitud()
		{
			$lat = mt_rand(-26,-26);
		  
		 return $lat;  
					
		}

	public function latitudDecimal()
	{
		$latDecimal = mt_rand(7680,8000);
		  
		 return $latDecimal;  
					
	}
		
		

	public function longitud()
		{
			
		    $long = mt_rand(-60.4548,-60.4148);
		    return $long;
		}

	public function longitudDecimal()
		{
			$longDecimal = mt_rand(4148,4548);
			  
			 return $longDecimal;  
						
		}

	
	public function getLatitud()
	{
		return $this->latitud;
	}

	
	public function setLatitud(Double $latitud)
	{
		if (esLatitudValida($latitud)) {
			$this->latitud = $latitud;

		}
		

		return $this;
	}

	
	public function getLongitud()
	{
		return $this->longitud;
	}

	
	public function setLongitud(Double $longitud)
	{
		if (esLongitudValida($longitud)) {
			$this->longitud = $longitud;
		}
		
		return $this;
	}

	function esLatitudValida($latitud){
		return ($latitud>-90 && $latitud<90);
	}

	function esLongitudValida($longitud){
		return ($longitud>-180 && $longitud<180);
	}
}
	
