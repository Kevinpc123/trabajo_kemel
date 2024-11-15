<?php
include_once "../modelos/ProductoDTO.php";

class ProductoDAO
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;

        if (!$this->conexion) {
            die("Error: No se pudo establecer la conexión a la base de datos.");
        }
    }

    public function obtenerProductos()
    {
        $productos = [];
        $query = "SELECT id, nombre, descripcion, precio, imagen FROM Producto";
        $stmt = $this->conexion->query($query);

        $nombresProductos = [];

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $producto = new ProductoDTO();

            if ($fila['precio'] <= 0) {
                continue;
            }

            if (in_array($fila['nombre'], $nombresProductos)) {
                continue;
            }

            $nombresProductos[] = $fila['nombre'];

            $producto->setId($fila["id"]);
            $producto->setNombre($fila['nombre']);
            $producto->setDescripcion($fila['descripcion']);
            $producto->setPrecio($fila['precio']);
            $producto->setImagen($fila['imagen']);  // CORRECCIÓN: Establecer imagen correctamente en el objeto ProductoDTO

            if ($producto->getPrecio() < 10) {
                $producto->setDescripcion($producto->getDescripcion() . " - Producto de oferta");
            } elseif ($producto->getPrecio() > 200) {
                $producto->setDescripcion($producto->getDescripcion() . " - Producto de calidad");
            }

            $productos[] = $producto;  // Añadir el objeto ProductoDTO al array de productos
        }

        return $productos;
    }


    public function agregarProducto($productoDTO)
    {
        $nombre = $productoDTO->getNombre();
        $descripcion = $productoDTO->getDescripcion();
        $precio = $productoDTO->getPrecio();
        $imagen = $productoDTO->getImagen();
        if (is_null($precio) || !is_numeric($precio) || $precio <= 0) {
            throw new Exception("El precio debe ser un número positivo.");
        }
        if (empty($nombre)) {
            throw new Exception("El nombre del producto no puede estar vacío.");
        }
        $query = "INSERT INTO Producto (nombre, descripcion, precio, imagen) VALUES (:nombre, :descripcion, :precio, :imagen)";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":descripcion", $descripcion);
        $stmt->bindParam(":precio", $precio);
        $stmt->bindParam(":imagen", $imagen);

        if ($stmt->execute()) {
            $_SESSION['mensaje'] = "Producto agregado exitosamente.";
            return true;
        } else {
            throw new Exception("Error al agregar el producto.");
        }
    }

    public function eliminarProducto($id)
    {
        $query = "DELETE FROM Producto WHERE id=:id";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            $_SESSION['mensaje'] = "El producto " . $id . " se ha eliminado exitosamente.";
            return true;
        } else {
            throw new Exception("Error al eliminar el producto.");
        }
    }

    public function obtenerProductoPorId($id)
    {
        $query = "SELECT id, nombre, descripcion, precio, cliente_id, imagen FROM Producto WHERE id = :id";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($fila) {
            return new ProductoDTO($fila['id'], $fila['nombre'], $fila['descripcion'], $fila['precio'], $fila['cliente_id'], $fila['imagen']);
        }
        return null;
    }

    public function actualizarProducto($productoDTO)
    {
        $query = "UPDATE Producto SET nombre = :nombre, descripcion = :descripcion, precio = :precio, imagen = :imagen WHERE id = :id";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(":nombre", $productoDTO->getNombre());
        $stmt->bindParam(":descripcion", $productoDTO->getDescripcion());
        $stmt->bindParam(":precio", $productoDTO->getPrecio());
        $stmt->bindParam(":id", $productoDTO->getId());
        $stmt->bindParam(":imagen", $productoDTO->getImagen());

        // return $stmt->execute();
        $id = $productoDTO->getId();

        if ($stmt->execute()){
            $_SESSION['mensaje'] = "El producto " . $id . " se ha actualizado exitosamente.";
            return true;
        }
        else{
            throw new Exception("Error al actualizar el producto.");
        }
    }


}

?>