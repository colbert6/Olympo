<?php

class img_publicidad_controlador extends controller {

    private $_model;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_model = $this->cargar_modelo('img_publicidad');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Publicidad Web';
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
        $dir_dest_movil = ROOT . 'lib' . DS . 'img' . DS . 'web_movil' . DS . 'web' . DS;
        $handle = new Upload($_FILES['archivo'], 'es_ES');
        $handle_movil = new Upload($_FILES['archivo'], 'es_ES');
        //echo "<pre>"; print_r($dir_dest);exit;
        if ($handle->uploaded) {
            //WEB
            $handle->file_new_name_body = 'web_' . uniqid();
            $handle->image_resize = true;
            $handle->image_x = 800;
            $handle->image_y = 300;
            $handle->Process($dir_dest);
            $imagen = $handle->file_dst_name;
            //MOVIL
            
            $handle_movil->file_new_name_body = substr($imagen, 0,-4);
            $handle_movil->image_resize = true;
            $handle_movil->image_x = 1480;
            $handle_movil->image_y = 900;
            $handle_movil->Process($dir_dest_movil);
            $handle_movil->file_dst_name;
        //    echo "<pre>"; print_r($imagen);exit;
        }else {
            die('Error al Subir Imagen');
            $this->redireccionar('img_publicidad');
        }
        }
            $this->_model->nombre = ucwords(strtolower($_POST['nombre']));
            $this->_model->imagen = $imagen;
            //print_r($this->_model->inserta());exit;
            //echo "<pre>"; print_r($this->_model->titulo,$this->_model->imagen,$this->_model->descripcion);exit;
            $this->_model->inserta();   
            echo "<script>alert('Informacion Guardada')</script>";
            $this->redireccionar('img_publicidad');
        }
        
        $this->_vista->titulo = 'Registrar el Web';
        $this->_vista->action = BASE_URL . 'img_publicidad/nuevo';
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('img_publicidad');
        }
        $this->_model->id = $this->filtrarInt($id);
        $datos = $this->_model->selecciona();
//   echo '<pre>';print_r($datos);exit;
        $this->_vista->datos = $datos;
        $imagen="";
        if ($_POST['guardar'] == 1) {
          //  print_r($_POST['guardar']);exit();
         //   print_r($_POST['modificar_imagen']);exit();
            if($_POST['modificar_imagen'] == 1){
                //echo '<pre>';print_r($_POST['modificar_imagen');exit;
                $this->_model->id_img_publicidad = $this->filtrarInt($id);
                $datos_img = $this->_model->selecciona_id();
                $imagen2 = $datos_img[0]["IMAGEN"];
                $dir_dest = ROOT . 'lib' . DS . 'img' . DS . 'web' . DS;
                $dir_dest_movil = ROOT . 'lib' . DS . 'img' . DS . 'web_movil' . DS . 'web' . DS;
                
                unlink($dir_dest.$imagen2);unlink($dir_dest_movil.$imagen2);

                $this->get_Libreria('upload' . DS . 'class.upload');

                $handle = new Upload($_FILES['archivo'], 'es_ES');
                $handle_movil = new Upload($_FILES['archivo'], 'es_ES');
                if ($handle->uploaded) {
                    $handle->file_new_name_body = 'web_' . uniqid();
                    $handle->image_resize = true;
                    $handle->image_x = 800;
                    $handle->image_y = 300;
                    $handle->Process($dir_dest);
                    $imagen = $handle->file_dst_name;

                    $handle_movil->file_new_name_body = substr($imagen, 0,-4);
                    $handle_movil->image_resize = true;
                    $handle_movil->image_x = 1480;
                    $handle_movil->image_y = 900;
                    $handle_movil->Process($dir_dest_movil);
                    $handle_movil->file_dst_name;
                }else {
                    die('Error al Subir Imagen');
                }
            }else{
                $imagen = $_POST['imagen_existe'];
                //print_r($imagen);exit();
            }
            $this->_model->id_img_publicidad = $_POST['id_img_publicidad'];
            $this->_model->imagen = $imagen;
           // print_r($this->_model->imagen);exit();
            $this->_model->nombre = ucwords(strtolower($_POST['nombre']));
           // print($this->_model->nombre);exit();
            $this->_model->actualiza();

            echo "<script>alert('Informacion Guardada')</script>";
            $this->redireccionar('img_publicidad');
        }
        
        $this->_model->id_img_publicidad = $this->filtrarInt($id);
        $this->_vista->datos = $this->_model->selecciona_id();
        
        $this->_vista->titulo = 'Actualizar publicidad web';
        $this->_vista->action = BASE_URL . 'img_publicidad/editar/'.$id;
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }
    
    public function ver(){
        $this->_model->id_img_publicidad=$_POST['id'];
       echo json_encode($this->_model->selecciona_id());
    }

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('img_publicidad');
        }
        //ELIMINAR DE IMG
        $this->_model->id_img_publicidad = $this->filtrarInt($id);
        $datos_img = $this->_model->selecciona_id();
        $imagen = $datos_img[0]["IMAGEN"];
        $dir_dest = ROOT . 'lib' . DS . 'img' . DS . 'web' . DS;
        $dir_dest_movil = ROOT . 'lib' . DS . 'img' . DS . 'web_movil' . DS . 'web' . DS;
        //echo $dir_dest.$imagen;
        unlink($dir_dest.$imagen);unlink($dir_dest_movil.$imagen);
        //ELIMINADO DE LA BASE DE DATOS
        $this->_model->id_img_publicidad = $this->filtrarInt($id);
        $this->_model->elimina();
        $this->redireccionar('img_publicidad');
    }

}

?>