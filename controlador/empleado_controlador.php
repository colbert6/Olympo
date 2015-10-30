<?php

class empleado_controlador extends controller {

    private $_model;
    private $_model_1;
    private $_model_2;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_model = $this->cargar_modelo('empleado');
        $this->_model_1 = $this->cargar_modelo('categoria_empleado');
        $this->_model_2 = $this->cargar_modelo('perfiles');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Empleado';
        $this->_vista->datos = $this->_model->selecciona();
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }
        
    public function nuevo() {
        if ($_POST['guardar'] == 1) {
            $this->_empleado->id_categoria_empleado = $_POST['id_categoria_empleado'];//36
            $this->_empleado->nombre = $_POST['nombre'];//37
            $this->_empleado->apellido_paterno = $_POST['apellido_paterno'];//38
            $this->_empleado->apellido_materno = $_POST['apellido_materno'];//39
            $this->_empleado->dni = $_POST['dni'];//40
            $this->_empleado->email = $_POST['email'];//41
            $this->_empleado->telefono = $_POST['telefono'];//42
            $this->_empleado->celular = $_POST['celular'];//43
            $this->_empleado->sexo = $_POST['sexo'];//44
            $this->_empleado->direccion = $_POST['direccion'];//45
            $this->_empleado->fecha_nacimiento = $_POST['fecha_nacimiento'];//46
            $this->_empleado->estado_civil = $_POST['estado_civil'];//47
            $this->_empleado->grupo_sanguineo = $_POST['grupo_sanguineo'];//48
            $this->_empleado->hobby = $_POST['hobby'];//49
            $this->_empleado->alias = $_POST['aliass'];//50
            $this->_empleado->nacionalidad = $_POST['nacionalidad'];//51
            $this->_empleado->seguro_medico = $_POST['seguro_medico'];//52
            $this->_empleado->observacion = $_POST['observacion'];//53
            $this->_empleado->antecedente_medico = $_POST['antecedente_medico'];//54
            $this->_empleado->codigo_postal = $_POST['codigo_postal'];//55
            $this->_empleado->numero_hijo = $_POST['numero_hijo'];//56
            $this->_empleado->sector = $_POST['sector'];//57
            $this->_empleado->grado_estudio = $_POST['grado_estudio'];//58
            $this->_empleado->tipo_vivienda = $_POST['tipo_vivienda'];//59
            $this->_empleado->anio_contratacion = $_POST['anio_contratacion'];//60
            $this->_empleado->usuario = $_POST['usuario'];//61
            $this->_empleado->clave = $_POST['clave'];//62
            $this->_empleado->id_perfil_usuario = $_POST['id_perfil_usuario'];//63
            $this->_model->inserta();
            $this->redireccionar('empleado');
        }
        $this->_vista->datos_1 = $this->_model_1->selecciona();
        $this->_vista->titulo = 'Registrar Empleado';
        $this->_vista->action = BASE_URL . 'empleado/nuevo';
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('empleado');
        }

        if ($_POST['guardar'] == 1) {
            $this->_model->id_concepto_movimiento = $_POST['id_concepto_movimiento'];
            $this->_model->id_tipo_movimiento = $_POST['id_tipo_movimiento'];
            $this->_model->descripcion = $_POST['descripcion'];
            $this->_model->actualiza();
            $this->redireccionar('empleado');
        }
        $this->_vista->datos_1 = $this->_model_1->selecciona();
        $this->_model->id_empleado = $this->filtrarInt($id);
        $this->_vista->datos = $this->_model->selecciona_id();
        
        $this->_vista->titulo = 'Actualizar Empleado';
        $this->_vista->action = BASE_URL . 'empleado/editar/'.$id;
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('empleado');
        }
        $this->_model->id_empleado = $this->filtrarInt($id);
        $this->_model->elimina();
        $this->redireccionar('empleado');
    }

}

?>