<?php

/**
 *
 */
class random
{

	public function alAzar($min, $max)
	{
		$valor = mt_rand($min, $max);

		return $valor;

	}

	public function alAzarFecha()
	{

		$min = strtotime("2001-01-01");
		$max = strtotime("2017-06-08");

		$numero = mt_rand($min, $max);
		$fecha = date("Y-m-d H:i:s", $numero);

		return $fecha;
	}

	public function alAzarPlata()
	{

		$pago = mt_rand(-800, 3000);
		return $pago;
	}
}
