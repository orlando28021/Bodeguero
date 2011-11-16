<?php
require_once '/../model/Categoria.php';
class ControlCategoria {
    public function getAll(){
        try
        {
            $obj = new Categoria();
            $lista = $obj->getAll();
            return $lista;
        }
        catch(Exception $e)
        {
            throw $e;
        }
    }


    public function insertarCategoria($nombre){
        $prod = new Categoria();
        $nuevoId=$prod->IncrementarId();
        $obj = new Categoria($nombre);
        $obj->insertarCategoria();
    }

    public function modificarCategoria($nombre)
    {
        $prod = new Categoria($nombre);
        $prod->modificarCategoria();
    }

    public function eliminarCategoria($id)
    {
        $obj = new Categoria();
        $obj->eliminarCategoria($id);
    }

    public function obtenerCategoriaPorId($id){
        $categorias = $this->getAll();
        foreach($categorias as $categoria){
            if($categoria->get_categoriaId() == $id){
                $nombre = $categoria->get_nombre();
            }
        }
        return $nombre;
    }
}
?>
