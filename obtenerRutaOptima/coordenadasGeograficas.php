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

		

		if ($instancia->esLatitudValida($latitud) && $instancia->esLongitudValida($longitud)) {
			$instancia->setLatitud($latitud);
			$instancia->setLongitud($longitud);
		}else {
			# code...
		}

		
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

	
	public function setLatitud(Float $latitud)
	{
		if ($this->esLatitudValida($latitud)) {
			$this->latitud = $latitud;

		}
		else {
			# code...
		}
		

		return $this;
	}

	
	public function getLongitud()
	{
		return $this->longitud;
	}

	
	public function setLongitud(Float $longitud)
	{
		if ($this->esLongitudValida($longitud)) {
			$this->longitud = $longitud;
		}
		
		return $this;
	}

	private function esLatitudValida($latitud){
		return ($latitud>-90 && $latitud<90);
	}

	private function esLongitudValida($longitud){
		return ($longitud>-180 && $longitud<180);
	}
}
	
