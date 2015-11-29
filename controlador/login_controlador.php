<?php

class login_controlador extends controller {
    
    private $_usuario;
    
    public function __construct() {
        parent::__construct();
        $this->_usuario =  $this->cargar_modelo('usuario');
    }

    public function index() {
        if($_POST['usuario'] == '' || $_POST['clave'] == ''){
            echo "<script>alert('Ingrese usuario y clave')</script>";
            $this->redireccionar();
        }
        $clave=  md5($_POST['clave']);
        $datos=$this->_usuario->login($_POST['usuario'],$clave);
        if(count($datos)){
            if($datos[0]['TIPO_ACTOR']=='e'){
                session::set('autenticado', true);
                session::set('empleado', $datos[0]['NOMBRE'].' '.$datos[0]['APELLIDO_PATERNO']);
                session::set('id_empleado', $datos[0]['ID_EMPLEADO']);
                session::set('perfil', $datos[0]['PERFIL_USUARIO']);
                session::set('idperfil', $datos[0]['ID_PERFIL_USUARIO']);
                session::set('tipo_actor', $datos[0]['TIPO_ACTOR']);
                $this->redireccionar();

            }else if($datos[0]['TIPO_ACTOR']=='s'){
                session::set('autenticado', true);
                session::set('socio', $datos[0]['NOMBRE'].' '.$datos[0]['APELLIDO_PATERNO']);
                session::set('id_socio', $datos[0]['ID_SOCIO']);
                session::set('perfil', $datos[0]['PERFIL_USUARIO']);
                session::set('idperfil', $datos[0]['ID_PERFIL_USUARIO']);
                session::set('tipo_actor', $datos[0]['TIPO_ACTOR']);
                $this->redireccionar();
            }

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
