<?php

class movil_Controlador extends controller {
    
    private $_publicidad;
    
    public function __construct() {
        
       /* if(!$this->web_movil()){
            $this->redireccionar('web');
        }*/
        
        parent::__construct();
        $this->_publicidad = $this->cargar_modelo('img_publicidad');
 
    }
    
    public function index() {
        $this->_vista->publicidad = $this->_publicidad->selecciona();
        $this->_vista->renderiza_movil('index',false,true);
    }
    
    public function inicio(){
        $this->_vista->renderiza_movil('inicio','inicio',true);
    }
    public function nosotros(){
        
        $this->_vista->renderiza_movil('nosotros','nosotros',false);
    }
    public function productos($categoria=false,$id=false){
        
        $this->_vista->categoria = $categoria; 
        $this->_vista->setCss(array('productos'));
        if(!$categoria && !$id){
            $this->_vista->datos = $this->_web_categoria_productos->getCategoria_Productos();
            $this->_vista->renderiza_movil('pro_categoria',true,'productos');
        }else if($categoria && !$id) {
            $this->_vista->datos = $this->_web_productos->getProductosxCategoria($categoria);
            $this->_vista->renderiza_movil('pro_lista',true,'productos');
        }else if($categoria && $id){
            $this->_vista->datos = $this->_web_productos->getProducto($id);
            $this->_vista->renderiza_movil('pro_detalle',true,'productos');  
        }
        
        
    }
    public function servicios($servicio=false){
        $this->_vista->informacion =$servicio;
        $this->_vista->datos_servicio = $this->_web_servicios->getServicios();
        //$this->_vista->img_servicio = $this->_web_img_servicios->getImgServicios();
        $this->_vista->setCss(array('servicios'));
        //$this->_vista->js=>setJs(array('sexylightbox','jquery.easing'));
        $this->_vista->renderiza_movil('servicios','servicios',true);
    }    
    public function contactenos(){
        $this->_vista->renderiza_movil('contactenos','contactenos',false);
    }

        
    public function fotos(){
        $this->_vista->renderiza_movil('fotos','fotos');
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

