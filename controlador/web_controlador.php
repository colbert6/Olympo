<?php

class web_Controlador extends controller {
    
    private $_model;
    private $_servicios;
    private $_productos;
    private $_inicio;
    private $_publicidad;
    private $_evento;
    private $_contacto;
    
    public function __construct() {
        
        if($this->web_movil()){
            $this->redireccionar('movil');
        }
        
        parent::__construct();
        $this->_model = $this->cargar_modelo('informacion');
        $this->_servicios = $this->cargar_modelo('web_servicio');
        $this->_productos = $this->cargar_modelo('web_producto');
        $this->_contacto = $this->cargar_modelo('contacto');
        $this->_evento = $this->cargar_modelo('evento');
        $this->_inicio = $this->cargar_modelo('img_inicio');
        $this->_publicidad = $this->cargar_modelo('img_publicidad');
         
    }
    
    public function index() {

        $this->_vista->datos = $this->_model->selecciona();
        $this->_vista->evento = $this->_evento->selecciona();
        $this->_vista->inicio = $this->_inicio->selecciona();
        $this->_vista->publicidad = $this->_publicidad->selecciona();
        //print_r($this->_vista->evento);exit();
        $this->_vista->renderiza_web('index',false,true);
        
    }
    
    public function inicio(){
       // $this->_vista->evento = $this->_evento->selecciona();
        //print_r($this->_vista->evento);exit();
        $this->_vista->renderiza_web('inicio','inicio',true);
    }
    public function nosotros(){
        $this->_vista->datos = $this->_model->selecciona();
        
        $this->_vista->renderiza_web('nosotros','nosotros',false);
    }
    public function productos($categoria=false,$id=false){
        $this->_vista->datos_producto = $this->_productos->selecciona();

        $this->_vista->setCss(array('servicios'));
        
        $this->_vista->renderiza_web('productos','productos',false);

    }
    public function servicios(){
        
        $this->_vista->datos_servicio = $this->_servicios->selecciona();//
        $this->_vista->setCss(array('servicios'));
        $this->_vista->renderiza_web('servicios','servicios',false);
    }    
    public function contactenos(){

        
        if ($_POST['guardar'] == 1) {
            $this->_contacto->nombre = $_POST['nombre'];
            $this->_contacto->telefono = $_POST['telefono'];
            $this->_contacto->correo = $_POST['email'];
            $this->_contacto->mensaje = $_POST['mensaje'];
            $this->_contacto->fecha =  date("Y")."-".date("m")."-".date("d");//
            $datos = $this->_contacto->inserta();

          //  $this->redireccionar("web/contactenos");
        }
        $this->_vista->datos = $this->_model->selecciona();
        $this->_vista->renderiza_web('contactenos','contactenos',false);
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

