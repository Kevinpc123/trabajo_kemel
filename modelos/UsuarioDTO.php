<?php

class UsuarioDTO
{
    private $nickname;
    private $password;
    private $nombre;
    private $apellido;
    private $telefono;
    private $domicilio;

    public function __construct($nickname = "", $password = "", $nombre = "", $apellido = "", $telefono = "", $domicilio = "")
    {
        $this->nickname = $nickname;
        $this->password = $password;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->telefono = $telefono;
        $this->domicilio = $domicilio;
    }

    public function getNickname()
    {
        return $this->nickname;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getDomicilio()
    {
        return $this->domicilio;
    }

    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;
    }
}

?>
