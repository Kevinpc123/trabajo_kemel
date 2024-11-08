<?php
// para cerrar sesion
session_start();
session_destroy();
header("location: InicioConUsuario.php");
exit();
?>