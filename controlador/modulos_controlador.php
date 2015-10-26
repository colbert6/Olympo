<?php

class modulos_controlador extends controller{

    private $_modulos;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_modulos = $this->cargar_modelo('modulos');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Modulos';
        $this->_vista->datos = $this->_modulos->selecciona();
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min'));
        $this->_vista->setJs(array('run_table'));
        $this->_vista->renderizar('index');
    }
    
    public function buscador(){
        if($_POST['filtro']==0){
            $this->_modulos->descripcion=$_POST['cadena'];
            $this->_modulos->modulo_padre='';
        }else{
            $this->_modulos->descripcion='';
            $this->_modulos->modulo_padre=$_POST['cadena'];
        }
        
        echo json_encode($this->_modulos->selecciona());
    }

    public function nuevo() {
        if ($_POST['guardar'] == 1) {
            $this->_modulos->nombre = ucwords(strtolower($_POST['nombre']));
            $this->_modulos->url = strtolower($_POST['url']);
            $this->_modulos->icono = strtoupper($_POST['icono']);
            if($_POST['padre']!='0'){
                $padre = explode('/', $_POST['padre']);
                $padre = array_filter($padre);
                $this->_modulos->id_padre = array_shift($padre);
                $this->_modulos->modulo_padre = ucwords(strtolower(array_shift($padre)));
                 $this->_modulos->url = $_POST['url'];
            
            }else{
                $this->_modulos->id_padre = 0;
                $this->_modulos->modulo_padre = 'MODULO PADRE';
                 $this->_modulos->url = '#';
            
            }
            $this->_modulos->inserta();
            $this->redireccionar('modulos');
        }
        $this->_vista->modulos_padre = $this->_modulos->selecciona_padre(0);
        $this->_vista->titulo = 'Registrar Modulo';
        $this->_vista->action = BASE_URL . 'modulos/nuevo';
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('modulos');
        }
        
        $this->_modulos->id_modulo = $this->filtrarInt($id);
        
        if ($_POST['guardar'] == 1) {
            $this->_modulos->nombre = ucwords(strtolower($_POST['nombre']));
            $this->_modulos->url = strtolower($_POST['url']);
            $this->_modulos->icono = strtoupper($_POST['icono']);
            if($_POST['padre']!='0'){
                $padre = explode('/', $_POST['padre']);
                $padre = array_filter($padre);
                $this->_modulos->id_padre = array_shift($padre);
                $this->_modulos->modulo_padre = ucwords(strtolower(array_shift($padre)));
                 $this->_modulos->url = $_POST['url'];
            
            }else{
                $this->_modulos->id_padre = 0;
                $this->_modulos->modulo_padre = 'MODULO PADRE';
                 $this->_modulos->url = '#';
            
            }
            $this->_modulos->actualiza();
            $this->redireccionar('modulos');
        }
        $this->_vista->datos = $this->_modulos->selecciona_id();
        
        $this->_vista->modulos_padre = $this->_modulos->selecciona_padre(0);
        $this->_vista->titulo = 'Actualizar Modulo';
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('modulos');
        }
        $this->_modulos->idmodulo = $this->filtrarInt($id);
        $this->_modulos->elimina();
        $this->redireccionar('modulos');
    }
    
}

?>