<?php
session_start();  // Asegúrate de que session_start esté al inicio

// Habilitar la visualización de errores para facilitar la depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir archivos de conexión y clases necesarias
require_once 'conexion.php';
require_once 'usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $telefono = isset($_POST['telefono']) && !empty($_POST['telefono']) ? $_POST['telefono'] : NULL;  // Si no se ingresa teléfono, se asigna NULL
    $domicilio = isset($_POST['domicilio']) && !empty($_POST['domicilio']) ? $_POST['domicilio'] : NULL;  // Lo mismo para domicilio

    try {
        // Preparar la consulta SQL para insertar los datos
        $stmt = $dwes->prepare("INSERT INTO Cliente (nombre, apellido, password, nickname, telefono, domicilio) VALUES (:nombre, :apellido, :password, :usuario, :telefono, :domicilio)");

        // Ejecutar la consulta
        $stmt->execute([
            'nombre' => $nombre,
            'apellido' => $apellidos,
            'password' => $contraseña,
            'usuario' => $usuario,
            'telefono' => $telefono,
            'domicilio' => $domicilio
        ]);

        // Crear un nuevo objeto Usuario y almacenarlo en la sesión
        $nuevoUsuario = new Usuario($usuario, $contraseña, $nombre, $apellidos);
        $_SESSION['usuario'] = $nuevoUsuario;

        // Redirigir al usuario a la página de inicio
        header("Location: Inicio.php");
        exit;  // Asegúrate de que el script termine aquí
    } catch (PDOException $e) {
        echo "Error en la inserción: " . $e->getMessage();  // Mostrar cualquier error SQL
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
    <link rel="stylesheet" href="estilo.css">
    <style>
        /* Estilos CSS */
        .inicio-sesion{
            background-color: rgba(255, 255, 255, 0);
            color: white;
            box-shadow: 0 2px 50px #ff914d;
            padding: 50px 20px;
            border-radius: 8px;
            max-width: 800px;
            margin: 20px auto;
            text-align: center;
        }
        .inicio-sesion h2{
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #ff914d;
        }
        .formulario-sesion{
            margin-bottom: 15px;
            text-align: left;
        }
        .formulario-sesion label{
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .formulario-sesion input,
        .formulario-sesion textarea{
            width: 100%;
            padding: 10px;
            border: 1px solid #ff914d;
            border-radius: 4px;
            font-size: 1em;
        }
        .formulario-sesion textarea{
            resize: vertical;
        }
        button{
            background-color: #ff914d;
            color: white;
            border: none;
            padding: 6px 70px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1.1em;
        }
        button:hover{
            background-color: #0057b300;
        }
        .enlace{
            display: block;
            margin: 10px 0;
            color: white;
            text-decoration: none;
        }
        .enlace:hover{
            text-decoration: underline;
        }
    </style>
</head>
<body>
<header>
    <nav>
        <img src="imagenes/logo_2%20(1).svg" class="logo">
        <div class="menu">
            <a href="InicioSinUsuario.php">Inicio</a>
            <div class="desplegable">
                <a href="#">Coches</a>
                <div class="desplegable-contenido">
                    <a href="#">Premium</a>
                    <a href="#">Standar</a>
                    <a href="#">Basic</a>
                </div>
            </div>
            <a href="#">Alquilar</a>
            <div class="desplegable">
                <a href="#">Acerca de</a>
                <div class="desplegable-contenido">
                    <a href="#">Nosotros</a>
                    <a href="#">Servicios</a>
                </div>
            </div>
            <?php if(!isset($_SESSION['usuario'])): ?>
                <a href="login.php">
                    <img src="imagenes/icons8-registro-50.png" class="icono-registro" alt="Registro/Iniciar Secion">
                </a>
            <?php endif; ?>
        </div>
    </nav>
</header>

<div class="seccion-principal">
    <img src="imagenes/bg.jpg" alt="Fondo" class="imagen-fondo">
    <section class="inicio-sesion">
        <h2>Registro de Usuario</h2>
        <form method="POST">
            <div class="formulario-sesion">
                <label>Nombre</label>
                <input type="text" name="nombre" required>
            </div>
            <div class="formulario-sesion">
                <label>Apellido</label>
                <input type="text" name="apellidos" required>
            </div>
            <div class="formulario-sesion">
                <label>Nickname</label>
                <input type="text" name="usuario" required>
            </div>
            <div class="formulario-sesion">
                <label>Contraseña</label>
                <input type="password" name="contraseña" required>
            </div>
            <div class="formulario-sesion">
                <label>Domicilio</label>
                <input type="password" name="domicilio">
            </div>
            <div class="formulario-sesion">
                <label>Teléfono</label>
                <input type="password" name="telefono">
            </div>
            <button type="submit" name="iniciar_sesion" class="btn2">Crear cuenta</button>
            <p class="enlace">¿Ya tienes una cuenta? <a href="login.php" class="enlace">Iniciar sesión</a></p>
        </form>
    </section>
</div>
</body>
</html>
