<?php
$host = "mysql:host=127.0.0.1;dbname=mi_tienda";
$usuarioDB = "alumno";
$contrasenaDB = "alumno";

try {
    $conexion = new PDO($host, $usuarioDB, $contrasenaDB);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit;
}
?>