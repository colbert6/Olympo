<?php

class evento_controlador extends controller {

    private $_model;
    private $_categoria_evento;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_model = $this->cargar_modelo('evento');
        $this->_categoria_evento= $this->cargar_modelo('categoria_evento');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Eventos';
        $this->_vista->datos = $this->_model->selecciona();
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }
        
    public function nuevo() {
        if ($_POST['guardar'] == 1) {

            //$this->_model->id_evento = $_POST['id_evento'];
            $this->_model->id_categoria_evento = $_POST['id_categoria_evento'];
            $this->_model->nombre = ucwords(strtolower($_POST['nombre']));
            $this->_model->descripcion = ucwords(strtolower($_POST['descripcion']));
            $this->_model->fecha_inicio = $_POST['fecha_inicio'];
            $this->_model->fecha_fin = $_POST['fecha_fin'];
            $this->_model->lugar = ucwords(strtolower($_POST['lugar']));
            $this->_model->hora_evento = $_POST['hora_evento'];
            $datos = $this->_model->inserta();
            $this->redireccionar('evento');
        }
        $this->_vista->titulo = 'Registrar Evento';
        $this->_vista->action = BASE_URL . 'evento/nuevo';
        $this->_vista->categoria_evento = $this->_categoria_evento->selecciona();
        $this->_vista->setCss_public(array('jquery-ui.custom'));
        $this->_vista->setJs_public(array('jquery-ui.min'));
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('evento');
        }

        if ($_POST['guardar'] == 1) {
            $this->_model->id_evento = $_POST['id_evento'];
            $this->_model->id_categoria_evento = $_POST['id_categoria_evento'];
            $this->_model->nombre = ucwords(strtolower($_POST['nombre']));
            $this->_model->descripcion = ucwords(strtolower($_POST['descripcion']));
            $this->_model->fecha_inicio = $_POST['fecha_inicio'];
            $this->_model->fecha_fin = $_POST['fecha_fin'];
            $this->_model->lugar = ucwords(strtolower($_POST['lugar']));
            $this->_model->hora_evento = $_POST['hora_evento'];

            $this->_model->actualiza();
            $this->redireccionar('evento');
        }


        $this->_model->id_evento = $this->filtrarInt($id);
        $this->_vista->datos = $this->_model->selecciona_id();
        //jquery-ui.min
        $this->_vista->titulo = 'Actualizar evento';
        $this->_vista->action = BASE_URL . 'evento/editar/'.$id;
        $this->_vista->categoria_evento = $this->_categoria_evento->selecciona();
        $this->_vista->setCss_public(array('jquery-ui.custom'));
        $this->_vista->setJs_public(array('jquery-ui.min'));
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('evento');
        }
        $this->_model->id_evento = $this->filtrarInt($id);
        $this->_model->elimina();
        $this->redireccionar('evento');
    }

}

?>
