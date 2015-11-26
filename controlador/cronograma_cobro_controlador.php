<?php

class cronograma_cobro_controlador extends controller {

    private $_model;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_model = $this->cargar_modelo('cronograma_cobro');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Cobros';
        $this->_vista->datos = $this->_model->selecciona();
        //print_r($this->_vista->datos);exit;
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }
    
    public function cronograma($idventa, $monto_restante) {
        $this->_model->id_venta = $idventa;
        $this->_vista->datos = $this->_model->selecciona_cuota();
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->titulo = 'Cronograma de Cobros';
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

    

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('almacen');
        }
        $this->_model->id_almacen = $this->filtrarInt($id);
        $this->_model->elimina();
        $this->redireccionar('almacen');
    }

    
    public function getCuotasVenta(){
        $this->_model->id_venta = $_POST["id_c"];
        $datos = $this->_model->cuota_x_venta();
        echo json_encode($datos);
    }

}

?>
