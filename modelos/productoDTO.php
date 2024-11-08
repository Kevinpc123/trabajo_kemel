<?php
class productoDTO{
    private $id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $categoria;

    public function getIdproducto($id,$nombre,$descripcion,$precio,$categoria){
    $this->id = $id;
    $this->nombre = $nombre;
    $this->descripcion = $descripcion;
    $this->precio = $precio;
    $this->categoria = $categoria;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id): void
    {
        $this->id = $id;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }
    public function getPrecio()
    {
        return $this->precio;
    }
    public function setPrecio($precio): void
    {
        $this->precio = $precio;
    }
    public function getCategoria()
    {
        return $this->categoria;
    }
    public function setCategoria($categoria): void
    {
        $this->categoria = $categoria;
    }

}
