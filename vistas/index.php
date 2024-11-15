<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once '../database/conexion.php';
require_once '../modelos/ProductoDAO.php';
require_once '../modelos/ProductoDTO.php';
$productoDAO = new productoDAO($conexion);
$productos = $productoDAO->obtenerProductos();


if (isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>
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

        .seccion-productos {
            padding: 100px;
            text-align: center;
        }

        .seccion-productos h2 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #ff914d;
        }

        .producto-recuadro {
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

        .producto-recuadro:hover {
            transform: scale(1.05);
        }

        .producto-recuadro .producto-contenedor {
            position: relative;
            width: 100%;
            height: 200px;
        }

        .producto-recuadro img.primera-imagen {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .informacion {
            padding: 15px;
            text-align: left;
        }

        .informacion h3 {
            font-size: 1.5em;
            margin: 0;
        }

        .informacion p {
            margin: 5px 0;
            color: black;
        }

        .informacion .rebaja {
            font-weight: bold;
            color: black;
        }

        .disponibilidad {
            font-weight: bold;
            color: #28a745;
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

        .btn-agregar{
            color: #fff;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn-agregar {
            background-color: #ff914d;
            margin-bottom: 10px;
            display: inline-block;
            outline: none;
            border: none;
        }

        .btn-agregar:hover {
            background-color: #bc764c;
        }

        .cantidad {
            width: 50px;
            height: 30px;
            padding: 5px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
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
            if (!isset($_SESSION['usuario'])):?>
                <a href="login.php">
                    <img src="../recursos/imagenes/icons8-registro-50.png" class="icono-registro"
                         alt="Registro/Iniciar Secion">
                </a>
            <?php endif;
            ?>
            <?php
            if (!isset($_SESSION['usuario'])):?>
                <a href="login.php">
                    <img src="../recursos/imagenes/icons8-agregar-a-carrito-de-compras-50.png" class="icono-registro"
                         alt="Registro/Iniciar Secion">
                </a>
                <a></a>
            <?php endif;
            ?>
            <?php
            if (!isset($_SESSION['usuario'])):?>
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
<!--PRODUCTOS-->
<div class="seccion-productos">
    <h2>Productos</h2>
    <--!repeticon de cada producto-->
    <?php foreach ($productos as $producto): ?>
        <div class="producto-recuadro">
            <div class="producto-contenedor">
                <!-- comprobamos y visualizamos la imagen del producto-->
                <?php
                $imagen = $producto->getImagen();
                if ($imagen) {
                    $rutaImagen = "../" . $imagen;//ruta de la imagen
                } else {
                    $rutaImagen = "../recursos/imagenes/no_imagen_disponible.jpg";//sino exite ninguna imagen mostramos una al azar
                }
                ?>
                <img src="<?php echo $rutaImagen; ?>" class="primera-imagen" alt="Imagen del producto">
            </div>
            <div class="informacion">
                <!-- Nombre del producto -->
                <h3><a>  <?php echo htmlspecialchars($producto->getNombre() ?? 'Sin nombre'); ?></a></h3>
                <p>Antes: <?php echo number_format($producto->getPrecio() ?? 0, 2); ?>€
                    <span class="rebaja">Ahora: <?php echo number_format(($producto->getPrecio() ?? 0) * 0.9, 2); ?>€</span>
                </p>
                <p><?php echo htmlspecialchars($producto->getDescripcion() ?? 'Sin descripción'); ?></p>
                <!-- Disponibilidad -->
                <p class="disponibilidad">Disponible</p>
                <form method="POST" action="../controladores/carrito_controlador.php">
                    <input type="hidden" name="producto_id" value="<?php echo htmlspecialchars($producto->getId()); ?>">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" name="cantidad" value="1" min="1" class="cantidad">
                    <button type="submit" class="btn-agregar">Añadir al carrito</button>
                </form>
                <form action="producto_detallado.php" method="post">
                    <input type="hidden" name="detalle" value="<?php echo $producto->getId(); ?>">
                    <button type="submit" class="btn-agregar">Ver Producto</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
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
            <p>Correo: proyectoTienda@gmail.com</p>
            <p>telefono: 999 033 030</p>
        </div>
    </div>
</footer>
</body>
</html>