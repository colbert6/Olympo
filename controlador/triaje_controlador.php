<?php

class triaje_controlador extends controller {

    private $_triaje;
    private $_concepto_triaje;
    private $_socio;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_triaje = $this->cargar_modelo('triaje');
        $this->_concepto_triaje = $this->cargar_modelo('concepto_triaje');
        $this->_socio = $this->cargar_modelo('socio');
    }

    public function index() {
        /*$this->_vista->titulo = 'Lista de Almacenes';
        $this->_vista->datos = $this->_model->selecciona();
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');*/
    }
        
    public function nuevo($id) {
        if ($_POST['guardar'] == 1) {
            $id_concepto_triaje = $_POST['id_concepto_triaje'];
            $valor = $_POST['valor'];
            $unidad_medida = $_POST['unidad_medida'];
            $fecha = $_POST['fecha'];
            $id_socio = $_POST['id_socio'];

            for ($i=0; $i < count($id_concepto_triaje); $i++) { 
                //$this->_triaje->id_triaje =;
                $this->_triaje->id_socio = $id_socio;
                $this->_triaje->id_concepto_triaje = $id_concepto_triaje[$i];
                $this->_triaje->unidad_medida = $unidad_medida[$i];
                $this->_triaje->valor = $valor[$i];
                $this->_triaje->fecha = $fecha;
                $this->_triaje->inserta();

            }
            
            $this->redireccionar('socio');
        }
        $this->_vista->id_socio = $id;
        $this->_vista->titulo = 'Registrar Triaje';
        //EXTRAER SOCIO
        $this->_socio->id_socio = $this->filtrarInt($id);
        $this->_vista->socio = $this->_socio->selecciona_id();
        //EXTRAER CONCEPTO DE TRIAJE
        $this->_vista->concepto_triaje = $this->_concepto_triaje->selecciona();
        //ENVIAR ACCION
        $this->_vista->action = BASE_URL . 'triaje/nuevo/'.$id;
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function editar($id) {
        if ($_POST['guardar'] == 1) {
            $id_triaje = $_POST['id_triaje'];
            $id_concepto_triaje = $_POST['id_concepto_triaje'];
            $valor = $_POST['valor'];
            $unidad_medida = $_POST['unidad_medida'];
            $fecha = $_POST['fecha'];
            $id_socio = $_POST['id_socio'];

            for ($i=0; $i < count($id_concepto_triaje); $i++) { 
                $this->_triaje->id_triaje = $id_triaje[$i];
                $this->_triaje->id_socio = $id_socio;
                $this->_triaje->id_concepto_triaje = $id_concepto_triaje[$i];
                $this->_triaje->unidad_medida = $unidad_medida[$i];
                $this->_triaje->valor = $valor[$i];
                $this->_triaje->fecha = $fecha;
                $this->_triaje->actualiza();

            }
            
            $this->redireccionar('socio');
        }
        $this->_vista->titulo = 'Actualizar Triaje';
        //EXTRAER SOCIO
        $this->_socio->id_socio = $this->filtrarInt($id);
        $this->_vista->socio = $this->_socio->selecciona_id();
        //EXTRAER TRIAJE
        $this->_triaje->id_socio = $this->filtrarInt($id);
        $this->_vista->utriaje = $this->_triaje->ultimo_triaje();
        //EXTRAER CONCEPTO DE TRIAJE
        $this->_vista->concepto_triaje = $this->_concepto_triaje->selecciona();
        //ENVIAR ACCION
        $this->_vista->action = BASE_URL . 'triaje/editar/'.$id;
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    /*public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('almacen');
        }
        $this->_model->id_almacen = $this->filtrarInt($id);
        $this->_model->elimina();
        $this->redireccionar('almacen');
    }*/

}

?>
