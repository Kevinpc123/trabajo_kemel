<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LuxuryCars Inicio</title>
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?php
    session_start();
    if(isset($_SESSION["usuario"])){
        header("location: login.php");
        exit();
    }
    ?>
    ?>
</head>
<body>
    <header>
        <nav>
            <img src="imagenes/logo_2%20(1).svg" class="logo">
            <div class="menu">
                <a href="Inicio.php">Inicio</a>
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
<h4>hoal perra</h4>
</body>
</html>