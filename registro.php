<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
    <link rel="stylesheet" href="estilo.css">
    <style>
        .inicio-sesion{
            background-color: rgba(255, 255, 255, 0);
            color: white;
            box-shadow: 0 2px 50px #7044DA;
            padding: 50px 20px;
            border-radius: 8px;
            max-width: 800px;
            margin: 20px auto;
            text-align: center;
        }
        .inicio-sesion h2{
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #7044DA;
        }
        .formulario-sesion{
            margin-bottom: 15px;
            text-align: left;
        }
        .formulario-sesion label{
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .formulario-sesion input,
        .formulario-sesion textarea{
            width: 100%;
            padding: 10px;
            border: 1px solid #7044DA;
            border-radius: 4px;
            font-size: 1em;
        }
        .formulario-sesion textarea{
            resize: vertical;
        }
        button{
            background-color: #7044DA;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1.1em;
        }
        button:hover{
            background-color: #0057b300;
        }
    </style>
    <?php
    $servidor = "localhost";
    $usuario = "root";
    $password = "";
    $base_datos = "crud_empleados";
    $conexion = mysqli_connect($servidor, $usuario, $password, $base_datos);
     if (mysqli_connect_error()) {
         die("Fallo al conectar a MySQL: " . $conexion->connect_error) ;
     }
     //REGISTRO DEL USUARIO
    if(isset($_POST['registro'])){
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $domicilio = $_POST['domicilio'];
        $telefono = $_POST['telefono'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $nickname = $_POST['nickname'];

        $sql="INSERT INTO usuarios (nombre, apellido, domicilio, telefono, nickname, password) VALUES ('$nombre', '$apellido', '$domicilio', '$telefono', '$nickname', '$password ')";
        if($conexion->query($sql) === TRUE){
            header('Location: login.php');
            exit();
        }else{
            echo "Error: " . $sql . "<br>" . $conexion->error;
        }
    }
    ?>
    ?>
</head>
<body>
<header>
    <nav>
        <img src="imagenes/Diseño%20sin%20título-4.png" class="logo">
        <div class="menu">
            <a href="Inicio.php">Inicio</a>
            <div class="desplegable">
                <a href="#">Coches</a>
                <div class="desplegable-contenido">
                    <a href="#">Premium</a>
                    <a href="#">Standar</a>
                    <a href="#">Basic</a>
                </div>
            </div>
            <a href="#">Alquilar</a>
            <div class="desplegable">
                <a href="#">Acerca de</a>
                <div class="desplegable-contenido">
                    <a href="#">Nosotros</a>
                    <a href="#">Servicios</a>
                </div>
            </div>
            <?php
            if(!isset($_SESSION['usuario'])):?>
                <a href="login.php">
                    <img src="imagenes/icons8-registro-50.png" class="icono-registro" alt="Registro/Iniciar Secion">
                </a>
            <?php endif;
            ?>
            <?php
            if(!isset($_SESSION['usuario'])):?>
                <a href="registro.php">
                    <img src="imagenes/icons8-agregar-a-carrito-de-compras-50.png" class="icono-registro" alt="Registro/Iniciar Secion">
                </a>
            <?php endif;
            ?>
            <?php
            if(!isset($_SESSION['usuario'])):?>
                <a href="registro.php">
                    <img src="imagenes/icons8-google-web-search-50.png" class="icono-registro" alt="Registro/Iniciar Secion">
                </a>
            <?php endif;
            ?>
        </div>
    </nav>
</header>
<div class="seccion-principal">
    <img src="imagenes/bg.jpg" alt="Fondo" class="imagen-fondo">
    <section class="inicio-sesion">
        <h2>Registro de Usuario</h2>
        <form method="POST" action=""><!--en action ponemos el sitio donde se envia-->
            <div class="formulario-sesion">
                <label>Nombre</label>
                <input type="text" name="nombre" required>
            </div>
            <div class="formulario-sesion">
                <label>Apellido</label>
                <input type="text" name="apellido" required>
            </div>
            <div class="formulario-sesion">
                <label>Domicilio</label>
                <input type="text" name="domicilio" required>
            </div>
            <div class="formulario-sesion">
                <label>Telefono</label>
                <input type="text" name="telefono" required>
            </div>
            <div class="formulario-sesion">
                <label>Contraseña</label>
                <input type="password" name="password" required>
            </div>
            <div class="formulario-sesion">
                <label>Nickname</label>
                <input type="text" name="nickname" required>
            </div>
            <button type="submit" name="iniciar_sesion">Registrar</button>
        </form>
        <a href="registro.php">Iniciar Sesión</a>
    </section>
</div>
</body>
</html>