<?php

class reglamento_controlador extends controller {

    
    public function __construct() {
        if(!session::get('autenticado')){
            header('location:' . BASE_URL );
            exit;
        }
        parent::__construct();
        
    }

    public function index() {
        $this->_vista->titulo = 'Reglamento OLYMPO GYM';
        $this->_vista->renderizar('index');
    }

            
}

?>
