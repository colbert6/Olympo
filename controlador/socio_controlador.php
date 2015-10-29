<?php

class socio_controlador extends controller {

    private $_socio;
    private $_tipo_socio;
    private $_ubigeo;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_socio = $this->cargar_modelo('socio');
        $this->_tipo_socio = $this->cargar_modelo('tipo_socio');
        $this->_ubigeo = $this->cargar_modelo('ubigeo');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Socios';
        $this->_vista->datos = $this->_socio->selecciona();
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }
        
    public function nuevo() {
        if ($_POST['guardar'] == 1) {

             //$this->_socio->id_socio = $_POST['id_socio'];
            $this->_socio->id_tipo_socio = $_POST['id_tipo_socio'];
            $this->_socio->idubigeo = 1;//$_POST['id_ubigeo'];
            $this->_socio->dni = $_POST['dni'];
            $this->_socio->aliass = $_POST['aliass'];
            $this->_socio->nombre = $_POST['nombre'];
            $this->_socio->apellido_paterno = $_POST['apellido_paterno'];
            $this->_socio->apellido_materno = $_POST['apellido_materno'];
            $this->_socio->email = $_POST['email'];
            $this->_socio->telefono = $_POST['telefono'];
            $this->_socio->celular = $_POST['celular'];
            $this->_socio->direccion = $_POST['direccion'];
            $this->_socio->fecha_nacimiento = $_POST['fecha_nacimiento'];
            $this->_socio->sexo = $_POST['sexo'];
            $this->_socio->estado_civil = $_POST['estado_civil'];
            $this->_socio->ocupacion = $_POST['ocupacion'];
           // $this->_socio->grupo_sanguineo = $_POST['grupo_sanguineo'];
           // $this->_socio->hobby = $_POST['hobby'];
           // $this->_socio->nacionalidad = $_POST['nacionalidad'];
           // $this->_socio->seguro_medico = $_POST['seguro_medico'];
          //  $this->_socio->observacion = $_POST['observacion'];
          //  $this->_socio->antecedente_medico = $_POST['antecedente_medico'];
          //  $this->_socio->codigo_postal = $_POST['codigo_postal'];
           // $this->_socio->fax = $_POST['fax'];
            $this->_socio->numero_hijo = $_POST['numero_hijo'];
            $this->_socio->sector = $_POST['sector'];
            $this->_socio->grado_estudio = $_POST['grado_estudio'];
            //$this->_socio->ingresos = $_POST['ingresos'];


            $datos = $this->_socio->inserta();
            $this->redireccionar('socio');
        }
        $this->_vista->titulo = 'Registrar socio';
        $this->_vista->action = BASE_URL . 'socio/nuevo';
        $this->_vista->tipo_socio = $this->_tipo_socio->selecciona();
        $this->_vista->regiones = $this->_ubigeo->selecciona_departamento();
        $this->_vista->setCss_public(array('jquery-ui.custom'));
        $this->_vista->setJs_public(array('jquery-ui.min'));
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('socio');
        }

        if ($_POST['guardar'] == 1) {
            $this->_socio->id_socio = $_POST['id_socio'];
            $this->_socio->id_tipo_socio = $_POST['id_tipo_socio'];
            $this->_socio->id_ubigeo = $_POST['id_ubigeo'];
            $this->_socio->dni = $_POST['dni'];
            $this->_socio->aliass = $_POST['aliass'];
            $this->_socio->nombre = $_POST['nombre'];
            $this->_socio->apellido_paterno = $_POST['apellido_paterno'];
            $this->_socio->apellido_materno = $_POST['apellido_materno'];
            $this->_socio->email = $_POST['email'];
            $this->_socio->telefono = $_POST['telefono'];
            $this->_socio->celular = $_POST['celular'];
            $this->_socio->direccion = $_POST['direccion'];
            $this->_socio->fecha_nacimiento = $_POST['fecha_nacimiento'];
            $this->_socio->sexo = $_POST['sexo'];
            $this->_socio->estado_civil = $_POST['estado_civil'];
            $this->_socio->ocupacion = $_POST['ocupacion'];
            $this->_socio->grupo_sanguineo = $_POST['grupo_sanguineo'];
            $this->_socio->hobby = $_POST['hobby'];
            $this->_socio->nacionalidad = $_POST['nacionalidad'];
            $this->_socio->seguro_medico = $_POST['seguro_medico'];
            $this->_socio->observacion = $_POST['observacion'];
            $this->_socio->antecedente_medico = $_POST['antecedente_medico'];
            $this->_socio->codigo_postal = $_POST['codigo_postal'];
            $this->_socio->fax = $_POST['fax'];
            $this->_socio->numero_hijo = $_POST['numero_hijo'];
            $this->_socio->sector = $_POST['sector'];
            $this->_socio->grado_estudio = $_POST['grado_estudio'];
            $this->_socio->ingresos = $_POST['ingresos'];

            $this->_socio->actualiza();
            $this->redireccionar('socio');
        }


        $this->_socio->id_socio = $this->filtrarInt($id);
        $this->_vista->datos = $this->_socio->selecciona_id();
        $this->_vista->tipo_socio = $this->_tipo_socio->selecciona();
        //jquery-ui.min
        $this->_vista->titulo = 'Actualizar Socio';
        $this->_vista->action = BASE_URL . 'socio/editar/'.$id;
        $this->_vista->setCss_public(array('jquery-ui.custom'));
        $this->_vista->setJs_public(array('jquery-ui.min'));
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('socio');
        }
        $this->_socio->id_socio = $this->filtrarInt($id);
        $this->_socio->elimina();
        $this->redireccionar('socio');
    }

    public function get_provincias() {

        $this->_ubigeo->codigo_region = $_REQUEST['codigo_region'];
        echo json_encode($this->_ubigeo->selecciona_provincia());
    }

    public function get_ciudades() {
        $this->_ubigeo->codigo_region = $_REQUEST['codigo_region'];
        $this->_ubigeo->codigo_provincia = $_REQUEST ['codigo_provincia'];
        echo json_encode($this->_ubigeo->selecciona_distrito());
    }

}

?>
