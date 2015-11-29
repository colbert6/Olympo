<?php

class rutina_controlador extends controller {

    private $_rutina;
    private $_categoria_ejercicio;
    private $_socio;

    public function __construct() {
        /*if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }*/
        parent::__construct();
        $this->_rutina = $this->cargar_modelo('rutina');
        $this->_categoria_ejercicio = $this->cargar_modelo('categoria_ejercicio');
        $this->_socio = $this->cargar_modelo('socio');
    }

    public function index() {
        
    }

    public function nuevo($id) {
        
        $this->_vista->titulo = 'Registrar Rutina';
        //EXTRAER SOCIO
        $this->_socio->id_socio = $this->filtrarInt($id);
        $this->_vista->socio = $this->_socio->selecciona_id();
        //EXTRAER CATEGORIA DE EJERCICIO
        $this->_vista->categoria_ejercicio = $this->_categoria_ejercicio->selecciona();
        //ENVIAR ACCION
        $this->_vista->action = BASE_URL . 'rutina/nuevo/'.$id;
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function editar($id) {
        
        $this->_vista->titulo = 'Registrar Rutina';
        //EXTRAER SOCIO
        $this->_socio->id_socio = $this->filtrarInt($id);
        $this->_vista->socio = $this->_socio->selecciona_id();
        $this->_rutina->id_socio = $this->filtrarInt($id);;
        $this->_vista->rutina = $this->_rutina->socio_x_rutina();
        //EXTRAER CATEGORIA DE EJERCICIO
        $this->_vista->categoria_ejercicio = $this->_categoria_ejercicio->selecciona();
        //ENVIAR ACCION
        $this->_vista->action = BASE_URL . 'rutina/editar/'.$id;
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }
    
    public function eliminar($id,$fecha) {
        $this->_triaje->id_socio = $this->filtrarInt($id);
        $this->_triaje->fecha = $fecha;
        $this->_triaje->elimina();
        $this->redireccionar('triaje/historial/'.$id);
    }

    public function registrarRutina(){
        $this->_rutina->id_socio = $_POST["id_socio"];
        $this->_rutina->dia = $_POST["dia"];
        $this->_rutina->id_categoria_ejercicio = $_POST["id_categoria_ejercicio"];
        $this->_rutina->inserta();
    }

    public function rutina_dia(){
        $this->_rutina->id_socio = $_POST["id_socio"];
        $this->_rutina->dia = $_POST["dia"];
        echo json_encode($this->_rutina->rutina_x_dia());
    }
    public function eliminarRutina(){
        $this->_rutina->id_socio = $_POST["id_socio"];
        $this->_rutina->dia = $_POST["dia"];
        $this->_rutina->id_categoria_ejercicio = $_POST["id_categoria_ejercicio"];
        $this->_rutina->elimina_2();
    }
}

?>
