<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once '../database/conexion.php';
require_once '../modelos/UsuarioDAO.php';
require_once '../modelos/UsuarioDTO.php';

$error = isset($_SESSION['error']) ? $_SESSION['error'] : "";
unset($_SESSION['error']);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="../recursos/css/estilo.css">
    <style>
        body {
            background-color: black;
        }

        .inicio-sesion {
            background-color: rgba(255, 255, 255, 0);
            color: white;
            box-shadow: 0 2px 50px #ff914d;
            padding: 50px 50px;
            border-radius: 8px;
            max-width: 800px;
            margin: 20px auto;
            text-align: center;
        }

        .inicio-sesion h2 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #ff914d;
        }

        .formulario-sesion {
            margin-bottom: 15px;
            text-align: left;
        }

        .formulario-sesion label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .formulario-sesion input,
        .formulario-sesion textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ff914d;
            border-radius: 4px;
            font-size: 1em;
        }

        .formulario-sesion textarea {
            resize: vertical;
        }

        button {
            background-color: #ff914d;
            color: white;
            border: none;
            padding: 6px 70px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1.1em;
        }

        button:hover {
            background-color: #0057b300;
        }

        .enlace {
            display: block;
            margin: 10px 0;
            color: white;
            text-decoration: none;
        }

        .enlace:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>

</head>
<body>
<header>
    <nav>
        <img src="../recursos/imagenes/logo_2%20(1).svg" class="logo">
        <div class="menu">
            <a href="index.php">Inicio</a>
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
            <?php
            if (!isset($_SESSION['usuario'])):?>
                <a href="login.php">
                    <img src="../recursos/imagenes/icons8-registro-50.png" class="icono-registro"
                         alt="Registro/Iniciar Secion">
                </a>
            <?php endif;
            ?>
        </div>
    </nav>
</header>
<div class="seccion-principal">
    <section class="inicio-sesion">
        <h2>Iniciar sesión</h2>
        <form action="../controladores/iniciar_sesion.php" method="POST">
            <div class="formulario-sesion">
                <label for="nickname">Nombre de usuario</label>
                <input type="text" name="nickname" required>
            </div>
            <div class="formulario-sesion">
                <label for="password">Contraseña</label>
                <input type="password" name="password" required>
            </div>
            <a href="#" class="enlace">¿He olvidado mi contraseña?</a>
            <button type="submit" name="iniciar_sesion" class="btn2">Iniciar sesión</button>
            <p class="enlace">¿Eres nuevo cliente?</p>
            <button type="button" class="btn2"><a href="registro.php" class="enlace">Crear cuenta</a></button>
            <!-- Mensaje de error si existe -->
            <?php if ($error): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
        </form>
    </section>
</div>
</body>
</html>