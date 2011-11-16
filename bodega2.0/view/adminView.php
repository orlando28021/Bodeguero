<?php
require_once '/../control/ControlUsuario.php';
require_once '/../control/ControlTipo.php';
require_once '/../control/ControlProducto.php';
require_once '/../control/ControlCategoria.php';
require_once '/../control/ControlProveedor.php';
require_once '/../model/Usuario.php';
require_once '../control/ControlMensaje.php';
//Obligatorio esta ruta
require_once '../control/GraphBar.php';

session_start();
class adminView {
    private $_admin;
    private $_arreglo = array();
    public function run(){
         if (!isset($_GET['opcion'])) {
            $this->_mostrarAdmin();
        }else{
            $arreglo = array();
            $obj = new ControlMensaje();
            $opcion = $_GET['opcion'];
            switch($opcion){
                case'principalA':
                    $this->_mostrarAdmin();
                    break;
                case'clientes':
                    $usuario = new ControlUsuario();
                    $clientes = $usuario->getAll();
                    $this->_mostrarClientes($clientes);
                    break;
                case'detalleCliente':
                    $clienteId = $_GET['id'];
                    $usuario = new ControlUsuario();
                    $cliente = $usuario->buscarUsuario($clienteId);
                    $this->_mostrarClienteDetalle($cliente);
                    break;
                 case'buscarCliente':
                    $texto = $_POST['nuevoTexto'];
                    echo 'el texto es '.$texto;
                    $usuario = new ControlUsuario();
                    $clientes = $usuario->buscarClientePorTexto($texto);
                    $this->_mostrarClientes($clientes);
                    break;
                 case'eliminarCliente':
                    $clienteId = $_GET['id'];
                    $usuario = new ControlUsuario();
                    $clientes = $usuario->eliminarUsuario($clienteId);
                    $this->_mostrarClientes($clientes);
                    break;
                case'producto':
                    $producto = new ControlProducto();
                    $usuario = new ControlUsuario();
                    $tipo = new ControlTipo();
                    $productos = $producto->getAll();
                    $this->_mostrarProductos($productos, $tipo);
                    break;
                 case'detalleProducto':
                    $productoId = $_GET['id'];
                    $producto = new ControlProducto();
                    $categoria = new ControlCategoria();
                    $tipo = new ControlTipo();
                    $proveedor = new ControlProveedor();
                    $nuevoProducto = $producto->buscarProducto($productoId);
                    $nombreCategoria = $categoria->obtenerCategoriaPorId($tipo->obtenerCategoriaPorTipo($nuevoProducto->get_tipoId()));
                    $nombreTipo = $tipo->getNombrePorId($nuevoProducto->get_tipoId());
                    $nombreProveedor = $proveedor->obtenerNombrePorId($nuevoProducto->get_proveedorId());
                    $this->_mostrarProductoDetalle($nuevoProducto, $nombreProveedor, $nombreTipo, $nombreCategoria);
                    break;
                 case'buscarProducto':
                    $texto = $_POST['nuevoTexto'];
                    echo 'el texto es '.$texto;
                    $usuario = new ControlUsuario();
                    $clientes = $usuario->buscarClientePorTexto($texto);
                    $this->_mostrarClientes($clientes);
                    break;
                 case'eliminarProducto':
                    $productoId = $_GET['id'];
                    $producto = new ControlProducto();
                    $tipo = new ControlTipo();
                    $productos = $producto->eliminarProducto($productoId);
                    $this->_mostrarProductos($productos, $tipo);
                    break;
                case 'proveedores':
                     $proveedor = new ControlProveedor();
                    $proveedores = $proveedor->getAll();
                    $this->_mostrarProveedores($proveedores);
                    break;
                case 'realizarPedido':
                    $producto = new ControlProducto();
                    $tipo = new ControlTipo();
                    $productos = $producto->buscarPorProveedor('1');
                    $this->_mostrarPedido($productos,$tipo,null,null);
                    break;
                case 'agregarCarrito':
                    $id = $_GET['id'];
                    $producto = new ControlProducto();
                    $buscar = $producto->buscarProducto($id);
                    $productos = $producto->buscarPorProveedor('1');
                    $arreglo = $_SESSION['car'];
                    $cantidad = $_POST['cantidad'];
                    $arreglo = $buscar;
                    $_SESSION['car'] = $arreglo;
                    $tipo = new ControlTipo();
                    $this->_mostrarPedido($productos,$tipo,$buscar,$cantidad);
                    break;
                case 'historial':
                    //Todo copia
                    if(isset ($_POST['buscarBarra'])){
                        $buscarBarra=$_POST['buscarBarra'];
                    }else {
                        $buscarBarra="semana";
                    }
                    $imagen = new GraphBar();
                    if($buscarBarra=="semana"){
                        $imagen->_showGraph_pChart($buscarBarra);
                    }  elseif ($buscarBarra=="mes") {
                        $imagen->_showGraph_pChart($buscarBarra);
                    }
                    $this->_mostrarHistorial();
                    //Fin de copiar
                    break;
                case 'detalleProv':
                    $this->_mostrarDetalleProv();
                    break;
                              
                case'detalleProveedor':
                    $productoId = $_GET['id'];
                    $producto = new ControlProducto();
                    $categoria = new ControlCategoria();
                    $tipo = new ControlTipo();
                    $proveedor = new ControlProveedor();
                    $nuevoProducto = $producto->buscarProducto($productoId);
                    $nombreCategoria = $categoria->obtenerCategoriaPorId($tipo->obtenerCategoriaPorTipo($nuevoProducto->get_tipoId()));
                    $nombreTipo = $tipo->getNombrePorId($nuevoProducto->get_tipoId());
                    $nombreProveedor = $proveedor->obtenerNombrePorId($nuevoProducto->get_proveedorId());
                    $this->_mostrarProductoDetalle($nuevoProducto, $nombreProveedor, $nombreTipo, $nombreCategoria);
                    break;

                 case'buscarProducto':
                    $texto = $_POST['nuevoTexto'];
                    echo 'el texto es '.$texto;
                    $usuario = new ControlUsuario();
                    $clientes = $usuario->buscarClientePorTexto($texto);
                    $this->_mostrarClientes($clientes);
                    break;
                 case'eliminarProducto':
                    $productoId = $_GET['id'];
                    $producto = new ControlProducto();
                    $tipo = new ControlTipo();
                    $productos = $producto->eliminarProducto($productoId);
                    $this->_mostrarProductos($productos, $tipo);
                    break;
                case 'mensajes':
                    
                    $lista = $obj->getAll();
                    $this->_mostrarMensaje($lista);
                    break;
                
                case 'ver':
                    $id = $_GET['id'];
                    $mensaje = $obj->buscarMensaje($id);
                    $this->_mostrarMensajeDetalle($mensaje);
                    break;
                case 'eliminar':
                    $id = $_GET['id'];
                    $obj->eliminarMensaje($id);
                    $lista = $obj->getAll();
                    $this->_mostrarMensaje($lista);
                    break;
                case 'enviarNuevo':
                    //$obj->buscarMensaje($id);
                    $this->_mostrarMensajeEnviar();
                    break;
                case 'enviar':
                    
                    $this->_mostrarMensajeEnviar();
                    break;
                case 'regresar':
                    $lista = $obj->getAll();
                    $this->_mostrarMensaje($lista);
                    break;

                case'PLogin':
                    $this->_mostrarAdmin();
                    break;
            }
            
            
            }
        }

