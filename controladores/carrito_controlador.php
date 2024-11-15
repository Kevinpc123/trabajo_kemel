<?php
session_start();


// Comprobacion de si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['producto_id']) && isset($_POST['cantidad'])) {
        $producto_id = $_POST['producto_id'];
        $cantidad = $_POST['cantidad'];
        if (!empty($producto_id) && is_numeric($cantidad) && $cantidad > 0) {
            añadirAlCarrito($producto_id, $cantidad);
            header("Location: ../vistas/carrito.php");
        } else {
            echo "El producto o la cantidad no son válidos.<br>";
        }
    }
}


// Añadir al carrito
function añadirAlCarrito($producto_id, $cantidad)
{
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    $producto_en_carrito = false;
    foreach ($_SESSION['carrito'] as &$item) {
        if ($item['producto_id'] == $producto_id) {
            $item['cantidad'] += $cantidad;
            $producto_en_carrito = true;
            break;
        }
    }

    if (!$producto_en_carrito) {
        $_SESSION['carrito'][] = ['producto_id' => $producto_id, 'cantidad' => $cantidad];
    }
}

// Eliminar un producto del carrito
function borrarProductoCarrito($producto_id)
{
    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $key => $item) {
            if ($item['producto_id'] == $producto_id) {
                unset($_SESSION['carrito'][$key]);
                break;
            }
        }
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);
    }
}

// Vaciar el carrito
function vaciarCarrito()
{
    if (isset($_SESSION['carrito'])) {
        unset($_SESSION['carrito']);
    }
}

// Mostrar el carrito
function mostrarCarrito($conexion)
{
    if (isset($_GET['accion'])) {
        if ($_GET['accion'] == 'borrar' && isset($_GET['id'])) {
            borrarProductoCarrito($_GET['id']);
        } elseif ($_GET['accion'] == 'vaciar') {
            vaciarCarrito();
        }
    }
    if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
        echo "<section class='carrito'>
                <h3>Carrito de compras</h3>
                <table border='1'>
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Total</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>";

        foreach ($_SESSION['carrito'] as $item) {
            $producto_id = $item['producto_id'];
            $cantidad = $item['cantidad'];

            $stmt = $conexion->prepare("SELECT nombre, precio FROM Producto WHERE id = ?");
            $stmt->execute([$producto_id]);
            $producto = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($producto) {
                $nombre = $producto['nombre'];
                $precio = $producto['precio'];
                $total = $precio * $cantidad;

                echo "<tr>
                        <td>$nombre</td>
                        <td>$cantidad</td>
                        <td>" . number_format($precio, 2) . " €</td>
                        <td>" . number_format($total, 2) . " €</td>
                        <td>
                            <a href='?accion=borrar&id=$producto_id'>Eliminar</a>
                        </td>
                      </tr>";
            }
        }

        echo "</tbody>
              </table>";

        echo "<br><a href='?accion=vaciar'>Vaciar carrito</a>";
        echo "</section>";
    } else {
        echo "<section class='carrito'>
                <p>Tu carrito está vacío.</p>
              </section>";
    }
}

?>
<style>
    .carrito {
        max-width: 900px;
        margin: 0 auto;
        padding: 20px;
        font-family: Arial, sans-serif;
    }

    .carrito table {
        width: 100%;
        border-collapse: collapse;
    }

    .carrito table th,
    .carrito table td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }

    .carrito table th {
        background-color: #f4f4f4;
    }

    .carrito a {
        color: #ff0000;
        text-decoration: none;
    }

    .carrito a:hover {
        text-decoration: underline;
    }

    .carrito p {
        font-size: 16px;
        color: #333;
    }
</style>