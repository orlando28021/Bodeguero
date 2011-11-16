<?php

require_once '/../model/Proveedor.php';

class ControlProveedor {

    public function getAll() {
        try {
            $obj = new Proveedor();
            $lista = $obj->getAll();
            return $lista;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function buscarProveeedorPorId($proveedorId) {
        $lista = getAll();
        foreach ($lista as $proveedor) {
            if ($proveedor->get_proveedorId() == $proveedorId) {
                $nombreEmpresa = $proveedor->get_nombreEmpresa();
                $ruc = $proveedor->get_ruc();
                $correo = $proveedor->get_correo();
                $productoId = $proveedor->get_productoId();
                $nombreContacto = $proveedor->get_nombreContacto();
                $apellidoContacto = $proveedor->get_apellidoContacto();
                $dniContacto = $proveedor->get_dniContacto();
                $telefonoCOntacto = $proveedor->get_telefonoContacto();
                $prov = new Proveedor($proveedorId, $nombreEmpresa, $ruc, $correo, $productoId,
                                $nombreContacto, $apellidoContacto, $dniContacto, $telefonoContacto);
            }
        }
        return $prov;
    }

    public function buscarProveedorPorNombre($nombreEmpresa) {
        $obj = new Proveedor();
        $arreglo = $obj->getAll();
        $lista = array();
        foreach ($arreglo as $proveedor) {
            if ($proveedor->get_nombreEmpresa() == $nombreEmpresa) {
                $lista[] = $proveedor;
            }
        }
        return $lista;
    }

    public function insertarProveedor($nombreEmpresa, $ruc, $correo, $productoId, $nombreContacto, $apellidoContacto, $dniContacto, $telefonoContacto) {
        $prov = new Proveedor();
        $nuevoId = $prov->incrementarId();
        $obj = new Proveedor($nuevoId, $nombreEmpresa, $ruc, $correo, $productoId, $nombreContacto,
                        $apellidoContacto, $dniContacto, $telefonoContacto);
        $obj->insertarProveedor();
    }

    public function modificarProveedor($proveedorId, $nombreEmpresa, $ruc, $correo, $productoId, $nombreContacto, $apellidoContacto, $dniContacto, $telefonoContacto) {
        $prov = new Proveedor($proveedorId, $nombreEmpresa, $ruc, $correo, $productoId,
                        $nombreContacto, $apellidoContacto, $dniContacto, $telefonoContacto);
        $prov->modificarProveedor();
    }

    public function eliminarProveedor($id) {
        $obj = new Proveedor();
        $obj->eliminarProveedor($id);
    }

    public function obtenerNombrePorId($id){
        $proveedores = $this->getAll();
        foreach($proveedores as $proveedor){
            if($proveedor->get_proveedorId() == $id){
                $nombre = $proveedor->get_nombreEmpresa();
            }
        }
        return $nombre;
    }

}
