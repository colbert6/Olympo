<?php

class concepto_movimiento_controlador extends controller {

    private $_model;
    private $_model_1;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_model = $this->cargar_modelo('concepto_movimiento');
        $this->_model_1 = $this->cargar_modelo('tipo_movimiento');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Concepto de Movimiento';
        $this->_vista->datos = $this->_model->selecciona();
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }
        
    public function nuevo() {
        if ($_POST['guardar'] == 1) {
            $this->_model->id_tipo_movimiento = $_POST['id_tipo_movimiento'];
            $this->_model->descripcion = strtoupper($_POST['descripcion']);
            $this->_model->inserta();
            $this->redireccionar('concepto_movimiento');
        }
        $this->_vista->datos_1 = $this->_model_1->selecciona();
        $this->_vista->titulo = 'Registrar Concepto de Movimiento';
        $this->_vista->action = BASE_URL . 'concepto_movimiento/nuevo';
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('concepto_movimiento');
        }

        if ($_POST['guardar'] == 1) {
            $this->_model->id_concepto_movimiento = $_POST['id_concepto_movimiento'];
            $this->_model->id_tipo_movimiento = $_POST['id_tipo_movimiento'];
            $this->_model->descripcion = strtoupper($_POST['descripcion']);
            $this->_model->actualiza();
            $this->redireccionar('concepto_movimiento');
        }
        $this->_vista->datos_1 = $this->_model_1->selecciona();
        $this->_model->id_concepto_movimiento = $this->filtrarInt($id);
        $this->_vista->datos = $this->_model->selecciona_id();
        
        $this->_vista->titulo = 'Actualizar Concepto de Movimiento';
        $this->_vista->action = BASE_URL . 'concepto_movimiento/editar/'.$id;
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('concepto_movimiento');
        }
        $this->_model->id_concepto_movimiento = $this->filtrarInt($id);
        $this->_model->elimina();
        $this->redireccionar('concepto_movimiento');
    }
    public function getConceptoMovimiento(){
        $this->_model->id_tipo_movimiento=$_POST["id"];
        echo json_encode($this->_model->selecciona_x_tipo());
    }

}

?>
