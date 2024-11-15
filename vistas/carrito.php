<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Virtual Tech Company Inicio</title>
    <link rel="stylesheet" href="../recursos/css/estilo.css">
    <style>
        html, body {
            overflow-x: hidden;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .informacion h3 {
            font-size: 1.5em;
            margin: 0;
        }

        .informacion p {
            margin: 5px 0;
            color: black;
        }

        #buscador-contenedor {
            display: none;
            position: absolute;
            top: 50%;
            right: -275px;
            transform: translateY(-50%);
        }

        #buscador {
            padding: 8px;
            font-size: 16px;
            width: 200px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #buscar-btn {
            padding: 8px;
            background-color: #ff914d;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #buscar-btn:hover {
            background-color: #ff7a00;
        }

        #buscador-toggle:checked + #buscador-contenedor {
            display: block;
        }

    </style>
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    require_once '../database/conexion.php';
    require_once '../modelos/ProductoDAO.php';
    require_once '../modelos/ProductoDTO.php';
    require_once '../modelos/UsuarioDTO.php';
    include_once '../controladores/carrito_controlador.php';
    include_once '../controladores/gestion_carrito.php';
    $productoDAO = new productoDAO($conexion);
    $productos = $productoDAO->obtenerProductos();

    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php");
        exit;
    }

    $usuario = unserialize($_SESSION['usuario']);
    $nickname = $usuario->getNickname();
    ?>
</head>
<body>
<header>
    <nav>
        <img src="../recursos/imagenes/logo_2%20(1).svg" class="logo">
        <div class="menu">
            <a href="InicioConUsuario.php">Inicio</a>
            <div class="desplegable">
                <a href="#">Categorías</a>
                <div class="desplegable-contenido">
                    <a href="#">Premium</a>
                    <a href="#">Standar</a>
                    <a href="#">Basic</a>
                </div>
            </div>
            <a href="#">Financiación</a>
            <div class="desplegable">
                <a href="#">Acerca de</a>
                <div class="desplegable-contenido">
                    <a href="#">Nosotros</a>
                    <a href="#">Servicios</a>
                </div>
            </div>
            <div class="desplegable">
                <a href="#"><?= htmlspecialchars($nickname) ?></a>
                <div class="desplegable-contenido">
                    <a href="#">Ver perfil</a>
                    <a href="#">Configuracion de cuenta</a>
                    <a href="trastienda.php">Gestion de la trastienda</a>
                    <a href="../controladores/cerrarsesion.php">Cerrar sesión</a>
                </div>
            </div>
            <?php
            if (isset($_SESSION['usuario'])):?>
                <a href="#">
                    <img src="../recursos/imagenes/icons8-agregar-a-carrito-de-compras-50.png" class="icono-registro"
                         alt="icono-registro">
                </a>
                <a></a>
            <?php endif;
            ?>
            <?php
            if (isset($_SESSION['usuario'])):?>
                <label for="buscador-toggle">
                    <img src="../recursos/imagenes/icons8-google-web-search-50.png" class="icono-registro"
                         alt="Buscador">
                </label>
                <input type="checkbox" id="buscador-toggle" style="display: none;">
                <div id="buscador-contenedor">
                    <input type="text" id="buscador" placeholder="Buscar...">
                    <button type="button" id="buscar-btn">Buscar</button>
                </div>
            <?php endif;
            ?>
        </div>
    </nav>
</header>
<div class="seccion-principal">
    <img src="../recursos/imagenes/black_friday_2.png" alt="Fondo" class="imagen-fondo">
    <div class="texto">
        <a href="#" class="boton-reserva">Ver ahora</a>
    </div>
</div>
<!--CARRITO -->
<?php
mostrarCarrito($conexion);
?>
<footer>
    <div class="footer-contenedor">
        <div class="footer-links">
            <a href="">Politicas de privacidad</a>
            <a href="">Terminos y condiciones</a>
            <a href="">Preguntas frecuentes</a>
            <a href="">Soporte</a>
        </div>
        <div class="footer-redes">
            <h4>CONTACTO</h4>
            <p>Correo: proyectoTienda@gmail.com</p>
            <p>telefono: 999 033 030</p>
        </div>
    </div>
</footer>
</body>
</html>
