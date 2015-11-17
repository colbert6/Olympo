<?php

class img_inicio_controlador extends controller {

    private $_model;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_model = $this->cargar_modelo('img_inicio');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de inicio Web';
        $this->_vista->datos = $this->_model->selecciona();
        //echo '<pre>'; print_r( $this->_vista->datos);exit;
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->setJs(array('funcion'));
        $this->_vista->renderizar('index');
    }
        
    public function nuevo() {
        $imagen = "";   
        if ($_POST['guardar'] == 1) {
//     echo "<pre>"; print_r($_FILES);exit;
        if($_FILES['archivo']['name']!=''){
        set_time_limit(0);
        $this->get_Libreria('upload' . DS . 'class.upload');
        $dir_dest = ROOT . 'lib' . DS . 'img' . DS . 'web' . DS;
        $handle = new Upload($_FILES['archivo'], 'es_ES');
        //echo "<pre>"; print_r($dir_dest);exit;
        if ($handle->uploaded) {
            $handle->file_new_name_body = 'web_' . uniqid();
            $handle->image_resize = true;
            $handle->image_x = 317;
            $handle->image_y = 152;
            $handle->Process($dir_dest);
            $imagen = $handle->file_dst_name;
            //echo "<pre>"; print_r($handle);exit;
        }else {
            die('Error al Subir Imagen');
            $this->redireccionar('img_inicio');
        }
        }
            $this->_model->titulo = $_POST['titulo'];
            $this->_model->imagen = $imagen;
            $this->_model->descripcion = $_POST['descripcion'];
            //print_r($this->_model->inserta());exit;
            //echo "<pre>"; print_r($this->_model->titulo,$this->_model->imagen,$this->_model->descripcion);exit;
            $this->_model->inserta();   
            echo "<script>alert('Informacion Guardada')</script>";
            $this->redireccionar('img_inicio');
        }
        
        $this->_vista->titulo = 'Registrar el inicio Web';
        $this->_vista->action = BASE_URL . 'img_inicio/nuevo';
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('img_inicio');
        }
        $this->_model->id = $this->filtrarInt($id);
        $datos = $this->_model->selecciona();
//        echo '<pre>';print_r($datos);exit;
        $this->_vista->datos = $datos;
        $imagen="";
        if ($_POST['guardar'] == 1) {
          //  print_r($_POST['guardar']);exit();
         //   print_r($_POST['modificar_imagen']);exit();
            if($_POST['modificar_imagen'] == 1){
                //echo '<pre>';print_r($_POST['modificar_imagen');exit;
                $this->get_Libreria('upload' . DS . 'class.upload');
                $dir_dest = ROOT . 'lib' . DS . 'img' . DS . 'web' . DS;
                $handle = new Upload($_FILES['archivo'], 'es_ES');
                if ($handle->uploaded) {
                    $handle->file_new_name_body = 'web_' . uniqid();
                    $handle->image_resize = true;
                    $handle->image_x = 317;
                    $handle->image_y = 152;
                    $handle->Process($dir_dest);
                    $imagen = $handle->file_dst_name;
                }else {
                    die('Error al Subir Imagen');
                }
            }else{
                $imagen = $_POST['imagen_existe'];
                //print_r($imagen);exit();
            }
            $this->_model->id_imagen_inicio = $_POST['id_imagen_inicio'];
            $this->_model->imagen = $imagen;
           // print_r($this->_model->imagen);exit();
            $this->_model->titulo = $_POST['titulo'];
            $this->_model->descripcion = $_POST['descripcion'];
            $this->_model->actualiza();
            echo "<script>alert('Informacion Guardada')</script>";
            $this->redireccionar('img_inicio');
        }
        
        $this->_model->id_imagen_inicio = $this->filtrarInt($id);
        $this->_vista->datos = $this->_model->selecciona_id();
        
        $this->_vista->titulo = 'Actualizar Web de  inicio';
        $this->_vista->action = BASE_URL . 'img_inicio/editar/'.$id;
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }
    
    public function ver(){
        $this->_model->id_imagen_inicio=$_POST['id'];
       echo json_encode($this->_model->selecciona_id());
    }

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('img_inicio');
        }
        $this->_model->id_imagen_inicio = $this->filtrarInt($id);
        $this->_model->elimina();
        $this->redireccionar('img_inicio');
    }

}

?>