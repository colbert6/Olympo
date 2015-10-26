<?php

class login_controlador extends controller {
    
    private $_empleado;
    
    public function __construct() {
        parent::__construct();
        $this->_empleado=  $this->cargar_modelo('empleado');
    }

    public function index() {
        if($_POST['usuario'] == '' || $_POST['clave'] == ''){
            echo "<script>alert('Ingrese usuario y clave')</script>";
            $this->redireccionar();
        }
        $clave=  md5($_POST['clave']);
        $datos=$this->_empleado->login($_POST['usuario'],$clave);
        
//        echo '<pre>';print_r($datos);exit;
        if($datos[0]['USUARIO']==$_POST['usuario'] && $datos[0]['CLAVE']==md5($_POST['clave']) && $datos[0]['ID_EMPLEADO']!=''){
            session::set('autenticado', true);
            session::set('empleado', $datos[0]['NOMBRE'].' '.$datos[0]['APELLIDO_PATERNO']);
            session::set('idempleado', $datos[0]['ID_EMPLEADO']);
            session::set('perfil', $datos[0]['DESCRIPCION']);
            session::set('idperfil', $datos[0]['ID_PERFIL_USUARIO']);
            $this->redireccionar();
        }else{
            echo '<script>alert("usuario o clave incorrecta")</script>';
            $this->redireccionar();
        }
    }
    
    public function mostrar() {
        echo 'Empleado: ' . session::get('empleado') . '<br>';
        echo 'Perfil: ' . session::get('perfil') . '<br>';
    }

    public function cerrar() {
        session::destroy();
        echo '<script>alert("Sesion finalizada")</script>';
        $this->redireccionar();
    }

}

?>
