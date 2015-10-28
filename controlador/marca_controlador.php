<?php

class marca_controlador extends controller {

    private $_model;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_model = $this->cargar_modelo('marca');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Marcas';
        $this->_vista->datos = $this->_model->selecciona();
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }
        
    public function nuevo() {
        if ($_POST['guardar'] == 1) {
            $this->_model->descripcion = $_POST['descripcion'];
            $datos = $this->_model->inserta();
            $this->redireccionar('marca');
        }
        $this->_vista->titulo = 'Registrar Marca';
        $this->_vista->action = BASE_URL . 'marca/nuevo';
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('marca');
        }

        if ($_POST['guardar'] == 1) {
            $this->_model->id_marca = $_POST['id_marca'];
            $this->_model->descripcion = $_POST['descripcion'];
            $this->_model->actualiza();
            $this->redireccionar('marca');
        }
        $this->_model->id_marca = $this->filtrarInt($id);
        $this->_vista->datos = $this->_model->selecciona_id();
       
        
        $this->_vista->titulo = 'Actualizar Marca';
        $this->_vista->action = BASE_URL . 'marca/editar/'.$id;
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('marca');
        }
        $this->_model->id_marca = $this->filtrarInt($id);
        $this->_model->elimina();
        $this->redireccionar('marca');
    }

}

?>
