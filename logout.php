<?php
// para cerrar sesion
session_start();
session_destroy();
header("location: login.php");
exit();
?>