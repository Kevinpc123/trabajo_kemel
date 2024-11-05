<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar sesion</title>
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
        session_start();
        $servidor = "localhost";
        $usuario = "root";
        $password = "";
        $base_de_datos = "crud_empleados";
        $conexion = mysqli_connect($servidor, $usuario, $password, $base_de_datos);
    //CODIGO PARA LA VERIFICACION DE LA CONEXION
    if (mysqli_connect_error()) {/**esto nos devuelve error de conexion**/
        die("Fallo la conexion: " . $conexion->connect_error);/**usamos 'die' para detener la ejecucion del script y mostramos el mensaje de error**/
    }
    //REALIZAMOS EL INICIO DE SESION SI NOS CONECTAMOS
    if(isset($_POST['iniciar_sesion'])){
        /**Guardamos los valores que se introducen en el formulario de inicio de sesion en variables**/
        $nickname = $_POST['nickname'];
        $password = $_POST['password'];
    //CREAMOS UNA CONSULTA SQL PARA VER SI EXISTE EL USUARIO CON EL NICKNAME QUE SE NOS DA
        $sql = "SELECT * FROM usuarios WHERE nickname='$nickname'";
        /**Este codigo ejecuta la consulta en la base de datos**/
        $resultado = $conexion->query($sql) ;

        if($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
            if(password_verify($password, $usuario['password'])){
                //Guardamos los datos introducidos por el usuario en la sesion
                $_SESSION['usuario'] = $usuario['nickname'];
                $_SESSION['nombre'] = $usuario['nombre'];
                $_SESSION['apellido'] = $usuario['apellido'];
                header("Location: index.php");
                exit();
            }else{
                echo "Contraseña incorrecta.";
            }
        }else{
            echo "No existe el usuario.";
        }
    }
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
        <h2>Iniciar sesion</h2>
        <form method="POST" action=""><!--en action ponemos el sitio donde se envia-->
            <div class="formulario-sesion">
                <label>Nombre de usuario</label>
                <input type="text" name="nickname" required>
            </div>
            <div class="formulario-sesion">
                <label>Contraseña</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" name="iniciar_sesion">Iniciar sesion</button>
        </form>
        <a href="registro.php">Registrar nuevo usuario</a>
    </section>
</div>
</body>
</html>
