<?php

class perfiles_controlador extends controller {

    private $_model;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_model = $this->cargar_modelo('perfiles');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Perfiles';
        $this->_vista->datos = $this->_perfiles->selecciona();
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }
    
    public function buscador(){
        if($_POST['filtro']==0){
            $this->_model->descripcion=$_POST['descripcion'];
        }
        echo json_encode($this->_model->selecciona());
    }
    
    public function nuevo() {
        if ($_POST['guardar'] == 1) {
            $this->_model->descripcion = $_POST['descripcion'];
            $this->_model->inserta();
            $this->redireccionar('perfiles');
        }
        $this->_vista->titulo = 'Registrar Perfil';
        $this->_vista->action = BASE_URL . 'perfiles/nuevo';
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('perfiles');
        }

        $this->_model->idperfil = $this->filtrarInt($id);
        $this->_vista->datos = $this->_perfiles->selecciona();

        if ($_POST['guardar'] == 1) {
            $this->_model->idperfil = $_POST['codigo'];
            $this->_model->descripcion = $_POST['descripcion'];
            $this->_model->actualiza();
            $this->redireccionar('perfiles');
        }
        $this->_vista->titulo = 'Actualizar Perfil';
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('perfiles');
        }
        $this->_model->idperfil = $this->filtrarInt($id);
        $this->_model->elimina();
        $this->redireccionar('perfiles');
    }

}

?>
