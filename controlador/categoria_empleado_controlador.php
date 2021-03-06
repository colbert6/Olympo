<?php

class categoria_empleado_controlador extends controller {

    private $_model;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_model = $this->cargar_modelo('categoria_empleado');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Categorias de Empleados';
        $this->_vista->datos = $this->_model->selecciona();
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }
        
    public function nuevo() {
        if ($_POST['guardar'] == 1) {
            $this->_model->descripcion = ucwords(strtolower($_POST['descripcion']));
            $datos = $this->_model->inserta();
            $this->redireccionar('categoria_empleado');
        }
        $this->_vista->titulo = 'Registrar Categoria de Empleado';
        $this->_vista->action = BASE_URL . 'categoria_empleado/nuevo';
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('categoria_empleado');
        }

        if ($_POST['guardar'] == 1) {
            $this->_model->id_categoria_empleado = $_POST['id_categoria_empleado'];
            $this->_model->descripcion = ucwords(strtolower($_POST['descripcion']));
            $this->_model->actualiza();
            $this->redireccionar('categoria_empleado');
        }
        $this->_model->id_categoria_empleado = $this->filtrarInt($id);
        $this->_vista->datos = $this->_model->selecciona_id();
        
        $this->_vista->titulo = 'Actualizar Categoria de Empleado';
        $this->_vista->action = BASE_URL . 'categoria_empleado/editar/'.$id;
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('categoria_empleado');
        }
        $this->_model->id_categoria_empleado = $this->filtrarInt($id);
        $this->_model->elimina();
        $this->redireccionar('categoria_empleado');
    }

}

?>
