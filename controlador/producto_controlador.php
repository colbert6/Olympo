<?php

class producto_controlador extends controller {

    private $_model;
    private $_marcas;
    private $_cat_productos;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_model = $this->cargar_modelo('producto');
        $this->_marcas = $this->cargar_modelo('marca');
        $this->_cat_productos = $this->cargar_modelo('categoria_producto');
    }
    public function index() {
        $this->_vista->titulo = 'Lista de Productos';
        $this->_vista->datos = $this->_model->selecciona();
        //print_r($this->_vista->datos);exit;
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }   
    public function nuevo() {
        if ($_POST['guardar'] == 1) {
            echo '<pre>';print_r($_POST);exit;
            $this->_model->id_marca = $_POST['id_marca'];
            $this->_model->id_categoria_producto = $_POST['id_categoria_producto'];
            $this->_model->nombre = $_POST['nombre'];
            $this->_model->presentacion = $_POST['presentacion'];
            $this->_model->precio = $_POST['precio'];
            $this->_model->stock_max = $_POST['stock_max'];
            $this->_model->stock_min = $_POST['stock_min'];
            $datos = $this->_model->inserta();
            $this->redireccionar('producto');
        }
        $this->_vista->marcas = $this->_marcas->selecciona();
        $this->_vista->cat_productos = $this->_cat_productos->selecciona();
        
        $this->_vista->titulo = 'Registrar Producto';
        $this->_vista->action = BASE_URL . 'producto/nuevo';
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }
    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('producto');
        }

        if ($_POST['guardar'] == 1) {
            $this->_model->id_producto = $_POST['id_producto'];
            $this->_model->id_marca = $_POST['id_marca'];
            $this->_model->id_categoria_producto = $_POST['id_categoria_producto'];
            $this->_model->nombre = $_POST['nombre'];
            $this->_model->presentacion = $_POST['presentacion'];
            $this->_model->precio = $_POST['precio'];
            $this->_model->stock_max = $_POST['stock_max'];
            $this->_model->stock_min = $_POST['stock_min'];
            $this->_model->actualiza();
            $this->redireccionar('producto');
        }
        $this->_vista->marcas = $this->_marcas->selecciona();
        $this->_vista->cat_productos = $this->_cat_productos->selecciona();
        
        $this->_model->id_producto = $this->filtrarInt($id);
        $this->_vista->datos = $this->_model->selecciona_id();
        
        $this->_vista->titulo = 'Actualizar Producto';
        $this->_vista->action = BASE_URL . 'producto/editar/'.$id;
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }
    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('producto');
        }
        $this->_model->id_producto = $this->filtrarInt($id);
        $this->_model->elimina();
        $this->redireccionar('producto');
    }          
    public function buscador(){
        if (isset($_POST['id_almacen'])){
            $this->_model->id_almacen = $_POST['id_almacen'];
            $datos=$this->_model->selecciona_almacen();
        }else{
            $datos=$this->_model->selecciona();
        }
        
        echo json_encode($datos);
    }


}

?>
