<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion de Trastienda</title>
    <link rel="stylesheet" href="../recursos/css/estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    require_once '../database/conexion.php';
    require_once '../modelos/ProductoDAO.php';
    require_once '../modelos/ProductoDTO.php';
    require_once '../modelos/UsuarioDTO.php';

    // Verificación de sesión
    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php");
        exit;
    }

    $usuario = unserialize($_SESSION['usuario']);
    $nickname = $usuario->getNickname();
    $productoDAO = new ProductoDAO($conexion);
    $productos = $productoDAO->obtenerProductos();

    // Lógica de edición de productos
    $productoEditar = null;
    if (isset($_GET['editar'])) {
        $id = $_GET['editar'];
        $productoEditar = $productoDAO->obtenerProductoPorId($id);
    }


    $mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : "";
    unset($_SESSION['mensaje']);
    ?>
    <style>
        /* Estilos generales */
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: #000000;
            z-index: 100;
            height: 80px; /* Ajusta este valor según el tamaño de tu header */
        }

        /* Contenido de la página */
        .productos-inventario {
            padding: 80px;
            text-align: center;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            display: block;
        }

        .productos-inventario h1 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #ff914d;
        }

        .productos-inventario table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .productos-inventario th, .productos-inventario td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .productos-inventario th {
            background-color: #f4f4f4;
            color: #333;
        }

        /* Estilos de botones */
        .btn-editar, .btn-eliminar {
            color: #fff;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
        }



        .btn-editar {
            background-color: #ff914d;
            color: white;
            margin-right: 5px;
            outline: none;
            border: none;
        }

        .btn-editar:hover {
            background-color: #bc764c;
        }

        .btn-eliminar {
            background-color: #ff914d;
            color: white;
            outline: none;
            border: none;
        }

        .btn-eliminar:hover {
            background-color: #bc764c;
        }

        body {
            padding-top: 100px;
        }

        .mensaje {
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
            <a href="InicioConUsuario.php">Inicio</a>
            <div class="desplegable">
                <a href="#">Categorías</a>
                <div class="desplegable-contenido">
                    <a href="#">Mobiles</a>
                    <a href="#">Ordenadores</a>
                    <a href="#">Camaras</a>
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
                    <a href="#">Configuración de cuenta</a>
                    <a href="trastienda.php">Gestión de trastienda</a>
                    <a href="../controladores/cerrarsesion.php">Cerrar sesión</a>
                </div>
            </div>
            <?php
            if (!isset($_SESSION['usuario'])): ?>
                <a href="login.php">
                    <img src="../recursos/imagenes/icons8-registro-50.png" class="icono-registro"
                         alt="Registro/Iniciar Seción">
                </a>
            <?php endif; ?>
        </div>
    </nav>
</header>
<section class="productos-inventario">
    <h1>Productos en Inventario</h1>
    <!-- Formulario para agregar producto -->
    <form action="../controladores/gestion_trastienda.php" method="POST" enctype="multipart/form-data">
        <h1>Agregar Producto</h1>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required>
        <label for="descripcion">Descripción</label>
        <input type="text" name="descripcion" required>
        <label for="precio">Precio</label>
        <input type="number" name="precio" required><br><br>
        <!--subir imagen -->
        <label for="imagen">Imagen del Producto</label>
        <input type="file" name="imagen" accept="image/*" required>
        <button type="submit" name="agregar" class="btn-eliminar">Agregar Producto</button>
    </form>

    <!-- Formulario para edicion -->
    <?php if ($productoEditar): ?>
        <h1>Editar Producto</h1>
        <form action="../controladores/gestion_trastienda.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($productoEditar->getId()); ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($productoEditar->getNombre()); ?>"
                   required>
            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion"
                   value="<?php echo htmlspecialchars($productoEditar->getDescripcion()); ?>" required>
            <label for="precio">Precio:</label>
            <input type="number" step="0.01" name="precio"
                   value="<?php echo htmlspecialchars($productoEditar->getPrecio()); ?>" required>
            <input type="file" name="imagen" accept="image/*" required>
            <br>
            <br>
            <button type="submit" name="actualizar" class="btn-eliminar">Actualizar Producto</button>
            <a href="trastienda.php" class="btn-eliminar">Cancelar</a>
        </form>
    <?php endif; ?>


    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?php echo htmlspecialchars($producto->getNombre()); ?></td>
                <td><?php echo htmlspecialchars($producto->getDescripcion()); ?></td>
                <td><?php echo htmlspecialchars($producto->getPrecio()); ?></td>
                <td>
                    <!-- Botón de Editar -->
                    <form action="../controladores/gestion_trastienda.php" method="post" style="display:inline;">
                        <input type="hidden" name="editar" value="<?php echo $producto->getId(); ?>">
                        <button type="submit" class="btn-editar">Editar</button>
                    </form>
                    <!-- Botón de Eliminar -->
                    <form action="../controladores/gestion_trastienda.php" method="post" style="display:inline;">
                        <input type="hidden" name="eliminar" value="<?php echo $producto->getId(); ?>">
                        <button type="submit" class="btn-eliminar">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>
    <?php if ($mensaje): ?>
        <p class="mensaje"><?php echo $mensaje; ?></p>
    <?php endif; ?>
</section>
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
