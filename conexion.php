<?php
$host = "mysql:host=127.0.0.1;dbname=mi_tienda";
$usuarioDB = "alumno";
$contrasenaDB = "alumno";

try {
    $dwes = new PDO($host, $usuarioDB, $contrasenaDB);
    $dwes->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit;
}
?>