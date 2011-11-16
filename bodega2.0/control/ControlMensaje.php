<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControlMensaje
 *
 * @author VARELA
 */
require_once '../model/Mensaje.php';
class ControlMensaje {
    public function getAll()
    {
        try
        {
            $obj = new Mensaje();
            $lista = $obj->getAll();
            return $lista;
        }
        catch(Exception $e)
        {
            throw $e;
        }
    }
    public function insertarMensaje($_mensajeId, $_mensajeContenido, $_nombre, $_correo){
        $_mensajeId=null;
        $obj = new Mensaje($_mensajeId, $_mensajeContenido, $_nombre, $_correo);
        $obj->insertarMensaje();
    }
    public function modificarMensaje($_mensajeId, $_mensajeContenido, $_nombre, $_correo){
        $obj= new Mensaje($_mensajeId, $_mensajeContenido, $_nombre, $_correo);
        $obj->modificarMensaje();
    }
    public function eliminarMensaje($id){
        $obj=new Mensaje();
        $obj->eliminarMensaje($id);
    }
    public function buscarMensaje($id){
        $obj = new Mensaje();
        $arreglo = $obj->getAll();
        $lista = array();
        foreach ($arreglo as $mensaje){
            if($mensaje->get_mensajeId() == $id){
                $lista[]= $mensaje;
            }
        }
        return $lista;
    }
}

?>
