<?php
class categoria_producto_controlador extends controller{

    private $_model;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        
        $this->_model = $this->cargar_modelo('categoria_producto');
    }
    
    public function index() {
        
        $this->_vista->datos = $this->_model->selecciona();
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->titulo = 'Lista de Categoria de Productos';
        $this->_vista->renderizar('index');
    }
    
    public function nuevo() {
        if (@$_POST['guardar'] == 1) {
            $this->_model->descripcion = ucwords(strtolower($_POST['descripcion']));
            $this->_model->inserta();
            $this->redireccionar('categoria_producto');
        }
        $this->_vista->titulo = 'Registrar Categoria de Producto';
        $this->_vista->action = BASE_URL . 'categoria_producto/nuevo';
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }
 
    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('categoria_producto');
        }
        
        if (@$_POST['guardar'] == 1) {
            $this->_model->id_categoria_producto = $_POST['id_categoria_producto'];
            $this->_model->descripcion = ucwords(strtolower($_POST['descripcion']));
            $this->_model->edita();
            
            $this->redireccionar('categoria_producto');
        }
        $this->_model->id_categoria_producto = $this->filtrarInt($id);
        $this->_vista->datos = $this->_model->selecciona_id();
        $this->_vista->titulo = 'Actualizar Categoria de Producto';
        $this->_vista->action = BASE_URL . 'categoria_producto/editar/'.$id;
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('categoria_producto');
        }
        $this->_model->id_categoria_producto = $this->filtrarInt($id);
        $this->_model->elimina();
        $this->redireccionar('categoria_producto');
    }
    
}
?>
