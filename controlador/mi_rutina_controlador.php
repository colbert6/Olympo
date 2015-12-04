<?php

class mi_rutina_controlador extends controller {

    private $_categoria_ejercicio;
    private $_rutina;

    public function __construct() {
        if(!session::get('autenticado')){
            header('location:' . BASE_URL );
            exit;
        }
        parent::__construct();

        $this->_categoria_ejercicio =  $this->cargar_modelo('categoria_ejercicio');
        $this->_rutina =  $this->cargar_modelo('rutina');
    }

    public function index() {
        $this->_vista->titulo = 'Rutina de Ejercicio';
        $this->_rutina->id_socio = session::get('id_socio');
        $this->_vista->rutina = $this->_rutina->socio_x_rutina();
        $this->_vista->categoria_ejercicio = $this->_categoria_ejercicio->selecciona();
        $this->_vista->renderizar('index');
    }
        
}

?>
