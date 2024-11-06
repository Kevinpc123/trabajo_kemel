<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="estilo.css">
    <style>
        body {
            background-color: black;
        }
        .inicio-sesion {
            background-color: rgba(255, 255, 255, 0);
            color: white;
            box-shadow: 0 2px 50px #ff914d;
            padding: 50px 50px;
            border-radius: 8px;
            max-width: 800px;
            margin: 20px auto;
            text-align: center;
        }
        .inicio-sesion h2 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #ff914d;
        }
        .formulario-sesion {
            margin-bottom: 15px;
            text-align: left;
        }
        .formulario-sesion label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .formulario-sesion input,
        .formulario-sesion textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ff914d;
            border-radius: 4px;
            font-size: 1em;
        }
        .formulario-sesion textarea {
            resize: vertical;
        }
        button {
            background-color: #ff914d;
            color: white;
            border: none;
            padding: 6px 70px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1.1em;
        }
        button:hover {
            background-color: #0057b300;
        }
        .enlace {
            display: block;
            margin: 10px 0;
            color: white;
            text-decoration: none;
        }
        .enlace:hover {
            text-decoration: underline;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
    <?php
    session_start();
    require_once 'conexion.php';
    require_once 'usuario.php';

    $error = ""; // Variable para almacenar el mensaje de error

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuario = $_POST['usuario'];
        $contraseña = $_POST['contraseña'];

        $stmt = $dwes->prepare("SELECT * FROM Cliente WHERE nickname = :usuario AND password = :password");
        $stmt->execute(['usuario' => $usuario, 'password' => $contraseña]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            $nuevoUsuario = new Usuario($usuario, $contraseña, $resultado['nombre'], $resultado['apellido']);
            $_SESSION['usuario'] = $nuevoUsuario;
            header("Location: Inicio.php");
            exit;
        } else {
            $error = "Usuario o contraseña incorrectos."; // Asignar mensaje de error
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
    <section class="inicio-sesion">
        <h2>Iniciar sesión</h2>
        <form method="POST" action="">
            <div class="formulario-sesion">
                <label for="usuario">Nombre de usuario</label>
                <input type="text" name="usuario" required>
            </div>
            <div class="formulario-sesion">
                <label for="contraseña">Contraseña</label>
                <input type="password" name="contraseña" required>
            </div>
            <a href="#" class="enlace">¿He olvidado mi contraseña?</a>
            <button type="submit" name="iniciar_sesion" class="btn2">Iniciar sesión</button>
            <p class="enlace">¿Eres nuevo cliente?</p>
            <button type="button" class="btn2"><a href="registro.php" class="enlace">Crear cuenta</a></button>
        </form>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
    </section>
</div>
</body>
</html>