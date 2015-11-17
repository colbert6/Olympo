<?php

class proveedor_controlador extends controller {

    private $_model;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_model = $this->cargar_modelo('proveedor');        
        $this->_ubigeo = $this->cargar_modelo('ubigeo');
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
        $this->_vista->region = $this->_ubigeo->selecciona_departamento();
        
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
        
        // SACANDO OTRAS PARTES DE UBIGEO
        $this->_ubigeo->idubigeo = $this->_vista->datos[0]["ID_UBIGEO"];
        $this->_vista->ubigeo = $this->_ubigeo->selecciona_id();

        $this->_ubigeo->codigo_region =$this->_vista->ubigeo[0]["CODIGO_REGION"];
        $this->_ubigeo->codigo_provincia =$this->_vista->ubigeo[0]["CODIGO_PROVINCIA"];
        $this->_ubigeo->codigo_distrito =$this->_vista->ubigeo[0]["CODIGO_DISTRITO"];

        
        $this->_vista->region =  $this->_ubigeo->selecciona_departamento();
        $this->_vista->provincia = $this->_ubigeo->selecciona_provincia();
        $this->_vista->distrito = $this->_ubigeo->selecciona_distrito();
        $this->_vista->tipo_socio = $this->_tipo_socio->selecciona();
        
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
    
     public function buscador(){
        if(isset($_POST['dni'])){
            $this->_model->dni=$_POST['dni'];
            echo json_encode($this->_model->selecciona_dni());
        } else{
            echo json_encode($this->_model->selecciona());
        }
        
    }

}

?>
