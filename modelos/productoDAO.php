<?php
include_once "../database/conexion.php";
include_once "../modelos/productoDTO.php";
class ProductoDAO{
  private $conexion;
  public function __construct(){
      $this->conexion=(new SQLiteDatabase())->getConnection();
}
public function obtenerTodos(){
  $query = "SELECT * FROM producto";
  $stmt=$this->conexion->prepare($query);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_CLASS ,"ProductoDTO");
  }
  public function agregarProducto($productoDTO){
      $query="INSERT INTO producto(id,nombre,descripcion,precio,cliente_id)VALUES(:id,:nombre,:descripcion,:precio,:cliente_id) ";
      $stmt=$this->conexion->prepare($query);

      $stmt->bindParam(":id",$productoDTO->getId());
      $stmt->bindParam(":nombre",$productoDTO->getNombre());
      $stmt->bindParam(":descripcion",$productoDTO->getDescripcion());
      $stmt->bindParam(":precio",$productoDTO->getPrecio());
      $stmt->bindParam(":cliente_id",$productoDTO->getClienteId());

      return $stmt->execute();
  }
  public function eliminarProducto($id){
      $query="DELETE FROM producto WHERE id=:id";
      $stmt=$this->conexion->prepare($query);
      $stmt->bindParam(":id",$id);
      return $stmt->execute();
  }
}
?>