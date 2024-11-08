<?php
class carritoDTO{
    private $items = [];
    public function agregarProducto($producto,$cantidad){
        $id=$producto->getId();
        if(isset($this->items[$id])){
            $this->items[$id]["cantidad"]+=$cantidad;
}else{
        $this->items[$id]=[ "producto"=>$producto, "cantidad"=>$cantidad];
        }
}
public function eliminarProducto($id){
        if(isset($this->items[$id])){
            unset($this->items[$id]);
        }
    }
    public function vaciarCarrito(){
        $this->items = [];
    }
    public function getItems(){
        return $this->items;
    }
}
?>
