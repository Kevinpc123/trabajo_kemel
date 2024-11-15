<?php

class ProductoDTO
{
    private $id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $cliente_id;
    private $imagen;

    public function __construct($id = null, $nombre = null, $descripcion = null, $precio = null, $cliente_id = null, $imagen = null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->cliente_id = $cliente_id;
        $this->imagen = $imagen;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    // Getters y setters
    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio): void
    {
        $this->precio = $precio;
    }


    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }


    public function getClienteId()
    {
        return $this->cliente_id;
    }


    public function setClienteId($cliente_id): void
    {
        $this->cliente_id = $cliente_id;
    }


}
