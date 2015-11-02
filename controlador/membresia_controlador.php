<?php

class membresia_controlador extends controller {

    private $_model;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_model = $this->cargar_modelo('membresia');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Membresias';
        $this->_vista->datos = $this->_model->selecciona();
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }
    
    public function buscador(){
        echo json_encode($this->_model->selecciona());
    }
        
    public function nuevo() {
        if ($_POST['guardar'] == 1) {
            $this->_model->descripcion = $_POST['descripcion'];
            $this->_model->numero_servicios = $_POST['numero_servicios'];
            $this->_model->duracion = $_POST['duracion'];
            $this->_model->vigencia = $_POST['vigencia'];
            $this->_model->precio = $_POST['precio']; 
            $datos = $this->_model->inserta();
            $this->redireccionar('membresia');
        }
        $this->_vista->titulo = 'Registrar Membresia';
        $this->_vista->action = BASE_URL . 'membresia/nuevo';
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('membresia');
        }

        if ($_POST['guardar'] == 1) {
            $this->_model->id_tipo_membresia = $_POST['id_tipo_membresia'];
            $this->_model->descripcion = $_POST['descripcion'];
            $this->_model->numero_servicios = $_POST['numero_servicios'];
            $this->_model->duracion = $_POST['duracion'];
            $this->_model->vigencia = $_POST['vigencia'];
            $this->_model->precio = $_POST['precio']; 
            $this->_model->actualiza();
            $this->redireccionar('membresia');
        }
        $this->_model->id_tipo_membresia = $this->filtrarInt($id);
        $this->_vista->datos = $this->_model->selecciona_id();
        
        $this->_vista->titulo = 'Editar Membresia';
        $this->_vista->action = BASE_URL . 'membresia/editar/'.$id;
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('membresia');
        }
        $this->_model->id_tipo_membresia = $this->filtrarInt($id);
        $this->_model->elimina();
        $this->redireccionar('membresia');
    }

}

?>
