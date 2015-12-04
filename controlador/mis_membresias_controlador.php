<?php

class mis_membresias_controlador extends controller {

    private $_model;

    public function __construct() {
        if(!session::get('autenticado')){
            header('location:' . BASE_URL );
            exit;
        }
        parent::__construct();
        
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Membresias';
        
        //$this->_vista->setCss_public(array('jquery.dataTables'));
        //$this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }
     
    public function nuevo() {
        
    }

    public function editar($id) {
        
    }


    public function eliminar($id) {
       
    }


}

?>
