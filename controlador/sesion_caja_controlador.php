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
        $this->_sesion_caja->id_caja = $_POST['id'];
        $this->_sesion_caja->id_empleado = session::get('id_empleado');
        $this->_sesion_caja->fecha_entrada = date("Y-m-d H:i:s");
        $this->_sesion_caja->monto_inicio = $_POST['monto'];
        $this->_sesion_caja->estado = 1;
        $this->_sesion_caja->inserta(); 
    }
    public function cerrar($id){
        $this->_sesion_caja->id_caja = $this->filtrarInt($id);
        $sesion_activa = $this->_sesion_caja->sesiones_caja();
        if($sesion_activa[0]["ID_EMPLEADO"]!=session::get('id_empleado')){
            echo '<script>alert("Usted No es es el Empleado que aperturo Caja")</script>';
            $this->redireccionar('sesion_caja');
        }
        $this->_sesion_caja->id_caja = $this->filtrarInt($id);
        $this->_sesion_caja->fecha_salida = date("Y-m-d H:i:s");
        $this->_sesion_caja->estado = 0;
        $this->_sesion_caja->actualiza();
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

}

?>
