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
        $this->_vista->datos = $this->_movimiento->selecciona();
        //print_r($this->_vista->datos);exit;
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }
    

    
    public function nuevo() {
        
        
        if ($_POST['guardar'] == 1) {
            
            $this->redireccionar('compra');
        }
        $this->_vista->datos = $this->_movimiento->selecciona();
        $this->_vista->titulo = 'Registrar Movimiento';
        $this->_vista->action = BASE_URL . 'movimiento/nuevo';
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min'));
        $this->_vista->setJs(array('funciones_form','jquery-ui.min'));
        $this->_vista->renderizar('form');
    }


    public function getActores(){
        $datos = $this->_movimiento->actores();
        echo json_encode($datos);
    }


}

?>
