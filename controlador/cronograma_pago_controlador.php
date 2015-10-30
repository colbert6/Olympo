<?php

class cronograma_pago_controlador extends controller {

    private $_model;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_model = $this->cargar_modelo('cronograma_pago');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Pagos';
        $this->_vista->datos = $this->_model->selecciona();
        //print_r($this->_vista->datos);exit;
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }
    
    public function cronograma($idcompra, $monto_restante) {
        $this->_model->id_compra = $idcompra;
        $this->_vista->datos = $this->_model->selecciona_cuota();
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->titulo = 'Cronograma de Pagos';
        $this->_vista->btn_action = BASE_URL . 'cronograma_pago/amortizar/' . $idcompra . '/' . $monto_restante;
        $this->_vista->renderizar('cronograma');
    }
    
    public function nuevo() {
        if ($_POST['guardar'] == 1) {
            $this->_model->descripcion = $_POST['descripcion'];
            $datos = $this->_model->inserta();
            $this->redireccionar('almacen');
        }
        $this->_vista->titulo = 'Registrar Almacen';
        $this->_vista->action = BASE_URL . 'almacen/nuevo';
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('almacen');
        }

        if ($_POST['guardar'] == 1) {
            $this->_model->id_almacen = $_POST['id_almacen'];
            $this->_model->descripcion = $_POST['descripcion'];
            $this->_model->actualiza();
            $this->redireccionar('almacen');
        }
        $this->_model->id_almacen = $this->filtrarInt($id);
        $this->_vista->datos = $this->_model->selecciona_id();
        
        $this->_vista->titulo = 'Actualizar Almacen';
        $this->_vista->action = BASE_URL . 'almacen/editar/'.$id;
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('almacen');
        }
        $this->_model->id_almacen = $this->filtrarInt($id);
        $this->_model->elimina();
        $this->redireccionar('almacen');
    }

}

?>
