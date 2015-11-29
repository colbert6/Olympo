<?php

class contacto_controlador extends controller {

    private $_contacto;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_contacto = $this->cargar_modelo('contacto');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Contacto';
        $this->_vista->datos = $this->_contacto->selecciona();
        $this->_vista->setJs(array('funcion'));
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }
    
    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('contacto');
        }
        $this->_contacto->id_contacto = $this->filtrarInt($id);
        $this->_contacto->elimina();
        $this->redireccionar('contacto');
    }

    public function ver(){
        $this->_contacto->id_contacto=$_POST['id'];
       echo json_encode($this->_contacto->selecciona_id());
       //$this->redireccionar('contacto');
    }
}

?>