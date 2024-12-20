<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
// Incluir las clases necesarias
require_once '../database/conexion.php';
require_once '../modelos/ProductoDAO.php';
require_once '../modelos/ProductoDTO.php';
require_once '../modelos/UsuarioDTO.php';
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$usuario = unserialize($_SESSION['usuario']);
$nickname = $usuario->getNickname();

if (isset($_POST['detalle'])) {
    $productoId = $_POST['detalle'];
    $productoDAO = new ProductoDAO($conexion);
    $producto = $productoDAO->obtenerProductoPorId($productoId);


    $imagen = $producto->getImagen();

    if ($imagen) {
        $rutaImagen = "../" . $imagen;
    } else {
        $rutaImagen = "../recursos/imagenes/imagen_no_disponible.jpg";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Producto</title>
    <link rel="stylesheet" href="../recursos/css/estilo.css">
    <style>
        body{
            background-color: black;
            color: white;
        }
        .producto-detalle {
            padding: 110px;
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .producto-detalle img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 5px 5px 5px 10px #ff914d;
        }

        .producto-detalle h1 {
            font-size: 2em;
            margin-top: 20px;
        }

        .producto-detalle p {
            font-size: 1.2em;
            margin: 15px 0;
        }

        .precio {
            font-size: 1.5em;
            color: #ff914d;
            font-weight: bold;
        }

        .btn-agregar {
            background-color: #ff914d;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.2em;
        }

        .btn-agregar:hover {
            background-color: #bc764c;
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
            <!-- Icono carrito -->
            <?php
            if (isset($_SESSION['usuario'])):?>
                <a href="carrito.php">
                    <img src="../recursos/imagenes/icons8-agregar-a-carrito-de-compras-50.png" class="icono-registro"
                         alt="Carrito">
                </a>
                <a></a>
            <?php endif;
            ?>
            <!-- Icono buscador-->
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
<div class="producto-detalle">
    <h1><?php echo htmlspecialchars($producto->getNombre()); ?></h1>

    <!-- Imagen del producto -->
    <img src="<?php echo $rutaImagen; ?>" alt="Imagen del producto">

    <!-- Descripción del producto -->
    <p><strong>Descripción:</strong> <?php echo nl2br(htmlspecialchars($producto->getDescripcion())); ?></p>

    <!-- Precio del producto -->
    <p class="precio">Precio: €<?php echo number_format($producto->getPrecio(), 2); ?></p>

    <!-- Botón para añadir al carrito -->
    <form method="POST" action="../controladores/carrito_controlador.php">
        <input type="hidden" name="producto_id" value="<?php echo htmlspecialchars($producto->getId()); ?>">
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" value="1" min="1" class="cantidad">
        <button type="submit" class="btn-agregar">Añadir al carrito</button>
    </form>
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
