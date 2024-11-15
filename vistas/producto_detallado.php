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
$usuario = unserialize($_SESSION ['usuario']);
$nickname = $usuario->getNickname();
// Obtener el id del producto desde la URL
if (isset($_POST['detalle'])) {
    $productoId = $_POST['detalle'];
    // Crear objeto ProductoDAO
    $productoDAO = new ProductoDAO($conexion);
    // Obtener el producto desde la base de datos
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
        .producto-detalle {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .producto-detalle img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
            color: white;
            padding: 10px 20px;
            border: none;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.2em;
        }

        .btn-agregar:hover {
            background-color: #bc764c;
        }
    </style>
</head>
<body>

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
