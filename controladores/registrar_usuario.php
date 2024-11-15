<?php
session_start();
require_once '../database/conexion.php';
require_once '../modelos/UsuarioDAO.php';
require_once '../modelos/UsuarioDTO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $domicilio = $_POST['domicilio'];

    $usuarioDAO = new UsuarioDAO($conexion);
    $usuarioDTO = new UsuarioDTO($nickname, $password, $nombre, $apellido, $telefono, $domicilio);
    $creacionExitosa = $usuarioDAO->crearUsuario($nickname, $password, $nombre, $apellido, $telefono, $domicilio);
    if ($creacionExitosa) {
        $_SESSION['usuario'] = serialize($usuarioDTO);
        header("Location: ../vistas/InicioConUsuario.php");
        exit();
    } else {
        echo "Error al crear el usuario.";
    }

}
?>
