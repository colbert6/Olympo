<?php

class servicio_controlador extends controller {

    private $_model;
    private $_mol_amb;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_model = $this->cargar_modelo('servicio');
        $this->_mol_amb = $this->cargar_modelo('ambiente');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Servicio';
        $this->_vista->datos = $this->_model->selecciona();
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }
        
    public function nuevo() {
        if (@$_POST['guardar'] == 1) {
            $this->_model->id_ambiente = $_POST['id_ambiente'];
            $this->_model->nombre = ucwords(strtolower($_POST['nombre']));
            $this->_model->descripcion = ucwords(strtolower($_POST['descripcion']));
            $datos = $this->_model->inserta();
            //print_r($datos);exit;
            $this->redireccionar('servicio');
        }
        
        $this->_vista->amb = $this->_mol_amb->selecciona();
        $this->_vista->titulo = 'Registrar Servicio';
        $this->_vista->action = BASE_URL . 'servicio/nuevo';
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('servicio');
        }

        if (@$_POST['guardar'] == 1) {
            $this->_model->id_servicio = $_POST['id_servicio'];
            $this->_model->id_ambiente = $_POST['id_ambiente'];
            $this->_model->nombre = ucwords(strtolower($_POST['nombre']));
            $this->_model->descripcion = ucwords(strtolower($_POST['descripcion']));
            $this->_model->actualiza();
            //print_r($this->_model);exit;
            $this->redireccionar('servicio');
        }
        $this->_model->id_servicio = $this->filtrarInt($id);
        $this->_vista->datos = $this->_model->selecciona_id();
        $this->_vista->amb = $this->_mol_amb->selecciona();//
        
        $this->_vista->titulo = 'Actualizar Servicio';
        $this->_vista->action = BASE_URL . 'servicio/editar/'.$id;
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('servicio');
        }
        $this->_model->id_servicio = $this->filtrarInt($id);
        $this->_model->elimina();
        $this->redireccionar('servicio');
    }
     public function buscador(){
        echo json_encode($this->_model->selecciona());
    }

}

?>

