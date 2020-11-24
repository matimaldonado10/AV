<?php
class articulo
{
	private $idArticulo;
	private $nombre;
	private $precio;

	/**
	 * Get the value of idArticulo
	 */
	public function getIdArticulo()
	{
		return $this->idArticulo;
	}

	/**
	 * Set the value of idArticulo
	 *
	 * @return  self
	 */
	public function setIdArticulo(int $idArticulo)
	{
		$this->idArticulo = $idArticulo;

		return $this;
	}

	/**
	 * Get the value of precio
	 */
	public function getPrecio()
	{
		return $this->precio;
	}

	/**
	 * Set the value of precio
	 *
	 * @return  self
	 */
	public function setPrecio(float $precio)
	{
		$this->precio = $precio;

		return $this;
	}

	/**
	 * Get the value of nombre
	 */
	public function getNombre()
	{
		return $this->nombre;
	}

	/**
	 * Set the value of nombre
	 *
	 * @return  self
	 */
	public function setNombre(string $nombre)
	{
		$this->nombre = $nombre;

		return $this;
	}
}