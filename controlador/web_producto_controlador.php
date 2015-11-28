<?php

class web_producto_controlador extends controller {

    private $_model;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_model = $this->cargar_modelo('web_producto');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Productos Web';
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
        $dir_dest = ROOT . 'lib' . DS . 'img' . DS . 'producto' . DS;
        $dir_dest_movil = ROOT . 'lib' . DS . 'img' . DS . 'web_movil' . DS ."producto" . DS;
        $handle = new Upload($_FILES['archivo'], 'es_ES');
        $handle_movil = new Upload($_FILES['archivo'], 'es_ES');
        //echo "<pre>"; print_r($dir_dest);exit;
        if ($handle->uploaded) {
            $handle->file_new_name_body = 'producto_' . uniqid();
            $handle->image_resize = true;
            $handle->image_x = 350;//
            $handle->image_y = 270;//
            $handle->Process($dir_dest);
            $imagen = $handle->file_dst_name;

            //MOVIL
            $handle_movil->file_new_name_body = substr($imagen, 0, -4); ;
            $handle_movil->image_resize = true;
            $handle_movil->image_x = 740;
            $handle_movil->image_y = 450;
            $handle_movil->Process($dir_dest_movil);
            //echo "<pre>"; print_r($handle);exit;
        }else {
            die('Error al Subir Imagen');
            $this->redireccionar('web_producto');
        }
        }
            $this->_model->titulo = ucwords(strtolower($_POST['titulo']));
            $this->_model->imagen = $imagen;
            $this->_model->descripcion = $_POST['descripcion'];
            //print_r($this->_model->inserta());exit;
            //echo "<pre>"; print_r($this->_model->titulo,$this->_model->imagen,$this->_model->descripcion);exit;
            $this->_model->inserta();   
            echo "<script>alert('Informacion Guardada')</script>";
            $this->redireccionar('web_producto');
        }
        
        $this->_vista->titulo = 'Registrar el Producto Web';
        $this->_vista->action = BASE_URL . 'web_producto/nuevo';
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('web_producto');
        }
        $this->_model->id = $this->filtrarInt($id);
        $datos = $this->_model->selecciona();
//        echo '<pre>';print_r($datos);exit;
        $this->_vista->datos = $datos;
        $imagen="";
        //print_r($_POST['guardar']);exit();
        if ($_POST['guardar'] == 1) {
           
          //print_r($_POST['modificar_imagen']);exit();
            if($_POST['modificar_imagen'] == 1){
                //echo '<pre>';print_r($_POST['modificar_imagen');exit;
                $this->_model->id_web_producto = $this->filtrarInt($id);
                $datos_img = $this->_model->selecciona_id();
                $imagen = $datos_img[0]["IMAGEN"];
                $dir_dest = ROOT . 'lib' . DS . 'img' . DS . 'producto' . DS;
                $dir_dest_movil = ROOT . 'lib' . DS . 'img' . DS . 'web_movil' . DS ."producto" . DS;
                unlink($dir_dest.$imagen);
                unlink($dir_dest_movil.$imagen);

                $this->get_Libreria('upload' . DS . 'class.upload');
            
                $handle = new Upload($_FILES['archivo'], 'es_ES');
                $handle_movil = new Upload($_FILES['archivo'], 'es_ES');

                if ($handle->uploaded) {
                    $handle->file_new_name_body = 'producto_' . uniqid();
                    $handle->image_resize = true;
                    $handle->image_x = 350;
                    $handle->image_y = 270;
                    $handle->Process($dir_dest);
                    $imagen = $handle->file_dst_name;

                    //MOVIL
                    $handle_movil->file_new_name_body = substr($imagen, 0, -4); ;
                    $handle_movil->image_resize = true;
                    $handle_movil->image_x = 740;
                    $handle_movil->image_y = 450;
                    $handle_movil->Process($dir_dest_movil);
                  //  print_r($imagen);exit();
                }else {
                    die('Error al Subir Imagen');
                }
            }else{
                $imagen = $_POST['imagen_existe'];
               // print_r($imagen);exit();
            }

            $this->_model->id_web_producto = $_POST['id_web_producto'];
            $this->_model->imagen = $imagen;
           // print_r($this->_model->imagen);exit();
            $this->_model->titulo = ucwords(strtolower($_POST['titulo']));
            $this->_model->descripcion = $_POST['descripcion'];
            $this->_model->actualiza();
            echo "<script>alert('Informacion Guardada')</script>";
            $this->redireccionar('web_producto');
        }
        
        $this->_model->id_web_producto = $this->filtrarInt($id);
        $this->_vista->datos = $this->_model->selecciona_id();
        
        $this->_vista->titulo = 'Actualizar Web de  Producto';
        $this->_vista->action = BASE_URL . 'web_producto/editar/'.$id;
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('form');
    }
    
    public function ver(){
        $this->_model->id_web_producto=$_POST['id'];
       echo json_encode($this->_model->selecciona_id());
    }

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('web_producto');
        }
        //ELIMINADO FISICO DE LA IMAGEN  
        $this->_model->id_web_producto = $this->filtrarInt($id);
        $datos_img = $this->_model->selecciona_id();
        $imagen = $datos_img[0]["IMAGEN"];
        $dir_dest = ROOT . 'lib' . DS . 'img' . DS . 'producto' . DS;
        $dir_dest_movil = ROOT . 'lib' . DS . 'img' . DS . 'web_movil' . DS ."producto" . DS;
        unlink($dir_dest.$imagen);
        unlink($dir_dest_movil.$imagen);

        $this->_model->id_web_producto = $this->filtrarInt($id);
        $this->_model->elimina();
        $this->redireccionar('web_producto');
    }

}

?>