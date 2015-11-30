<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */
class inicio_controlador extends controller {
    function __construct() {
    //llamamos al metodo constructor de la clase padre
        parent::__construct();
    }
    function index() {
        
        if(session::get('autenticado')){
            if($this->web_movil()){
                $this->redireccionar('movil/sistema_movil/sistema');
            }
           
            $this->_vista->renderizar('index');

        }
        else{
            if($this->web_movil()){
                $this->redireccionar('movil/login/');
            }
           
            header('location:' . BASE_URL );
            exit;
        }
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