<?php

class mis_medidas_controlador extends controller {

    private $_model;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        
        $this->_triaje = $this->cargar_modelo('triaje');
        $this->_socio = $this->cargar_modelo('socio');
    }

    public function index() {
        //-------------------------------------------------------
        //EXTRAER SOCIO
        $this->_socio->id_socio = session::get('id_socio');
        $socio = $this->_socio->selecciona_id();
        $this->_vista->id_socio = session::get('id_socio');
        $this->_vista->titulo = 'Historial de Triajes' ;

        //-------------------------------------------------------
        //EXTRAER FECHAS DE TRIAJES
        $this->_triaje->id_socio = session::get('id_socio');
        $this->_vista->datos = $this->_triaje->fecha_socio();
        //-------------------------------------------------------
        $this->_vista->setJs(array('funcion'));
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');  
    }
     
}

?>
