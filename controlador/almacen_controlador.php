<?php

class almacen_controlador extends controller {

    private $_model;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_model = $this->cargar_modelo('almacen');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Almacenes';
        $this->_vista->datos = $this->_model->selecciona();
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }
     public function mostrar($id) {

      if (!$this->filtrarInt($id)) {
            $this->redireccionar('almacen');
      
}       $this->_model->id_almacen = $this->filtrarInt($id);
        $this->_vista->datos = $this->_model->selecciona1();
        $this->_vista->titulo = 'Transito de Producto';
     
         $this->_vista->action = BASE_URL . 'almacen/mostrar/'.$id;
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('indexx');
    }  
    public function nuevo() {
        if ($_POST['guardar'] == 1) {
            $this->_model->descripcion = ucwords(strtolower( $_POST['descripcion']));
            $datos = $this->_model->inserta();
            $this->redireccionar('almacen');
        }
        $this->_vista->titulo = 'Registrar Almacen';
        $this->_vista->action = BASE_URL . 'almacen/nuevo/';
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('almacen');
        }

        if ($_POST['guardar'] == 1) {
            $this->_model->id_almacen = $_POST['id_almacen'];
            $this->_model->descripcion = ucwords(strtolower( $_POST['descripcion']));
            $this->_model->actualiza();
            $this->redireccionar('almacen');
        }
        $this->_model->id_almacen = $this->filtrarInt($id);
        $this->_vista->datos = $this->_model->selecciona_id();
        
        $this->_vista->titulo = 'Actualizar Almacen';
        $this->_vista->action = BASE_URL . 'almacen/editar/'.$id;
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }


    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('almacen');
        }
        $this->_model->id_almacen = $this->filtrarInt($id);
        $this->_model->elimina();
        $this->redireccionar('almacen');
    }


}

?>
