<?php
require_once '../model/Producto.php';
class ControlProducto {
    public function getAll(){
        try
        {
            $obj = new Producto();
            $lista = $obj->getAll();
            return $lista;
        }
        catch(Exception $e)
        {
            throw $e;
        }
    }

    public function getProductoPorTipo($tipoId)
    {
        $lista = $this->getAll();
        $arreglo = array();
        foreach($lista as $producto)
        {
            if($producto->get_tipoId()==$tipoId)
            {
                $productoId = $producto->get_productoId();
                $proveedorId = $producto->get_nombre();
                $marca = $producto->get_marca();
                $tipoId = $producto->get_tipoId();
                $costo = $producto->get_costo();
                $precio = $producto->get_precio();
                $cantidad = $producto->get_cantidad();
                $descripcion = $producto->get_descripcion();
                $prod = new Producto($productoId, $proveedorId, $marca, $tipoId, $costo, $precio, $cantidad, $descripcion);
                $arreglo[]=$prod;
            }
        }
        return $arreglo;
    }

    public function buscarProductoPorTexto($texto){
        $listaProductos = array();
        $productos = $this->getAll();
        foreach($productos as $producto){
            switch($texto){
                case $producto->get_productoId():
                case $producto->get_marca():
                    $listaProductos[] = $producto;
                    break;
                default:
                    break;
            }
        }
        return $listaClientes;
    }

     public function buscarProducto($id){
        $obj = new Producto();
        $arreglo = $obj->getAll();
        $lista = array();
        foreach ($arreglo as $producto){
            if($producto->get_productoId() == $id){
                $productoEncontrado = $producto;
            }
        }
        return $productoEncontrado;
    }
    
    public function buscarPorProveedor($id){
        $obj = new Producto();
        $arreglo = $obj->getAll();
        $lista = array();
        foreach ($arreglo as $producto){
            if($producto->get_proveedorId() == $id){
                $lista[] = $producto;
            }
        }
        return $lista;
    }

    public function insertarProducto($proveedorId, $marca, $tipoId, $costo, $precio, $cantidad, $descripcion){
        $prod = new Producto();
        $nuevoId=$prod->IncrementarId();
        $obj = new Producto($nuevoId, $proveedorId, $marca, $tipoId, $costo, $precio, $cantidad, $descripcion);
        $obj->insertarProducto();
    }

    public function modificarProducto($proveedorId, $marca, $tipoId, $costo, $precio, $cantidad, $descripcion)
    {
        $prod = new Producto($proveedorId, $marca, $tipoId, $costo, $precio, $cantidad, $descripcion);
        $prod->modificarProducto();
    }

   public function eliminarProducto($id){
        $obj=new Producto();
        return $obj->eliminarProducto($id);
    }

}
?>
