<?php

/**
* 
*/
class random 
{
	
	public function latitud()
		{
			$lat = mt_rand(-26.8000,-26.7680);
		  
		 return $lat;  
			
			
		}

	
		
		

	public function longitud()
		{
			
		    $long = mt_rand(-60.4548,-60.4148);
		    return $long;
		}
}
	