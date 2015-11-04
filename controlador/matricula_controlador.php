<?php

class matricula_controlador extends controller {

    private $_model;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_model = $this->cargar_modelo('matricula');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Membresias';
        $this->_vista->datos = $this->_model->selecciona();
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }
        
    public function nuevo() {
        //echo '<pre>'; print_r($_POST);exit;
        
        if ($_POST['guardar'] == 1) {
            $this->_model->id_socio = $_POST['id_socio'];
            $this->_model->id_tipo_membresia = $_POST['id_membresia'];
            $this->_model->fecha_registro = $_POST['fecha_registro'];
            $this->_model->precio = $_POST['precio'];;
            $datos = $this->_model->inserta();
            for($i=0;$i<count($_POST['id_servicio']);$i++){
                //usamos el modelo de matricula para el detallle enre matricula y servicios
                $this->_model->id_matricula=$dato_compra[0]['ID_MATRICULA'];
                $this->_model->id_servicio= $_POST['id_servicio'][$i];
                $this->_model->inserta_mat_serv();
            }
            
            $this->redireccionar('matricula');
        }
        $this->_vista->titulo = 'Asignar Membresia';
        $this->_vista->action = BASE_URL . 'matricula/nuevo';
        
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min'));
        $this->_vista->setJs(array('funciones_form','jquery-ui.min'));
        $this->_vista->renderizar('form');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('matricula');
        }

        if ($_POST['guardar'] == 1) {
            $this->_model->id_almacen = $_POST['id_almacen'];
            $this->_model->descripcion = $_POST['descripcion'];
            $this->_model->actualiza();
            $this->redireccionar('matricula');
        }
        $this->_model->id_almacen = $this->filtrarInt($id);
        $this->_vista->datos = $this->_model->selecciona_id();
        
        $this->_vista->titulo = 'Actualizar matricula';
        $this->_vista->action = BASE_URL . 'matricula/editar/'.$id;
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('matricula');
        }
        $this->_model->id_almacen = $this->filtrarInt($id);
        $this->_model->elimina();
        $this->redireccionar('matricula');
    }

}

?>
