<?php

class caja_controlador extends controller {

    private $_caja;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_caja = $this->cargar_modelo('caja');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Caja';
        $this->_vista->datos = $this->_caja->selecciona();
        $this->_vista->setJs(array('funcion'));
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }
        
    public function nuevo() {
        if (@$_POST['guardar'] == 1) {
            
            $this->_caja->nombre = ucwords(strtolower( $_POST['nombre']));
            $this->_caja->inserta();
            $this->redireccionar('caja');
        }

        $this->_vista->titulo = 'Registrar Caja';
        $this->_vista->action = BASE_URL . 'caja/nuevo';
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('caja');
        }

        if (@$_POST['guardar'] == 1) {
            $this->_caja->id_caja = $_POST['id_caja'];
            $this->_caja->nombre = ucwords(strtolower( $_POST['nombre']));
         
            $this->_caja->actualiza();
            $this->redireccionar('caja');
        }
        
        $this->_caja->id_caja = $this->filtrarInt($id);
        $this->_vista->datos = $this->_caja->selecciona_id();
        
        $this->_vista->titulo = 'Actualizar Caja';
        $this->_vista->action = BASE_URL . 'caja/editar/'.$id;
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('caja');
        }
        $this->_caja->id_caja = $this->filtrarInt($id);
        $this->_caja->elimina();
        $this->redireccionar('caja');
    }
}

?>

