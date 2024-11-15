<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

include_once '../database/conexion.php';
include_once '../modelos/ProductoDTO.php';
include_once '../modelos/ProductoDAO.php';

$productoDAO = new ProductoDAO($conexion);

// Comprobación de solicitud de eliminación
if (isset($_POST['eliminar'])) {
    $id = $_POST['eliminar'];
    try {
        $productoDAO->eliminarProducto($id);
        header("Location: ../vistas/trastienda.php");
        exit;
    } catch (Exception $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
}

// Comprobación de solicitud de agregar
if (isset($_POST['agregar'])) {
    if (isset($_POST['nombre'], $_POST['descripcion'], $_POST['precio']) &&
        !empty($_POST['nombre']) && !empty($_POST['descripcion']) && !empty($_POST['precio'])) {

        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];

        // Verificar si se subió una imagen
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
            $nombreImagen = basename($_FILES['imagen']['name']);
            $rutaRelativa = "recursos/imagenes/" . $nombreImagen;
            $rutaDestino = "../" . $rutaRelativa; // Ruta absoluta para mover el archivo

            if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
                echo "<p>Error al subir la imagen.</p>";
                exit;
            }
        } else {
            $rutaRelativa = null; // Si no se sube imagen, será null
        }


        // Validación de precio
        if (!is_numeric($precio) || $precio <= 0) {
            echo "<p>El precio debe ser un número positivo.</p>";
        } else {
            // Crear el objeto ProductoDTO con los datos
            $producto = new ProductoDTO(null, $nombre, $descripcion, $precio, null, $rutaRelativa);
            $productoDAO->agregarProducto($producto);
            header("Location: ../vistas/trastienda.php");
            exit;
        }
    } else {
        echo "<p>Por favor, complete todos los campos.</p>";
    }
}

$productoEditar = null;

if (isset($_POST['editar'])) {
    $id = $_POST['editar'];
    try {
        header("Location: ../vistas/trastienda.php?editar=" . $id);
        exit;
    } catch (Exception $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
}

// Actualización de producto
if (isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $imagen = $_POST['imagen'];

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $rutaImagen = '../recursos/imagenes/' . basename($_FILES['imagen']['name']);
        move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen);
        $imagenNueva = 'recursos/imagenes/' . basename($_FILES['imagen']['name']);
    }

    $productoDTO = new ProductoDTO($id, $nombre, $descripcion, $precio, null, $imagenNueva);
    try {
        $productoDAO->actualizarProducto($productoDTO);
        header("Location: ../vistas/trastienda.php");  // Redirigir después de la actualización
    } catch (Exception $e) {
        $_SESSION['mensaje'] = $e->getMessage();
        header("Location: ../vistas/trastienda.php");  // Redirigir si hay error
    }
}


// Mostrar todos los productos
$productos = $productoDAO->obtenerProductos();
?>
