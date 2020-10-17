<?php
include 'dniTabla.php';
class generarDni
{

	public function generarDniAleatorio($cantidad)
	{
		$dt = new dniTabla();

		//$dniTabla = array();
		$dniTabla = $dt->obtenerDniTabla();

		$valores = array();
		$x       = 1;
		$min     = 10000000;
		$max     = 40000000;

		while ($x <= $cantidad) {
			$num_aleatorio = mt_rand($min, $max); // Crea un DNI aleatorio entre valores mínimos y máximos

			if (!in_array($num_aleatorio, $valores)) // pregunta si el dni no existe
			{
				if (!in_array($num_aleatorio, $dniTabla)) {
					array_push($valores, $num_aleatorio); // lo carga al arreglo
					$x++;
				}

			}

		}

		return $valores; //retorno un arreglo con DNIs únicos no existentes en la tabla persona
	}
}