    private function _mostrarMensaje($lista){
        require_once 'mensaje.html';
    }
    private function _mostrarMensajeDetalle($mensaje){
        require_once 'mensajeDetalle.html';
    }
    private function _mostrarMensajeEnviar(){
        require_once 'mensajeEnviar.html';
    }    
        
    private function _mostrarDetalleProv(){
        require_once 'detalleProv.html';
    }    
        
    private function _mostrarPedido($productos,$tipo,$buscar,$cantidad){
        require_once 'hacerPedido.html';
    }    
    
    private function _mostrarAdmin(){
        require_once 'principalAdmin.html';
    }
    private function _mostrarClientes($clientes){
        require_once 'clientes.html';
    }
    private function _mostrarClienteDetalle($cliente){
        require_once 'clienteDetalle.html';
    }
    private function _mostrarProductos($productos, $tipo){
        require_once 'productos.html';
    }
    private function _mostrarProductoDetalle($nuevoProducto, $nombreProveedor, $nombreTipo, $nombreCategoria){
        require_once 'detalleProducto.html';
    }
    private function _mostrarProveedores($proveedores){
        require_once 'proveedores.html';
    }
     private function _mostrarHistorial(){
        require_once 'historial.html';
    }

}
$miView = new adminView();
$miView->run();
?>
