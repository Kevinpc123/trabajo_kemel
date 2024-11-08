<?php
include_once 'config/database.php';
include_once 'Usuario.php';

class UsuarioDAO {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }

    public function registrarUsuario($usuario) {
        $query = "INSERT INTO usuarios (username, passwordHash, nombre, apellido) VALUES (:username, :passwordHash, :nombre, :apellido)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':username', $usuario->getUsername());
        $stmt->bindParam(':passwordHash', $usuario->getPasswordHash());
        $stmt->bindParam(':nombre', $usuario->getNombre());
        $stmt->bindParam(':apellido', $usuario->getApellido());

        return $stmt->execute();
    }

    public function obtenerUsuarioPorNombre($username) {
        $query = "SELECT * FROM usuarios WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetchObject('Usuario');
    }
}