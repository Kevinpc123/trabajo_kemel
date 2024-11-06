<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Virtual Tech Company Inicio</title>
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?php
    require_once 'usuario.php';
    session_start();

    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php");
        exit;
    }

    $nombreCompleto = $_SESSION['usuario']->getNombreCompleto();
    ?>
    <style>
        .seccion-productos{
            padding: 100px;
            text-align: center;
        }
        .seccion-productos h2{
            font-size: 2em;
            margin-bottom: 20px;
            color: #ff914d;
        }
        .producto-recuadro{
            display: inline-block;
            width: 300px;
            margin: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
    </style>
</head>
<body>
<header>
    <nav>
        <img src="imagenes/logo_2%20(1).svg" class="logo">
        <div class="menu">
            <a href="Inicio.php">Inicio</a>
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
                <a href="#"><?= htmlspecialchars($nombreCompleto)?></a>
                <div class="desplegable-contenido">
                    <a href="#">Ver perfil</a>
                    <a href="#">Configuracion de cuenta</a>
                    <a href="#">Ver notificaciones</a>
                    <a href="cerrarsesion.php">Cerrar sesión</a>
                </div>
            </div>
            <?php
            if(!isset($_SESSION['usuario'])):?>
                <a href="login.php">
                    <img src="imagenes/icons8-registro-50.png" class="icono-registro" alt="Registro/Iniciar Secion">
                </a>
            <?php endif;
            ?>
            <?php
            if(!isset($_SESSION['usuario'])):?>
                <a href="registro.php">
                    <img src="imagenes/icons8-agregar-a-carrito-de-compras-50.png" class="icono-registro" alt="Registro/Iniciar Secion">
                </a>
            <?php endif;
            ?>
            <?php
            if(!isset($_SESSION['usuario'])):?>
                <a href="registro.php">
                    <img src="imagenes/icons8-google-web-search-50.png" class="icono-registro" alt="Registro/Iniciar Secion">
                </a>
            <?php endif;
            ?>
        </div>
    </nav>
</header>
<div class="seccion-principal">
    <img src="imagenes/black_friday_2.png" alt="Fondo" class="imagen-fondo">
    <div class="texto">
        <a href="#" class="boton-reserva">Ver ahora</a>
    </div>
</div>
<!--CATALOGO DE PRODUCTOS-->
<div class="seccion-productos">
    <h2>Productos</h2>
    <div class="producto-recuadro">
        <div class="producto-contenedor">
            <img src="imagenes/black-laptop-screen-dark-room-night.png" class="primera-imagen">
            <img src="imagenes/black_friday_1.png" class="segunda-imagen">
        </div>
        <div class="informacion">
            <h3>Iphone 14 pro</h3>
            <p>Antes: 900€<span class="rebaja">Ahora: 780€</span></p>
            <p class="disponibilidad">Disponible</p>
        </div>
    </div>
</div>
<div class="producto-recuadro">
    <div class="producto-contenedor">
        <img src="imagenes/black-laptop-screen-dark-room-night.png" class="primera-imagen">
        <img src="imagenes/black_friday_1.png" class="segunda-imagen">
    </div>
    <div class="informacion">
        <h3>Iphone 14 pro</h3>
        <p>Antes: 900€<span class="rebaja">Ahora: 780€</span></p>
        <p class="disponibilidad">Disponible</p>
    </div>
</div>
<div class="producto-recuadro">
    <div class="producto-contenedor">
        <img src="imagenes/black-laptop-screen-dark-room-night.png" class="primera-imagen">
        <img src="imagenes/black_friday_1.png" class="segunda-imagen">
    </div>
    <div class="informacion">
        <h3>Iphone 14 pro</h3>
        <p>Antes: 900€<span class="rebaja">Ahora: 780€</span></p>
        <p class="disponibilidad">Disponible</p>
    </div>
</div>
<div class="producto-recuadro">
    <div class="producto-contenedor">
        <img src="imagenes/black-laptop-screen-dark-room-night.png" class="primera-imagen">
        <img src="imagenes/black_friday_1.png" class="segunda-imagen">
    </div>
    <div class="informacion">
        <h3>Iphone 14 pro</h3>
        <p>Antes: 900€<span class="rebaja">Ahora: 780€</span></p>
        <p class="disponibilidad">Disponible</p>
    </div>
</div>
</body>
</html>