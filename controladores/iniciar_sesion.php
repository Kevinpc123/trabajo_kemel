<?php
session_start();
require_once '../database/conexion.php';
require_once '../modelos/UsuarioDAO.php';
require_once '../modelos/UsuarioDTO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];

    $usuarioDAO = new UsuarioDAO($conexion);
    $usuarioDTO = new UsuarioDTO($nickname, $password);
    $resultado = $usuarioDAO->obtenerUsuarioPorCredenciales($nickname, $password);

    if ($resultado) {
        $_SESSION['usuario'] = serialize($usuarioDTO);
        header("Location: ../vistas/InicioConUsuario.php");
        exit;
    } else {
        $_SESSION['error'] = "Usuario o contraseña incorrectos.";
        header("Location: ../vistas/login.php");
        exit;
    }
}
?>
