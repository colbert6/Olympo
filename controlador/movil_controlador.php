<?php

class movil_Controlador extends controller {
    
    private $_publicidad;
    private $_inicio;
    private $_model;
    private $_servicios;
    private $_productos;
    private $_evento;
    private $_contacto;

    public function __construct() {
        
       /*if(!$this->web_movil()){
            $this->redireccionar('web');
        }*/
        
        parent::__construct();
        $this->_model = $this->cargar_modelo('informacion');
        $this->_publicidad = $this->cargar_modelo('img_publicidad');
        $this->_inicio = $this->cargar_modelo('img_inicio');
        $this->_servicios = $this->cargar_modelo('web_servicio');
        $this->_productos = $this->cargar_modelo('web_producto');
        $this->_evento = $this->cargar_modelo('evento');
        $this->_contacto = $this->cargar_modelo('contacto');
 
    }
    
    public function index() {
        $this->_vista->publicidad = $this->_publicidad->selecciona();
        $this->_vista->inicio = $this->_inicio->selecciona();
        $this->_vista->renderiza_movil('index','inicio');
    }
    
    public function inicio(){
        
        $this->_vista->renderiza_movil('inicio','inicio');
    }
    public function nosotros(){
        $this->_vista->datos = $this->_model->selecciona();
        $this->_vista->renderiza_movil('nosotros','nosotros');
    }
     public function servicios(){
        $this->_vista->datos_servicio = $this->_servicios->selecciona();//
        $this->_vista->setCss(array('servicios'));
        $this->_vista->renderiza_movil('servicios','servicios');
    } 
    public function productos(){
    
        $this->_vista->datos_producto = $this->_productos->selecciona();

        $this->_vista->setCss(array('servicios'));
        
        $this->_vista->renderiza_movil('productos','productos');   
    }
    public function eventos(){
        $this->_vista->evento = $this->_evento->selecciona();
        $this->_vista->renderiza_movil('eventos','eventos');
    }
    public function contactenos(){
        if ($_POST['guardar'] == 1) {
            $this->_contacto->nombre = $_POST['nombre'];
            $this->_contacto->telefono = $_POST['telefono'];
            $this->_contacto->correo = $_POST['email'];
            $this->_contacto->mensaje = $_POST['mensaje'];
            $datos = $this->_contacto->inserta();

            $this->redireccionar("movil/contactenos");
            
        }
        $this->_vista->datos = $this->_model->selecciona();
        $this->_vista->renderiza_movil('contactenos','contactenos');
        $this->_vista->setJs_public(array('validaciones'));
    }

        
    public function login(){
        $this->_vista->renderiza_movil('login','login');
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

