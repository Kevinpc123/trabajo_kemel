<?php
require_once 'UsuarioDTO.php';

class UsuarioDAO
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;

        // Comprobar que la conexión es válida
        if (!$this->conexion) {
            die("Error: No se pudo establecer la conexión a la base de datos.");
        }
    }

// UsuarioDAO.php
    public function crearUsuario($nickname, $password, $nombre, $apellido, $telefono, $domicilio) {
        $sql = "INSERT INTO usuario (nickname, password, nombre, apellido, telefono, domicilio) 
        VALUES (:nickname, :password, :nombre, :apellido, :telefono, :domicilio)";
        $stmt = $this->conexion->prepare($sql);

        try {
            $stmt->execute([
                'nickname' => $nickname,
                'password' => $password,
                'nombre' => $nombre,
                'apellido' => $apellido,
                'telefono' => $telefono,
                'domicilio' => $domicilio
            ]);
            return true; // Devuelve true si la inserción fue exitosa
        } catch (PDOException $e) {
            echo "Error al registrar usuario: " . $e->getMessage(); // Mostrar mensaje de error
            return false; // Devuelve false si ocurrió un error
        }
    }


    // Método para obtener un usuario por su nombre de usuario y contraseña
    public function obtenerUsuarioPorCredenciales($nickname, $password) {
        // SQL para seleccionar al usuario por su nickname
        $sql = "SELECT * FROM usuario WHERE nickname = :nickname LIMIT 1";
        $stmt = $this->conexion->prepare($sql);

        try {
            // Ejecutar la consulta
            $stmt->execute(['nickname' => $nickname]);

            // Verificamos si encontramos el usuario
            if ($stmt->rowCount() > 0) {
                // Obtenemos el resultado
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

                // Comparar la contraseña directamente
                if ($usuario['password'] == $password) {
                    return $usuario;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error al obtener usuario: " . $e->getMessage();
            return false;
        }
    }

    // Método para actualizar los datos de un usuario existente
    public function actualizarUsuario(UsuarioDTO $usuario)
    {
        try {
            $sql = "UPDATE usuario SET 
                        password = :password, 
                        nombre = :nombre, 
                        apellido = :apellido,
                        telefono = :telefono,
                        domicilio = :domicilio 
                    WHERE nickname = :nickname";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':nickname', $usuario->getNickname());
            $stmt->bindParam(':password', $usuario->getPassword());
            $stmt->bindParam(':nombre', $usuario->getNombre());
            $stmt->bindParam(':apellido', $usuario->getApellido());
            $stmt->bindParam(':telefono', $usuario->getTelefono());
            $stmt->bindParam(':domicilio', $usuario->getDomicilio());
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error al actualizar usuario: " . $e->getMessage();
            return false;
        }
    }

    // Método para eliminar un usuario
    public function eliminarUsuario($nombreUsuario)
    {
        try {
            $sql = "DELETE FROM usuario WHERE usuario = :usuario";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':usuario', $nombreUsuario);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error al eliminar usuario: " . $e->getMessage();
            return false;
        }
    }
}
?>
