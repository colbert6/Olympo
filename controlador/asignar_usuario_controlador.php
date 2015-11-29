<?php

class asignar_usuario_controlador extends controller {

    private $_socio;
    private $_empleado;
    private $_usuario;
    private $_perfiles;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_socio = $this->cargar_modelo('socio');
        $this->_empleado = $this->cargar_modelo('empleado');
        $this->_usuario = $this->cargar_modelo('usuario');
        $this->_perfiles = $this->cargar_modelo('perfiles');
    }
    public function index() {
        if ($_POST['guardar'] == 1) {
            $tipo = $_POST["tipo"];
            if ($tipo=='e') {
                $id = $_POST["id_empleado"];

            }else if($tipo=='s'){
                $id = $_POST["id_socio"];
            }
            $user = $_POST["user"];
            $pass = $_POST["pass"];             

            //$datos = array($tipo,$id,$user,$pass);
            //print_r($datos); exit;
            if ($tipo=='e') {

                $this->_usuario->id_actor = $id;
                $this->_usuario->usuario = $user;
                $this->_usuario->clave = md5($pass);
                $this->_usuario->tipo_actor = 'e';
                $this->_usuario->id_perfil_usuario = $_POST["id_perfil_usuario"];
                $this->_usuario->inserta();

            }else if($tipo=='s'){

                $this->_usuario->usuario = $user;
                $this->_usuario->clave = md5($pass);
                $this->_usuario->actualiza();
            }

            echo "<script>alert('Datos Actualizados Correctamente')</script>";
            $this->redireccionar('asignar_usuario');
        }
        $this->_vista->titulo = 'Asignar Credenciales';
        $this->_vista->perfiles = $this->_perfiles->selecciona();
        $this->_vista->action = BASE_URL . 'asignar_usuario/';
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min'));
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

}

?>
