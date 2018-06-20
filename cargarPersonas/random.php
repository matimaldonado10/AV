<?php

/**
* 
*/
class random 
{
	
	public function alAzar()
		{
			$min=1;
		    $max=20000;
		    $indice = rand($min,$max);
		  
		 return $indice;  
			
			//print_r(count($registros));
		}

		public function alAzarBarrios($registros)
		{
			$min=1;
		    $max=count($registros);
		    $indice = rand($min,$max);


		    
		return $indice;
		}

		public function alAzarRol($min, $max)
		{
			$indice = rand($min,$max);
			return $indice;

		}
}
	