<?php

class ejercicio_controlador extends controller {

    private $_model;
    private $_servicio;
    private $_categoria_ejercicio;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_model = $this->cargar_modelo('ejercicio');
        $this->_servicio = $this->cargar_modelo('servicio');
        $this->_categoria_ejercicio= $this->cargar_modelo('categoria_ejercicio');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Ejercicios';
        $this->_vista->datos = $this->_model->selecciona();
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }
        
    public function nuevo() {
        if ($_POST['guardar'] == 1) {
            //$this->_model->id_ejercicio = $_POST['id_ejercicio'];
            $this->_model->id_servicio = $_POST['id_servicio'];
            $this->_model->id_categoria_ejercicio = $_POST['id_categoria_ejercicio'];
            $this->_model->descripcion = ucwords(strtolower( $_POST['descripcion']));
            $datos = $this->_model->inserta();
            $this->redireccionar('ejercicio');
        }
        $this->_vista->titulo = 'Registrar Ejercicio';
        $this->_vista->action = BASE_URL . 'ejercicio/nuevo';
        $this->_vista->servicio = $this->_servicio->selecciona();
        $this->_vista->categoria_ejercicio = $this->_categoria_ejercicio->selecciona();
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('ejercicio');
        }

        if ($_POST['guardar'] == 1) {
            $this->_model->id_ejercicio = $_POST['id_ejercicio'];
            $this->_model->id_servicio = $_POST['id_servicio'];
            $this->_model->id_categoria_ejercicio = $_POST['id_categoria_ejercicio'];
            $this->_model->descripcion = ucwords(strtolower( $_POST['descripcion']));
            $this->_model->actualiza();
            $this->redireccionar('ejercicio');
        }
        $this->_model->id_ejercicio = $this->filtrarInt($id);
        $this->_vista->datos = $this->_model->selecciona_id();
        
        $this->_vista->titulo = 'Actualizar Ejercicio';
        $this->_vista->action = BASE_URL . 'ejercicio/editar/'.$id;
        $this->_vista->servicio = $this->_servicio->selecciona();
        $this->_vista->categoria_ejercicio = $this->_categoria_ejercicio->selecciona();
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('ejercicio');
        }
        $this->_model->id_ejercicio = $this->filtrarInt($id);
        $this->_model->elimina();
        $this->redireccionar('ejercicio');
    }

}

?>
