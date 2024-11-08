<?php
class UsuarioDTO {
    private $usuario;
    private $contraseña;
    private $nombre;
    private $apellido;

    public function __construct($usuario, $contraseña, $nombre, $apellido) {
        $this->usuario = $usuario;
        $this->contraseña = $contraseña;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }

    // Getters
    public function getUsuario() {
        return $this->usuario;
    }

    public function getContraseña() {
        return $this->contraseña;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getNombreCompleto() {
        return $this->nombre . ' ' . $this->apellido;
    }

    // Setters
    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function setContraseña($contraseña) {
        $this->contraseña = $contraseña;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }
}
?>
