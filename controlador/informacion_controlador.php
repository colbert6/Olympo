<?php

class informacion_controlador extends controller {
    
    private $_model;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_informacion = $this->cargar_modelo('informacion');
    }

    public function index() {
        $this->_vista->titulo = 'Información de la Empresa';
        //$this->_vista->setJs(array('js'));
        $this->_vista->datos = $this->_informacion->selecciona();
        $this->_vista->renderizar('index');
    }
    
    public function editar(){
        $this->_vista->datos = $this->_informacion->selecciona();
        if ($_POST['guardar'] == 1) {
            
            $this->_informacion->razon = ucwords(strtolower($_POST['razon_social']));
            $this->_informacion->ruc = $_POST['ruc'];
            $this->_informacion->telefono = $_POST['telefono'];
            $this->_informacion->direccion = $_POST['direccion'];
            $this->_informacion->celular = $_POST['celular'];
            $this->_informacion->mision = $_POST['mision'];
            $this->_informacion->vision = $_POST['vision'];
            $this->_informacion->historia = $_POST['historia'];
            $this->_informacion->inserta();
            echo "<script>alert('Datos Guardados');</script>";
            $this->redireccionar('informacion');
        }
        $this->_vista->titulo = 'Actualizar Datos de la Empresa';
        $this->_vista->action = BASE_URL . 'informacion/editar';
        $this->_vista->setJs(array('formjs'));
        $this->_vista->renderizar('form');
    }
    
    
    
}
?>
