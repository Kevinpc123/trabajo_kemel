<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../recursos/css/estilo.css">
    <style>
        body {
            background-color: black;

        }

        .inicio-sesion {
            background-color: rgba(255, 255, 255, 0);
            color: white;
            box-shadow: 0 2px 50px #ff914d;
            padding: 50px 20px;
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

    </style>
</head>
<body>
<header>
    <nav>
        <img src="../recursos/imagenes/logo_2%20(1).svg" class="logo">
        <div class="menu">
            <a href="index.php">Inicio</a>
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
            <?php if (!isset($_SESSION['usuario'])): ?>
                <a href="login.php">
                    <img src="../recursos/imagenes/icons8-registro-50.png" class="icono-registro"
                         alt="Registro/Iniciar Secion">
                </a>
            <?php endif; ?>
        </div>
    </nav>
</header>
<div class="seccion-principal">
    <section class="inicio-sesion">
        <h2>Registro de Usuario</h2>
        <form action="../controladores/registrar_usuario.php" method="POST">
            <div class="formulario-sesion">
                <label>Nombre</label>
                <input type="text" name="nombre" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo letras y espacios"
                       required>
            </div>
            <div class="formulario-sesion">
                <label>Apellido</label>
                <input type="text" name="apellido" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo letras y espacios"
                       required>
            </div>
            <div class="formulario-sesion">
                <label>Nickname</label>
                <input type="text" name="nickname" pattern="[A-Za-z0-9]+" title="Solo caracteres alfanuméricos"
                       required>
            </div>
            <div class="formulario-sesion">
                <label>Contraseña</label>
                <input type="password" name="password" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}"
                       title="Mínimo 8 caracteres, incluyendo mayúsculas, minúsculas y números" required>
            </div>
            <div class="formulario-sesion">
                <label>Domicilio</label>
                <input type="text" name="domicilio">
            </div>
            <div class="formulario-sesion">
                <label>Teléfono</label>
                <input type="text" name="telefono" pattern="\d*" title="Solo números">
            </div>
            <button type="submit" name="registrar" class="btn2">Crear cuenta</button>
            <p>¿Ya tienes una cuenta? <a href="login.php">Iniciar sesión</a></p>
        </form>
    </section>
</div>
</body>
</html>
