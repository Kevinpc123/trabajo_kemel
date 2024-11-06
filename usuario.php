<?php
class Usuario {
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

    public function getUsuario() {
        return $this->usuario;
    }

    public function getNombreCompleto() {
        return $this->nombre . ' ' . $this->apellido;
    }
}
?>