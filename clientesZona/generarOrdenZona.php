<?php
include_once ('tablas.php');
class generarOrdenZona
{
	

	

	public function generarOrden($idZonaReparto)
	{
		$tabla = new tablas();
		$registroClienteZona = $tabla->obtenerClientesZona($idZonaReparto);
		
		if (empty($registroClienteZona)) 
		{
			$orden = 1;
		}
		else
		{
			$orden = count($registroClienteZona)+1;
		}
		

	 return $orden; 
	}
}


