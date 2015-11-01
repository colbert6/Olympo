<?php

class rutina_controlador extends controller {

    private $_rutina;
    private $_categoria_ejercicio;
    private $_socio;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_rutina = $this->cargar_modelo('rutina');
        $this->_categoria_ejercicio = $this->cargar_modelo('categoria_ejercicio');
        $this->_socio = $this->cargar_modelo('socio');
    }

    public function index() {
        
    }

    public function nuevo($id) {
        if ($_POST['guardar'] == 1) {
            $id_categoria_ejercicio = $_POST['id_categoria_ejercicio'];
            $dia = $_POST['dia'];
            $id_socio = $_POST['id_socio'];

            for ($i=0; $i < count($dia); $i++) { 
                //$this->_triaje->id_triaje =;
                $this->_rutina->id_socio = $id_socio;
                $this->_rutina->dia = $dia[$i];
                $this->_rutina->id_categoria_ejercicio = $id_categoria_ejercicio[$i];
                $this->_rutina->inserta();
            }
            $this->redireccionar('socio');
        }
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
        if ($_POST['guardar'] == 1) {
            $id_rutina = $_POST['id_rutina'];
            $id_categoria_ejercicio = $_POST['id_categoria_ejercicio'];
            $dia = $_POST['dia'];
            $id_socio = $_POST['id_socio'];

            for ($i=0; $i < count($dia); $i++) { 
                $this->_rutina->id_rutina = $id_rutina[$i];
                $this->_rutina->id_socio = $id_socio;
                $this->_rutina->dia = $dia[$i];
                $this->_rutina->id_categoria_ejercicio = $id_categoria_ejercicio[$i];
                $this->_rutina->actualiza();
            }
            $this->redireccionar('socio');
        }
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

}

?>
