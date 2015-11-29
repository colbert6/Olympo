<?php

class empleado_controlador extends controller {

    private $_empleado;
    private $_cat_empleado;
    private $_perfil;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_empleado = $this->cargar_modelo('empleado');
        $this->_cat_empleado = $this->cargar_modelo('categoria_empleado');
        $this->_perfil = $this->cargar_modelo('perfiles');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Empleado';
        $this->_vista->datos = $this->_empleado->selecciona();
        $this->_vista->setJs(array('funcion'));
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }
        
    public function nuevo() {
        if (@$_POST['guardar'] == 1) {
            
            $this->_empleado->id_categoria_empleado = $_POST['id_categoria_empleado'];//36
            $this->_empleado->nombre = ucwords(strtolower($_POST['nombre']));//37
            $this->_empleado->apellido_paterno = ucwords(strtolower($_POST['apellido_paterno']));//38
            $this->_empleado->apellido_materno = ucwords(strtolower($_POST['apellido_materno']));//39
            $this->_empleado->dni = $_POST['dni'];//40
            $this->_empleado->email = $_POST['email'];//41
            $this->_empleado->telefono = $_POST['telefono'];//42
            $this->_empleado->celular = $_POST['celular'];//43
            $this->_empleado->sexo = $_POST['sexo'];//44
            $this->_empleado->direccion = $_POST['direccion'];//45
            $this->_empleado->fecha_nacimiento = $_POST['fecha_nacimiento'];//46
            $this->_empleado->estado_civil = $_POST['estado_civil'];//47
            $this->_empleado->numero_hijo = $_POST['numero_hijo'];//56
            $this->_empleado->grado_estudio = $_POST['grado_estudio'];//58
            
            
            $this->_empleado->inserta();
            $this->redireccionar('empleado');
        }
        $this->_vista->cat_empleado = $this->_cat_empleado->selecciona();
        $this->_vista->perfil = $this->_perfil->selecciona();
        $this->_vista->titulo = 'Registrar Empleado';
        $this->_vista->action = BASE_URL . 'empleado/nuevo';
        $this->_vista->setCss_public(array('jquery-ui.custom'));
        $this->_vista->setJs_public(array('jquery-ui.min'));
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('empleado');
        }

        if (@$_POST['guardar'] == 1) {
            $this->_empleado->id_empleado = $_POST['id_empleado'];//104
            $this->_empleado->id_categoria_empleado = $_POST['id_categoria_empleado'];//36
            $this->_empleado->nombre = ucwords(strtolower($_POST['nombre']));//37
            $this->_empleado->apellido_paterno = ucwords(strtolower($_POST['apellido_paterno']));//38
            $this->_empleado->apellido_materno = ucwords(strtolower($_POST['apellido_materno']));//39
            $this->_empleado->dni = $_POST['dni'];//40
            $this->_empleado->email = $_POST['email'];//41
            $this->_empleado->telefono = $_POST['telefono'];//42
            $this->_empleado->celular = $_POST['celular'];//43
            $this->_empleado->sexo = $_POST['sexo'];//44
            $this->_empleado->direccion = $_POST['direccion'];//45
            $this->_empleado->fecha_nacimiento = $_POST['fecha_nacimiento'];//46
            $this->_empleado->estado_civil = $_POST['estado_civil'];//47
            $this->_empleado->numero_hijo = $_POST['numero_hijo'];//56
            $this->_empleado->grado_estudio = $_POST['grado_estudio'];//5            
            $this->_empleado->actualiza();
            $this->redireccionar('empleado');
        }
        $this->_vista->cat_empleado = $this->_cat_empleado->selecciona();
        $this->_vista->perfil = $this->_perfil->selecciona();
        $this->_empleado->id_empleado = $this->filtrarInt($id);
        $this->_vista->datos = $this->_empleado->selecciona_id();
        
        $this->_vista->titulo = 'Actualizar Empleado';
        $this->_vista->action = BASE_URL . 'empleado/editar/'.$id;
        $this->_vista->setCss_public(array('jquery-ui.custom'));
        $this->_vista->setJs_public(array('jquery-ui.min'));
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('empleado');
        }
        $this->_empleado->id_empleado = $this->filtrarInt($id);
        $this->_empleado->elimina();
        $this->redireccionar('empleado');
    }
    public function buscador(){
        if(isset($_POST['dni'])){
            $this->_empleado->dni=$_POST['dni'];
            $empleado = $this->_empleado->selecciona_dni();
        }else if(isset($_POST['id'])){
            $this->_empleado->id_empleado=$_POST['id'];
           // print($this->_empleado->id);exit();
            $empleado = $this->_empleado->selecciona_id_e();
        }else if(isset($_POST['all'])){
            $empleado = $this->_empleado->selecciona();
        }
        echo json_encode($empleado);
    }

}

?>