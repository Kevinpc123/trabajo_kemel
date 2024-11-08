<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Virtual Tech Company Inicio</title>
    <link rel="stylesheet" href="../recursos/css/estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?php
    require_once 'usuarioDTO.php';
    session_start();

    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php");
        exit;
    }

    $nombreCompleto = $_SESSION['usuario']->getNombreCompleto();
    ?>
    <style>
        html, body {
            overflow-x: hidden;
            margin: 0;
            padding: 0;
            width: 100%;
        }

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
            overflow: hidden;
            background-color: #fff;
            box-shadow: 6px 8px 10px #ff914d;
            transition: transform 0.3s;
            position: relative;
        }
        .producto-recuadro:hover{
            transform: scale(1.05);
        }
        .producto-recuadro .producto-contenedor{
            position: relative;
            width: 100%;
            height: 200px;
        }
        .producto-recuadro img.primera-imagen{
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.3s ease;
        }
        .producto-recuadro img.segunda-imagen{
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .producto-recuadro:hover .primera-imagen{
            opacity: 0;
        }
        .producto-recuadro:hover .segunda-imagen{
            opacity: 1;
        }
        .informacion{
            padding: 15px;
            text-align: left;
        }
        .informacion h3{
            font-size: 1.5em;
            margin: 0;
        }
        .informacion p{
            margin: 5px 0;
            color: black;
        }
        .informacion .rebaja{
            font-weight: bold;
            color: black;
        }
        .disponibilidad{
            font-weight: bold;
            color: #28a745;
        }

        /* Recuadro de búsqueda (oculto inicialmente) */
        #buscador-contenedor {
            display: none;
            position: absolute; /* Colocar el recuadro fuera del flujo normal */
            top: 50%;  /* Centrado verticalmente respecto al contenedor */
            right: -275px; /* Coloca el recuadro a la derecha con un pequeño margen */
            transform: translateY(-50%); /* Ajustar para que se alinee verticalmente */
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

        /* Mostrar el recuadro de búsqueda cuando el checkbox está marcado */
        #buscador-toggle:checked + #buscador-contenedor {
            display: block;
        }

    </style>
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
                    <img src="../recursos/imagenes/icons8-registro-50.png" class="icono-registro" alt="Registro/Iniciar Secion">
                </a>
            <?php endif;
            ?>
            <a></a>
            <!-- Icono de búsqueda con un checkbox para controlar la visibilidad del recuadro -->
            <?php
            if(isset($_SESSION['usuario'])):?>
                <label for="buscador-toggle">
                    <img src="../recursos/imagenes/icons8-google-web-search-50.png" class="icono-registro" alt="Buscador">
                </label>
                <!-- Checkbox que alterna la visibilidad del recuadro de búsqueda -->
                <input type="checkbox" id="buscador-toggle" style="display: none;">
                <!-- Recuadro de búsqueda -->
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
<!--CATALOGO DE PRODUCTOS-->
<div class="seccion-productos">
    <h2>Productos</h2>
    <div class="producto-recuadro">
        <div class="producto-contenedor">
            <img src="../recursos/imagenes/black-laptop-screen-dark-room-night.png" class="primera-imagen">
            <img src="../recursos/imagenes/black_friday_1.png" class="segunda-imagen">
        </div>
        <div class="informacion">
            <h3>Iphone 14 pro</h3>
            <p>Antes: 900€<span class="rebaja">Ahora: 780€</span></p>
            <p class="disponibilidad">Disponible</p>
        </div>
    </div>
<div class="producto-recuadro">
    <div class="producto-contenedor">
        <img src="../recursos/imagenes/black-laptop-screen-dark-room-night.png" class="primera-imagen">
        <img src="../recursos/imagenes/black_friday_1.png" class="segunda-imagen">
    </div>
    <div class="informacion">
        <h3>Iphone 14 pro</h3>
        <p>Antes: 900€<span class="rebaja">Ahora: 780€</span></p>
        <p class="disponibilidad">Disponible</p>
    </div>
</div>
<div class="producto-recuadro">
    <div class="producto-contenedor">
        <img src="../recursos/imagenes/black-laptop-screen-dark-room-night.png" class="primera-imagen">
        <img src="../recursos/imagenes/black_friday_1.png" class="segunda-imagen">
    </div>
    <div class="informacion">
        <h3>Iphone 14 pro</h3>
        <p>Antes: 900€<span class="rebaja">Ahora: 780€</span></p>
        <p class="disponibilidad">Disponible</p>
    </div>
</div>
<div class="producto-recuadro">
    <div class="producto-contenedor">
        <img src="../recursos/imagenes/black-laptop-screen-dark-room-night.png" class="primera-imagen">
        <img src="../recursos/imagenes/black_friday_1.png" class="segunda-imagen">
    </div>
    <div class="informacion">
        <h3>Iphone 14 pro</h3>
        <p>Antes: 900€<span class="rebaja"> Ahora: 780€</span></p>
        <p class="disponibilidad">Disponible</p>
    </div>
</div>
</div>
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
            <p>correo: pepito@gmial.com</p>
            <p>telefono: 999 033 030</p>
        </div>
    </div>
</footer>
</body>
</html>
