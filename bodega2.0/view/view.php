<?php
require_once '/../control/ControlUsuario.php';
require_once '/../model/Usuario.php';


session_start();
class view {
    private $_usuario=null;
    public function run(){
        $usuarioControl = new ControlUsuario();
        if (isset($_POST['ingresar'])) {
            $usuario = $_POST['usuario'];
            $password = $_POST['contrasenha'];
            if ($usuario =="administrador")
            {
                    header("location:adminView.php");
                   
            }
            else
            {
            $result = $usuarioControl->verificarUsuario($usuario, $password);
            if ($result == 1) {
                $this->_usuario = $usuarioControl->buscarPorUsuario($usuario);
                $_SESSION['us'] = $this->_usuario;
                $_GET['opcion'] = "PMiPerfil";
                
            }else {
                    $opcion =$_GET['opcion']= "PLogin";
                }
            }
        }
        
         if (!isset($_GET['opcion'])) {
            $this->_mostrarPrincipal(null);
        }else{
            $opcion = $_GET['opcion'];
            switch($opcion){
            case'PLogin':
                $this->_mostrarPrincipal(null);
                break;
            case 'PMiPerfil':
                $this->_usuario = $_SESSION['us'];
                $this->_mostrarPrincipal($this->_usuario);
                break;
            case 'principal':
                $this->_usuario = $_SESSION['us'];
                $this->_mostrarPrincipal($this->_usuario);
                break;
             case 'nosotros':
                 $this->_usuario = $_SESSION['us'];
                 $this->_mostrarNosotros($this->_usuario);
                 break;
             case 'catalogo':
                 $this->_usuario = $_SESSION['us'];
                if($this->_usuario == null){
                    $this->_mostrarFallo();
                }else{
                 $this->_mostrarCatalogo($this->_usuario);
                }
                 break;
             case 'novedades':
                 $this->_usuario = $_SESSION['us'];
                 $this->_mostrarNovedades($this->_usuario);
                 break;
             case 'oContra':
                 $this->_olvidaste();
                 break;
             case 'miCuenta':
                 $this->_mostrarMiCuenta();
                 break;
             case 'contactenos':
                 $this->_usuario = $_SESSION['us'];
                 $this->_mostrarContactenos($this->_usuario);
                 break;
             case 'registrar':
                 $this->_mostrarRegistrar();
                 break;
             case'agregar':
                 $this->_usuario = $_SESSION['us'];
                 $this->_mostrarCarrito($this->_usuario);
                 break;
             case 'registrarU':
                 $dni = $_POST['dni'];
                 $nombre = $_POST['nombres'];
                 $apellidoP = $_POST['apellidoP'];
                 $apellidoM = $_POST['apellidoM'];
                 $sexo = $_POST['radio'];
                 $contrasenha = $_POST['clave'];
                 $Rcontra = $_POST['claveR'];
                 $correo = $_POST['correo'];
                 $telefono = $_POST['telefono'];
                 $num = $_POST['comboDistrito'];
                 switch($num){
                     case '1':
                         $distrito="Surquillo";
                         break;
                     case '2':
                         $distrito = "SMP";
                         break;
                     case '3':
                         $distrito = "Miraflores";
                         break;
                     case '4':
                         $distrito = "San Isidro";
                         break;
                 }                 
                 $direccion = $_POST['direccion'];
                 $dep = $_POST['departamento'];
                 $referencia = $_POST['referencia'];
                 $usuarioControl->insertarUsuario( $nombre, $apellidoP, $apellidoM,
                         $dni, $contrasenha, $direccion, $distrito, $correo);
                $this->_usuario = $_SESSION['us'];
                $this->_mostrarPrincipal($this->_usuario);
                 break;
                 
            }
        }
        
        
    }
    private function _mostrarMiCuenta(){
        require_once 'miCuenta.html';
    }

    private function _mostrarCarrito($usuario){
        require_once 'carrito.html';
    }
    
    private function _olvidaste(){
        require_once 'olvidoPass.html';
    }
    
    private function _mostrarRegistrar(){
        require_once 'registrarUsuario.html';
    }
    
    private function _mostrarContactenos($usuario){
        require_once 'contactenos.html';
    }
    
    private function _mostrarNovedades($usuario){
        require_once 'novedades.html';
    }
    
    
    private function _mostrarCatalogo($usuario){
        require_once 'catalogo.html';
    }
    private function _mostrarFallo(){
        require_once 'catalogoFallo.html';
    }
    
    private function _mostrarNosotros($usuario){
        require_once 'nosotros.html';
    }
    
    private function _mostrarAdmin(){
        require_once 'principalAdmin.html';
    }
    private function _mostrarPrincipal($usuario){
        require_once 'principal.html';
    }
    
}
$miView = new view();
$miView->run();
?>
