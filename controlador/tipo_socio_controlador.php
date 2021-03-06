<?php

class tipo_socio_controlador extends controller{

    private $_model;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_model = $this->cargar_modelo('tipo_socio');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Tipos de Socio';
        $this->_vista->datos = $this->_model->selecciona();
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }


    public function nuevo() {
        if ($_POST['guardar'] == 1) {
            $this->_model->descripcion = ucwords(strtolower($_POST['descripcion']));
            $this->_model->inserta();
            $this->redireccionar('tipo_socio');
        }
        $this->_vista->titulo = 'Registrar Tipo de Socio';
        $this->_vista->action = BASE_URL . 'tipo_socio/nuevo';
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('tipo_socio');
        }
        
        if ($_POST['guardar'] == 1) {
            $this->_model->id_tipo_socio = $_POST['id_tipo_socio'];
            $this->_model->descripcion = ucwords(strtolower($_POST['descripcion']));
            $this->_model->actualiza();
            $this->redireccionar('tipo_socio');
        }

        $this->_model->id_tipo_socio = $this->filtrarInt($id);
        $this->_vista->datos = $this->_model->selecciona_id();
        $this->_vista->action = BASE_URL . 'tipo_socio/editar/'.$id;
        $this->_vista->titulo = 'Actualizar Tipo de Socio';
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('tipo_socio');
        }
        $this->_model->id_tipo_socio = $this->filtrarInt($id);
        $this->_model->elimina();
        $this->redireccionar('tipo_socio');
    }
    
}

?>
