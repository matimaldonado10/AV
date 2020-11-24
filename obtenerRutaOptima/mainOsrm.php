<?php
/**
 * OTIENE UNA MATRIZ DE DISTACIA DE X CANTIDAD DE CLIENTES
 * LOS CLIENTES NO SON REALES
 * TODOS LAS COORDENADAS SON CREADAS DE FORMA ALEATORIA
 */
include_once "recursosOsrm.php";

class mainOsrm
{

	private $recursoOsrm;

	private $matrizOsrm;

	private $arrayClientes;

	private $ruta;

	public function __construct()
	{

	}

	public function solicitarMatrizAlServidorOsrmConDepositoPorDefecto()
	{

		try {

			$this->recursoOsrm->setCoordenadasDeClientes($this->getArrayClientes());

			$matriz = $this->recursoOsrm->obtenerMatrizDeDistancia();

			$this->setMatrizOsrm($matriz);

		} catch (Exception $mensajeDeExcepcion) {
			echo 'Mensaje: ' . $mensajeDeExcepcion->getMessage();
		}

	}

	public function solicitarEnrutamiento()
	{

		try {

			$this->recursoOsrm->setCoordenadasDeClientes($this->getArrayClientes());

			$ruta = $this->recursoOsrm->crearSolicitudRouteYEnviar();

			$this->setRuta($ruta);

		} catch (Exception $mensajeDeExcepcion) {
			echo 'Mensaje: ' . $mensajeDeExcepcion->getMessage();
		}

	}

	/**
	 * Get the value of recursoOsrm
	 */
	public function getRecursoOsrm()
	{
		return $this->recursoOsrm;
	}

	/**
	 * Set the value of recursoOsrm
	 *
	 * @return  self
	 */
	public function setRecursoOsrm(recursosOsrm $recursoOsrm)
	{
		$this->recursoOsrm = $recursoOsrm;

		return $this;
	}

	/**
	 * Get the value of matrizOsrm
	 */
	public function getMatrizOsrm()
	{
		return $this->matrizOsrm;
	}

	/**
	 * Set the value of matrizOsrm
	 *
	 * @return  self
	 */
	public function setMatrizOsrm(array $matrizOsrm)
	{
		$this->matrizOsrm = $matrizOsrm;

		return $this;
	}

	/**
	 * Get the value of arrayClientes
	 */
	public function getArrayClientes()
	{
		return $this->arrayClientes;
	}

	/**
	 * Set the value of arrayClientes
	 *
	 * @return  self
	 */
	public function setArrayClientes(array $arrayClientes)
	{
		$this->arrayClientes = $arrayClientes;

		return $this;
	}

	/**
	 * Get the value of ruta
	 */
	public function getRuta()
	{
		return $this->ruta;
	}

	/**
	 * Set the value of ruta
	 *
	 * @return  self
	 */
	public function setRuta(String $ruta)
	{
		$this->ruta = $ruta;

		return $this;
	}
}
