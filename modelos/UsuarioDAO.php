<?php
require_once 'UsuarioDTO.php';

class UsuarioDAO
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;

        if (!$this->conexion) {
            die("Error: No se pudo establecer la conexión a la base de datos.");
        }
    }

    public function crearUsuario($nickname, $password, $nombre, $apellido, $telefono, $domicilio)
    {
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
            return true;
        } catch (PDOException $e) {
            echo "Error al registrar usuario: " . $e->getMessage();
            return false;
        }
    }


    public function obtenerUsuarioPorCredenciales($nickname, $password)
    {
        // Seleccionar al usuario por su nombre de usuario
        $sql = "SELECT * FROM usuario WHERE nickname = :nickname LIMIT 1";
        $stmt = $this->conexion->prepare($sql);
        try {
            $stmt->execute(['nickname' => $nickname]);
            if ($stmt->rowCount() > 0) {
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
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

}

?>
