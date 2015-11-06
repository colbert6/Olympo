<?php

class sesion_caja_controlador extends controller {

    private $_sesion_caja;
    private $_caja;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_sesion_caja = $this->cargar_modelo('sesion_caja');
        $this->_caja = $this->cargar_modelo('caja');
    }

    public function index() {
        $this->_vista->titulo = 'Administrar Cajas';
        $this->_vista->e_caja = $this->_sesion_caja->selecciona();
        $this->_vista->empleado = session::get('id_empleado');
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('index');
    }
    public function aperturar(){
        //$this->id_caja,$this->id_empleado,$this->fecha_entrada,$this->monto_inicio,$this->estado
        $ocupado = false;
        $sesiones = $this->_sesion_caja->cajas_activas();
        for ($i=0; $i <count($sesiones) ; $i++) { 
            if(session::get('id_empleado') == $sesiones[$i]["ID_EMPLEADO"]){
                $ocupado = true;
            }
        }
        if(!$ocupado){
            $this->_sesion_caja->id_caja = $_POST['id'];
            $this->_sesion_caja->id_empleado = session::get('id_empleado');
            $this->_sesion_caja->fecha_entrada = date("Y-m-d H:i:s");
            $this->_sesion_caja->monto_inicio = $_POST['monto'];
            $this->_sesion_caja->estado = 1;
            $this->_sesion_caja->inserta(); 
        }else{
            echo "<script>alert('Ud. ya Aperturo Una Caja');</script>";
        }
        
        //$this->redireccionar('sesion_caja');
       // header('Location: '.BASE_URL.'sesion_caja/');
    }
    public function cerrar(){
        $this->redireccionar('sesion_caja');
    }
    public function sesiones_activas(){
        $sesiones = $this->_sesion_caja->cajas_activas();
        echo json_encode($sesiones);
    }
    public function historial($id){
        $this->_caja->id_caja = $this->filtrarInt($id);
        $caja = $this->_caja->selecciona_id();
        $this->_vista->titulo = 'Lista de Sesiones => '.strtoupper($caja[0]["NOMBRE"]);
        $this->_sesion_caja->id_caja = $this->filtrarInt($id);
        $this->_vista->e_caja = $this->_sesion_caja->sesiones_caja();
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('historial');
    }
    public function nuevo() {
        if ($_POST['guardar'] == 1) {
            $this->_model->descripcion = $_POST['descripcion'];
            $datos = $this->_model->inserta();
            $this->redireccionar('sesion_caja');
        }
        $this->_vista->titulo = 'Registrar sesion_caja';
        $this->_vista->action = BASE_URL . 'sesion_caja/nuevo';
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('sesion_caja');
        }

        if ($_POST['guardar'] == 1) {
            $this->_model->id_sesion_caja = $_POST['id_sesion_caja'];
            $this->_model->descripcion = $_POST['descripcion'];
            $this->_model->actualiza();
            $this->redireccionar('sesion_caja');
        }
        $this->_model->id_sesion_caja = $this->filtrarInt($id);
        $this->_vista->datos = $this->_model->selecciona_id();
        
        $this->_vista->titulo = 'Actualizar sesion_caja';
        $this->_vista->action = BASE_URL . 'sesion_caja/editar/'.$id;
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('sesion_caja');
        }
        $this->_model->id_sesion_caja = $this->filtrarInt($id);
        $this->_model->elimina();
        $this->redireccionar('sesion_caja');
    }

}

?>
