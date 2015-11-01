<?php

class movimiento_controlador extends controller {

    private $_movimiento;
    

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_movimiento = $this->cargar_modelo('movimiento');
    } 

    public function index() {
        $this->_vista->titulo = 'Lista de Movimientos';
        //$this->_vista->setJs(array('funcion'));
        $this->_vista->datos = $this->_compra->selecciona();
        //print_r($this->_vista->datos);exit;
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }
    

    
    public function nuevo() {
        
        
        if ($_POST['guardar'] == 1) {
            
            $this->redireccionar('compra');
        }
        $this->_vista->almacen = $this->_almacen->selecciona();
        $this->_vista->titulo = 'Registrar Compra';
        $this->_vista->action = BASE_URL . 'compra/nuevo';
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min'));
        $this->_vista->setJs(array('funciones_form','jquery-ui.min'));
        $this->_vista->renderizar('form');
    }

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('compra');
        }
        
        $this->_compra->id_compra = $id;
        $this->_compra->elimina();
        $this->redireccionar('compra');
        
    }

}

?>
