<?php

class concepto_triaje_controlador extends controller{

    private $_concepto_triaje;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_concepto_triaje = $this->cargar_modelo('concepto_triaje');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Conceptos de Triaje';
        $this->_vista->datos = $this->_concepto_triaje->selecciona();
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }


    public function nuevo() {
        if ($_POST['guardar'] == 1) {
            $this->_concepto_triaje->descripcion = ucwords(strtolower( $_POST['descripcion']));
            $datos =  $this->_concepto_triaje->inserta();
            $this->redireccionar('concepto_triaje');
        }
        $this->_vista->titulo = 'Registrar Concepto de Triaje';
        $this->_vista->action = BASE_URL . 'concepto_triaje/nuevo';
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('concepto_triaje');
        }
        
        if ($_POST['guardar'] == 1) {
            $this->_concepto_triaje->id_concepto_triaje = $_POST['id_concepto_triaje'];
            $this->_concepto_triaje->descripcion = ucwords(strtolower( $_POST['descripcion']));
            $this->_concepto_triaje->actualiza();
            $this->redireccionar('concepto_triaje');
        }

        $this->_concepto_triaje->id_concepto_triaje = $this->filtrarInt($id);
        $this->_vista->datos = $this->_concepto_triaje->selecciona_id();
        $this->_vista->action = BASE_URL . 'concepto_triaje/editar/'.$id;
        $this->_vista->titulo = 'Actualizar Concepto de Triaje';
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('concepto_triaje');
        }
        $this->_concepto_triaje->id_concepto_triaje = $this->filtrarInt($id);
        $this->_concepto_triaje->elimina();
        $this->redireccionar('concepto_triaje');
    }

    public function jsonExtraerConceptoTriaje(){
        $datos = $this->_concepto_triaje->selecciona();
        echo json_encode($datos);
    }
    
}

?>
