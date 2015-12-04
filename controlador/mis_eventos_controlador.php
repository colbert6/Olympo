<?php

class mis_eventos_controlador extends controller {

    private $_model;
    private $_socio_x_evento;

    public function __construct() {
        if(!session::get('autenticado')){
            header('location:' . BASE_URL );
            exit;
        }
        parent::__construct();
        $this->_model = $this->cargar_modelo('evento');
        $this->_socio_x_evento= $this->cargar_modelo('socio_x_evento');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Eventos';
        $this->_socio_x_evento->id_socio = session::get("id_socio");   
        $this->_vista->event_part = $this->_socio_x_evento->selecciona(); 
        $this->_vista->datos = $this->_model->selecciona();
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->setJs(array('funcion'));
        $this->_vista->renderizar('index');
    }


    public function insertaSocioxEvento(){
        $this->_socio_x_evento->id_socio = $_POST["id_socio"];
        $this->_socio_x_evento->id_evento = $_POST["id_evento"];
        $this->_socio_x_evento->asistencia = '1';
        $this->_socio_x_evento->condicion = '';
        echo json_encode($this->_socio_x_evento->inserta());

    }
    public function eliminaSocioxEvento(){
        $this->_socio_x_evento->id_socio_x_evento = $_POST["id_socio_evento"];
        $this->_socio_x_evento->elimina();
    }


}

?>
