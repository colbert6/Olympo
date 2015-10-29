<?php

class proveedor_controlador extends controller {

    private $_model;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_model = $this->cargar_modelo('proveedor');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Proveedores';
        $this->_vista->datos = $this->_model->selecciona();
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }
        
    public function nuevo() {
        if ($_POST['guardar'] == 1) {
            
            $this->_model->razon_social = $_POST['razon_social'];
            $this->_model->ruc = $_POST['ruc'];
            $this->_model->telefono = $_POST['telefono'];
            $this->_model->email = $_POST['email'];
            $this->_model->direccion = $_POST['direccion'];
            $this->_model->id_ubigeo = $_POST['id_ubigeo'];
            $datos = $this->_model->inserta();
            $this->redireccionar('proveedor');
        }
        $this->_vista->titulo = 'Registrar Proveedor';
        $this->_vista->action = BASE_URL . 'proveedor/nuevo';
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('proveedor');
        }

        if ($_POST['guardar'] == 1) {
            $this->_model->id_proveedor = $_POST['id_proveedor'];
             $this->_model->razon_social = $_POST['razon_social'];
            $this->_model->ruc = $_POST['ruc'];
            $this->_model->telefono = $_POST['telefono'];
            $this->_model->email = $_POST['email'];
            $this->_model->direccion = $_POST['direccion'];
            $this->_model->id_ubigeo = $_POST['id_ubigeo'];
            
            $this->_model->actualiza();
            $this->redireccionar('proveedor');
        }
        $this->_model->id_proveedor = $this->filtrarInt($id);
        $this->_vista->datos = $this->_model->selecciona_id();
        
        $this->_vista->titulo = 'Actualizar Proveedor';
        $this->_vista->action = BASE_URL . 'proveedor/editar/'.$id;
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('proveedor');
        }
        $this->_model->id_proveedor = $this->filtrarInt($id);
        $this->_model->elimina();
        $this->redireccionar('proveedor');
    }

}

?>
