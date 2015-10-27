<?php

class ambiente_controlador extends controller {

    private $_model;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_model = $this->cargar_modelo('ambiente');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Ambientes';
        $this->_vista->datos = $this->_model->selecciona();
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }
        
    public function nuevo() {
        if ($_POST['guardar'] == 1) {
            $this->_model->descripcion = $_POST['descripcion'];
            $datos = $this->_model->inserta();
            $this->redireccionar('ambiente');
        }
        $this->_vista->titulo = 'Registrar Ambiente';
        $this->_vista->action = BASE_URL . 'ambiente/nuevo';
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('ambiente');
        }

        if ($_POST['guardar'] == 1) {
            $this->_model->id_ambiente = $_POST['id_ambiente'];
            $this->_model->descripcion = $_POST['descripcion'];
            $this->_model->actualiza();
            $this->redireccionar('ambiente');
        }
        $this->_model->id_ambiente = $this->filtrarInt($id);
        $this->_vista->datos = $this->_model->selecciona_id();
        
        $this->_vista->titulo = 'Actualizar Ambiente';
        $this->_vista->action = BASE_URL . 'ambiente/editar/'.$id;
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('ambiente');
        }
        $this->_model->id_ambiente = $this->filtrarInt($id);
        $this->_model->elimina();
        $this->redireccionar('ambiente');
    }

}

?>
