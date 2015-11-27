<?php
class categoria_evento_controlador extends controller{

    private $_model;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        
        $this->_model = $this->cargar_modelo('categoria_evento');
    }
    
    public function index() {
        
        $this->_vista->datos = $this->_model->selecciona();
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->titulo = 'Lista de Categorias de Eventos';
        $this->_vista->renderizar('index');
    }
    
    public function nuevo() {
        if (@$_POST['guardar'] == 1) {
            $this->_model->descripcion = ucwords(strtolower($_POST['descripcion']));
            $this->_model->inserta();
            $this->redireccionar('categoria_evento');
        }
        $this->_vista->titulo = 'Registrar Categoria de Eventos';
        $this->_vista->action = BASE_URL . 'categoria_evento/nuevo';
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }
 
    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('categoria_evento');
        }
        
        if (@$_POST['guardar'] == 1) {
            $this->_model->id_categoria_evento = $_POST['id_categoria_evento'];
            $this->_model->descripcion = ucwords(strtolower($_POST['descripcion']));
            $this->_model->edita();
            
            $this->redireccionar('categoria_evento');
        }
        $this->_model->id_categoria_evento = $this->filtrarInt($id);
        $this->_vista->datos = $this->_model->selecciona_id();
        $this->_vista->titulo = 'Actualizar Categoria Evento';
        $this->_vista->action = BASE_URL . 'categoria_evento/editar/'.$id;
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('categoria_evento');
        }
        $this->_model->id_categoria_evento = $this->filtrarInt($id);
        $this->_model->elimina();
        $this->redireccionar('categoria_evento');
    }
    
}
?>
