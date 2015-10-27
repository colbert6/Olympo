<?php

class vigencia_controlador extends controller {

    private $_model;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_model = $this->cargar_modelo('vigencia');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Vigencias';
        $this->_vista->datos = $this->_model->selecciona();
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }
        
    public function nuevo() {
        if ($_POST['guardar'] == 1) {
            $this->_model->descripcion = $_POST['descripcion'];
            $this->_model->dias = $_POST['dias'];
            $datos = $this->_model->inserta();
            $this->redireccionar('vigencia');
        }
        $this->_vista->titulo = 'Registrar Vigencia';
        $this->_vista->action = BASE_URL . 'vigencia/nuevo';
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('vigencia');
        }

        if ($_POST['guardar'] == 1) {
            $this->_model->id_vigencia = $_POST['id_vigencia'];
            $this->_model->descripcion = $_POST['descripcion'];
            $this->_model->dias = $_POST['dias'];
            $this->_model->actualiza();
            $this->redireccionar('vigencia');
        }
        $this->_model->id_vigencia = $this->filtrarInt($id);
        $this->_vista->datos = $this->_model->selecciona_id();
        
        $this->_vista->titulo = 'Actualizar Vigencia';
        $this->_vista->action = BASE_URL . 'vigencia/editar/'.$id;
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('vigencia');
        }
        $this->_model->id_vigencia = $this->filtrarInt($id);
        $this->_model->elimina();
        $this->redireccionar('vigencia');
    }

}

?>
