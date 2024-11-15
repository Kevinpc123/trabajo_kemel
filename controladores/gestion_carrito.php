<?php
session_start();
include_once '../database/conexion.php';
include_once 'carrito_controlador.php';

// Añadir un producto al carrito
if (isset($_POST['añadir_producto'])) {
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];
    añadirAlCarrito($producto_id, $cantidad);
}

// Borrar un producto del carrito
if (isset($_POST['borrar_producto'])) {
    $producto_id = $_POST['producto_id'];
    borrarProductoCarrito($producto_id);
}

// Vaciar el carrito
if (isset($_POST['vaciar_carrito'])) {
    vaciarCarrito();
}

?>