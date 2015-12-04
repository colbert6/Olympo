<?php

class mis_membresias_controlador extends controller {

    private $_matricula;

    public function __construct() {
        if(!session::get('autenticado')){
            header('location:' . BASE_URL );
            exit;
        }
        parent::__construct();
        $this->_matricula = $this->cargar_modelo('matricula');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Membresias';
        $this->_matricula->id_socio = session::get('id_socio');
        $this->_vista->matricula = $this->_matricula->membresiasxsocio();
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }
     
    public function detalle($id) {
        $this->_vista->titulo = 'Detalle de Membresia';
        $this->_matricula->id_matricula = $this->filtrarInt($id);
        $this->_vista->det_matricula = $this->_matricula->selecciona_id();
        $this->_vista->serv_x_matricula = $this->_matricula->servicioxmatricula();
        //MOSTRAR LOS SERVICIOS ADQUIRIDOS
        $this->_vista->renderizar('detalle');
    }

    public function editar($id) {
        
    }


    public function eliminar($id) {
       
    }


}

?>
