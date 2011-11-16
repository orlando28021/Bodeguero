<?php

require_once '../model/Usuario.php';
class ControlUsuario {
    public function getAll()
    {
        try
        {
            $obj = new Usuario();
            $lista = $obj->getAll();
            return $lista;
        }
        catch(Exception $e)
        {
            throw $e;
        }
    }
    public function insertarUsuario($_nombre, $_apellidoPaterno, $_apellidoMaterno, $_dni, $_contrasenha, $_direccion, $_distrito, $_correoElectronico){
        $_usuarioId=null;
        $ob = new Usuario();
        $obj = new Usuario($ob->IncrementarId(), $_nombre, $_apellidoPaterno, $_apellidoMaterno, $_dni, $_contrasenha, $_direccion, $_distrito, $_correoElectronico);
        $obj->insertarUsuario();
    }
    public function modificarUsuario($_usuarioId, $_nombre, $_apellidoPaterno, $_apellidoMaterno, $_dni, $_contrasenha, $_direccion, $_distrito, $_correoElectronico){
        $obj= new Usuario($_usuarioId, $_nombre, $_apellidoPaterno, $_apellidoMaterno, $_dni, $_contrasenha, $_direccion, $_distrito, $_correoElectronico);
        $obj->modificarUsuario();
    }
    public function eliminarUsuario($id){
        $obj=new Usuario();
        $lista= $obj->eliminarUsuario($id);
        return $lista;
    }
    public function buscarUsuario($id){
        $obj = new Usuario();
        $arreglo = $obj->getAll();
        $lista = array();
        foreach ($arreglo as $usuario){
            if($usuario->get_usuarioId() == $id){
                $lista[]= $usuario;
            }
        }
        return $lista;
    }
    
    public function buscarClientePorTexto($texto){
        $listaClientes = array();
        $clientes = $this->getAll();
        foreach($clientes as $cliente){
            switch($texto){
                case $cliente->get_usuarioId():
                case $cliente->get_nombre():
                case $cliente->get_apellidoPaterno():
                case $cliente->get_apellidoMaterno():
                case $cliente->get_dni():
                    $listaClientes[] = $cliente;
                    break;
                default:
                    break;
            }
        }
        return $listaClientes;
    }
    
    
    public function verificarUsuario($user,$contrasenha){
        $obj = new Usuario();
        $arreglo = $obj->getAll();
        foreach ($arreglo as $usuario){
            if(($usuario->get_correoElectronico() == $user) && ($usuario->get_contrasenha() == $contrasenha) ){
                return 1;
            }else{
                return 0;
            }
        }
        
    }
    
    public function buscarPorUsuario($user){
        $obj = new Usuario();
        $arreglo = $obj->getAll();
        $lista = array();
        foreach ($arreglo as $usuario){
            if(($usuario->get_correoElectronico() == $user)){
                return $usuario;
            }
        }
    }
}

?>
