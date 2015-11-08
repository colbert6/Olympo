<?php

class web_Controlador extends controller {
    
    private $_model;
    private $_servicios;
    private $_productos;
    
    public function __construct() {
        
        if($this->web_movil()){
            $this->redireccionar('movil');
        }
        
        parent::__construct();
        $this->_model = $this->cargar_modelo('informacion');
        $this->_servicios = $this->cargar_modelo('web_servicio');
        $this->_productos = $this->cargar_modelo('web_producto');
        $this->_contacto = $this->cargar_modelo('contacto');//
        /*$this->_web_img_servicios = $this->loadModel('imagen_servicio');
        $this->_web_categoria_productos =  $this->loadModel('cat_producto');
        $this->_web_productos = $this->loadModel('producto');
      */  
        //$this->$_datos_olympo = $this->loadModel('articulos');
 
    }
    
    public function index() {
        $this->_vista->renderiza_web('index',false,true);
        
    }
    
    public function inicio(){
        $this->_vista->renderiza_web('inicio','inicio',true);
    }
    public function nosotros(){
        $this->_vista->datos = $this->_model->selecciona();
        
        $this->_vista->renderiza_web('nosotros','nosotros',false);
    }
    public function productos($categoria=false,$id=false){
        $this->_vista->datos_producto = $this->_productos->selecciona();

        //$this->_vista->setCss(array('productos'));
        
        $this->_vista->renderiza_web('productos','productos',true); 
        /*
        $this->_vista->categoria = $categoria; 
        $this->_vista->setCss(array('productos'));
        if(!$categoria && !$id){
            $this->_vista->datos = $this->_web_categoria_productos->getCategoria_Productos();
            $this->_vista->renderiza_web('pro_categoria',true,'productos');
        }else if($categoria && !$id) {
            $this->_vista->datos = $this->_web_productos->getProductosxCategoria($categoria);
            $this->_vista->renderiza_web('pro_lista',true,'productos');
        }else if($categoria && $id){
            $this->_vista->datos = $this->_web_productos->getProducto($id);
            $this->_vista->renderiza_web('pro_detalle',true,'productos');  
        }
        
        */
    }
    public function servicios($servicio=false){
        
        $this->_vista->datos_servicio = $this->_servicios->selecciona();//
        
        $this->_vista->renderiza_web('servicios','servicios',true);
    }    
    public function contactenos(){
        $this->_vista->datos = $this->_model->selecciona();
        $this->_vista->renderiza_web('contactenos','contactenos',false);
        if ($_POST['guardar'] == 1) {
            $this->_contacto->nombre = $_POST['nombre'];
            $this->_contacto->telefono = $_POST['telefono'];
            $this->_contacto->email = $_POST['email'];
            $this->_contacto->mensaje = $_POST['mensaje'];
            $datos = $this->_contacto->inserta();
            //$this->redireccionar('almacen');
        }
    }

        
    public function fotos(){
        $this->_vista->renderiza_web('fotos','fotos');
    }
        
     public function web_movil() {
         
         $detect = new Mobile_Detect();
        
            if ($detect->isAndroidtablet() || $detect->isIpad() || $detect->isBlackberrytablet() ) {
                return true;
            } elseif( $detect->isAndroid() ) {
                return true;
            } elseif ( $detect->isIphone() ) {
               return true;
            } elseif ( $detect->isMobile() ) {
                return true;
            } 
            return false;
           
    }
    
}

?>

