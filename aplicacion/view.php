<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class view {

    //put your code here
    private $_controlador;
    private $_menu;
    private $_modulo_padre;
    private $_alerta;
    private $_js;
    private $_css;
    private $_js_foot;

    //parametro request = es el parametro del ccontrolador
    public function __construct(request $peticion, $menu, $modulo_padre, $alerta) {
        //guardamos el nombre del controlador
        $this->_controlador = $peticion->get_controlador();
        $this->_menu = $menu;
        $this->_modulo_padre = $modulo_padre;
        $this->_alerta = $alerta;
        $this->_js = array();
        $this->_css = array();
        $this->_js_foot = array();
    }

    public function renderizar($vista, $item = false) {
        //aqui podemos poner el menu
        //creamos la ruta de la vista

        $ruta_vista = ROOT . 'vista' . DS . $this->_controlador . DS . $vista . '.php';

        $js = array();
        $css = array();
        $js_foot = null;

        if (count($this->_js)) {
            $js = $this->_js;
        }
        if (count($this->_css)) {
            $css = $this->_css;
        }
        if (count($this->_js_foot)) {
            $js_foot = $this->_js_foot;
        }

        $_params = array(
            'ruta_css' => BASE_URL . 'lib/css/',
            'ruta_js' => BASE_URL . 'lib/js/',
            'ruta_img' => BASE_URL . 'lib/img/',
            'js' => $js,
            'css' => $css,
            'js_foot' => $js_foot
        );

        //die($ruta_vista);
        //comprobamos si el archivo existe y es legible
        //die($ruta_vista);
        if (is_readable($ruta_vista)) {
            //enviamos parametros como css, js
            //archivos propios del template
            //incluimos los layout
            include_once ROOT . DS . 'cabecera.php';
            if(session::get('autenticado')){
                include_once ROOT . DS . 'alerta.php';
                new alerta($this->_alerta);
            }
            include_once ROOT . DS . 'perfil.php';
            if(session::get('autenticado')){
                include_once ROOT . DS . 'menu.php';
                new menu($this->_menu, $this->_modulo_padre);
            }
            if(session::get('autenticado')){                
                $page=$_SERVER['REQUEST_URI'];
                $pieces = explode("/", $page);
                $uri2 = $pieces[2];
                echo '<div class="page-head">';
                            if($uri2!='index'){
                                echo '<h2 class="pull-left">
                                    '.$this->titulo.'
                                </h2>';
                            }
                            echo '<div class="clearfix"></div></div><!--/.page-header--><div class="matter">
				<div class="container">';
            }
                echo '<script type="text/javascript">
                            $(function() {
                                var mp = $("li.active span").html();
                                $("#name_modulo_padre").html(mp);
                                var mh = $(".mh_'.$uri2.'").html();
                                $(".mh_'.$uri2.'").css("color","#0993d3");
                                $("#name_modulo_hijo").html(mh);
                            });
                        </script>';
            include_once $ruta_vista;
            include_once ROOT . DS . 'pie.php';
            //incluimos la vista
        } else {
            throw new Exception('Error de vista');
        }
    }
    
    public function renderiza_web($vista, $item = false,$columna = false) {
        $js = array();
        $css = array();

        if (count($this->_js)) {
            $js = $this->_js;
        }
        if (count($this->_css)) {
            $css = $this->_css;
        }
        $menu = array(
            array(
                'id' => 'inicio',
                'titulo' => 'INICIO',
                'enlace' => BASE_URL.'web/'
                ),
            
            array(
                'id' => 'nosotros',
                'titulo' => 'NOSOTROS',
                'enlace' => BASE_URL . 'web/nosotros'
                ),
            array(
                'id' => 'servicios',
                'titulo' => 'SERVICIOS',
                'enlace' => BASE_URL. 'web/servicios'
                ),
            array(
                'id' => 'productos',
                'titulo' => 'PRODUCTOS',
                'enlace' => BASE_URL. 'web/productos'
                ),
            array(
                'id' => 'contactenos',
                'titulo' => 'CONTÁCTENOS',
                'enlace' => BASE_URL. 'web/contactenos'
                )
            
        );
        
        $_webParams = array(
            'ruta_css' => BASE_URL . 'vista/web/css/',
            'ruta_js' => BASE_URL . 'vista/web/js/',
            'ruta_img' => BASE_URL . 'lib/img/web/',//
            'ruta_img_ser' => BASE_URL . 'lib/img/servicio/',
            'ruta_img_pro' => BASE_URL . 'lib/img/producto/', //agrege el url servicio          
            'menu'=>$menu,
            'js' => $js,
            'css' => $css
        );
        $ruta_vista = ROOT . 'vista' . DS . $this->_controlador . DS . $vista . '.php';
        if (is_readable($ruta_vista)) {
            include_once ROOT . 'vista' . DS . $this->_controlador . DS . 'cabecera.php';
            include_once $ruta_vista;
            if($columna){
            include_once ROOT . 'vista'. DS . $this->_controlador . DS . 'columna.php';    
            }
            include_once ROOT . 'vista' . DS . $this->_controlador . DS . 'pie.php';
            //incluimos la vista
        } else {
            throw new Exception('Error de vista');
        }
    }

    public function renderiza_movil($vista, $item = false) {
        $js = array();
        $css = array();

        if (count($this->_js)) {
            $js = $this->_js;
        }
        if (count($this->_css)) {
            $css = $this->_css;
        }
        $menu = array(
            array(
                'id' => 'inicio',
                'titulo' => 'INICIO',
                'enlace' => BASE_URL.'movil/'
                ),
            
            array(
                'id' => 'nosotros',
                'titulo' => 'NOSOTROS',
                'enlace' => BASE_URL.'movil/nosotros/'
                ),
            array(
                'id' => 'servicios',
                'titulo' => 'SERVICIOS',
                'enlace' => BASE_URL. 'movil/servicios/'
                ),
            array(
                'id' => 'productos',
                'titulo' => 'PRODUCTOS',
                'enlace' => BASE_URL. 'movil/productos/'
                ),
            array(
                'id' => 'eventos',
                'titulo' => 'EVENTOS',
                'enlace' => BASE_URL. 'movil/eventos/'
                ),
            array(
                'id' => 'contactenos',
                'titulo' => 'CONTÁCTENOS',
                'enlace' => BASE_URL. 'movil/contactenos/'
                )
            /*array(
                'id' => 'login',
                'titulo' => 'INICIAR SESION',
                'enlace' => BASE_URL. 'movil/login/'
                )*/
            
        );
        
        $_movilParams = array(
            'ruta_css' => BASE_URL . 'vista/movil/css/',
            'ruta_js' => BASE_URL . 'vista/movil/js/',
            'ruta_img' => BASE_URL . 'lib/img/web_movil/',
            'ruta_img_web' => BASE_URL . 'lib/img/web/',
            'ruta_img_serv' => BASE_URL . 'lib/img/web_movil/servicio/',
            'ruta_img_pro' => BASE_URL . 'lib/img/web_movil/producto/',
            'menu'=>$menu,            
            'js' => $js,
            'css' => $css
        );
        $ruta_vista = ROOT . 'vista' . DS . $this->_controlador . DS . $vista . '.php';
        if (is_readable($ruta_vista)) {
            include_once ROOT . 'vista' . DS . $this->_controlador . DS . 'cabecera.php';
            include_once ROOT . 'vista' . DS . $this->_controlador . DS . 'menu.php';
            include_once $ruta_vista;
            include_once ROOT . 'vista' . DS . $this->_controlador . DS . 'pie.php';
            //incluimos la vista
        } else {
            throw new Exception('Error de vista');
        }
    }
    
    public function renderizar_webservice($vista, $item = false) {
        //aqui podemos poner el menu
        //creamos la ruta de la vista

        $ruta_vista = $ruta_vista = ROOT . 'vista' . DS . $this->_controlador . DS . $vista . '.php';
        //comprobamos si el archivo existe y es legible

        if (is_readable($ruta_vista)) {
            //incluimos los layout
            require_once ROOT . 'lib'.DS.'nusoap'.DS.'nusoap.php';
            include_once $ruta_vista;
            //incluimos la vista
        } else {
            throw new Exception('Error de vista');
        }
    }

    public function setJs(array $js) {
        if (is_array($js) && count($js)) {
            for ($i = 0; $i < count($js); $i++) {
                $this->_js[] = BASE_URL . 'vista/' . $this->_controlador . "/js/" . $js[$i] . '.js';
            }
        } else {
            throw new Exception('Error de js');
        }
    }

    public function setCss(array $css) {
        if (is_array($css) && count($css)) {
            for ($i = 0; $i < count($css); $i++) {
                $this->_css[] = BASE_URL . 'vista/' . $this->_controlador . "/css/" . $css[$i] . '.css';
            }
        } else {
            throw new Exception('Error de css');
        }
    }
    
    public function setJs_Foot(array $js_foot) {
        if (is_array($js_foot) && count($js_foot)) {
            for ($i = 0; $i < count($js_foot); $i++) {
                $this->_js_foot[] = BASE_URL . 'vista/web/js/' . $js_foot[$i] . '.js';
            }
        } else {
            throw new Exception('Error de js');
        }
    }
    public function setJs_public(array $js) {
        if (is_array($js) && count($js)) {
            for ($i = 0; $i < count($js); $i++) {
                $this->_js[] = BASE_URL . 'lib/js/'. $js[$i] . '.js';
            }
        } else {
            throw new Exception('Error de js');
        }
    }
    public function setCss_public(array $css) {
        if (is_array($css) && count($css)) {
            for ($i = 0; $i < count($css); $i++) {
                $this->_css[] = BASE_URL . 'lib/css/'. $css[$i] . '.css';
            }
        } else {
            throw new Exception('Error de css');
        }
    }
    
    public function renderizar_reporte($vista, $item = false) {
        //aqui podemos poner el menu
        //creamos la ruta de la vista

        $ruta_vista = ROOT . 'vista' . DS . $this->_controlador . DS . $vista . '.php';
        //comprobamos si el archivo existe y es legible
//print_r($ruta_vista);exit;
        if (is_readable($ruta_vista)) {
            //incluimos los layout
            include_once $ruta_vista;
            //incluimos la vista
        } else {
            throw new Exception('Error de vista'.$ruta_vista);
        }
    }

}

?>