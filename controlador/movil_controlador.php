<?php

class movil_Controlador extends controller {
    
    private $_publicidad;
    private $_inicio;
    private $_model;
    private $_servicios;
    private $_productos;
    private $_evento;
    private $_contacto;
    private $_sesion_caja;
    private $_categoria_ejercicio;
    private $_rutina;
    private $_socio_x_evento;
    private $_matricula;

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
        $this->_sesion_caja = $this->cargar_modelo('sesion_caja');
        $this->_categoria_ejercicio =  $this->cargar_modelo('categoria_ejercicio');
        $this->_rutina =  $this->cargar_modelo('rutina');
        $this->_triaje = $this->cargar_modelo('triaje');
        $this->_concepto_triaje = $this->cargar_modelo('concepto_triaje');
        $this->_socio = $this->cargar_modelo('socio');
        $this->_socio_x_evento= $this->cargar_modelo('socio_x_evento');
        $this->_matricula = $this->cargar_modelo('matricula');
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
        $this->_vista->action = BASE_URL . 'login/';
        $this->_vista->renderiza_movil('login','login');
    }

    public function sistema_movil($metodo,$id=false){
        if(session::get('autenticado')){
            if($metodo=='sistema'){
                $this->_vista->renderiza_movil('sistema');    
            }else if($metodo=='saldo_cajas'){
                $this->_vista->e_caja = $this->_sesion_caja->selecciona();
                $this->_vista->renderiza_movil('saldo_cajas');
            }else if($metodo=='reglamento'){
                $this->_vista->renderiza_movil('reglamento');
            }else if($metodo=='mi_rutina'){
                $this->_rutina->id_socio = session::get('id_socio');
                $this->_vista->rutina = $this->_rutina->socio_x_rutina();
                $this->_vista->categoria_ejercicio = $this->_categoria_ejercicio->selecciona();
                $this->_vista->renderiza_movil('mi_rutina');
            }else if($metodo=='mis_medidas'){
               //EXTRAER SOCIO
                $this->_socio->id_socio = session::get('id_socio');
                $this->_vista->socio = $this->_socio->selecciona_id();
                //EXTRAER TRIAJE
                $this->_triaje->id_socio = session::get('id_socio');
                $this->_vista->utriaje = $this->_triaje->ultimo_triaje();
                //EXTRAER CONCEPTO DE TRIAJE
                $this->_vista->concepto_triaje = $this->_concepto_triaje->selecciona();
                
                $this->_vista->renderiza_movil('mis_medidas');
            }else if($metodo=='mis_eventos'){
                $this->_socio_x_evento->id_socio = session::get("id_socio");   
                $this->_vista->event_part = $this->_socio_x_evento->selecciona(); 
                $this->_vista->evento = $this->_evento->selecciona();
                $this->_vista->renderiza_movil('mis_eventos');
            }else if($metodo=='mis_membresias'){
               $this->_matricula->id_socio = session::get('id_socio');
                $this->_vista->matricula = $this->_matricula->membresiasxsocio();
                $this->_vista->renderiza_movil('mis_membresias');
            }else if($metodo=='det_memb'){
                $this->_matricula->id_matricula = $this->filtrarInt($id);
                $this->_vista->det_matricula = $this->_matricula->selecciona_id();
                $this->_vista->serv_x_matricula = $this->_matricula->servicioxmatricula();
                
                $this->_vista->renderiza_movil('det_memb');
            }
                
        }else{
            $this->redireccionar('movil/login');
        }
    }
        
     public function web_movil() {
         
         $detect = new Mobile_Detect();
        
            if ($detect->isAndroidtablet() || $detect->isIpad() || $detect->isBlackberrytablet()) {
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

