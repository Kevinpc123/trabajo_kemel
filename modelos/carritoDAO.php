<?php
include '../modelos/carritoDTO.php';
class CarritoDAO{
    public function obtenerCarrito(){
    if(isset($_SESSION["carrito"])){
        $_SESSION["carrito"]=new CarritoDTO();
    }
    return $_SESSION["carrito"];
}
public function guardarProducto($carrito){
    $_SESSION["carrito"]=$carrito;
    }
}
?>