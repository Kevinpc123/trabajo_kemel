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
    session_start();

    if (isset($_SESSION['usuario'])) {
        header("Location: login.php");
        exit;
    }

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
        }

        /* Recuadro de búsqueda (oculto inicialmente) */
        #buscador-contenedor {
            display: none;
            margin-top: 10px;
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
            <?php
            if(!isset($_SESSION['usuario'])):?>
                <a href="login.php">
                    <img src="imagenes/icons8-registro-50.png" class="icono-registro" alt="Registro/Iniciar Secion">
                </a>
            <?php endif;
            ?>
            <?php
            if(!isset($_SESSION['usuario'])):?>
                <a href="#">
                    <img src="imagenes/icons8-agregar-a-carrito-de-compras-50.png" class="icono-registro" alt="Registro/Iniciar Secion">
                </a>
            <?php endif;
            ?>
            <a></a>
            <?php
            if(!isset($_SESSION['usuario'])):?>
                <label for="buscador-toggle">
                    <img src="imagenes/icons8-google-web-search-50.png" class="icono-registro" alt="Buscador">
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
    <img src="imagenes/black_friday_2.png" alt="Fondo" class="imagen-fondo">
    <div class="texto">
        <a href="#" class="boton-reserva">Ver ahora</a>
    </div>
</div>
</body>
</html>