<?php

Class menu {

//cargarmenu("0"); // Donde 0 es el Idpadre principal
    protected $_id;
    protected $_datos;
    protected $_id_modulopadre;
    private $_c = 0;

    public function __construct($datos, $id_modulopadre) {
        $this->_datos = $datos;
        $this->_id_modulopadre = $id_modulopadre;
        $this->unemenu();
    }

    function unemenu() {
        echo "<ul id='nav'>";
        if(session::get('tipo_actor')=='s'){
            echo "<li><a href='" . BASE_URL."reglamento/" . "'><i class='icon-gears'></i><span>Reglamento</span></a></li>"; 
            echo "<li class='has_sub'><a href='javascript:void' class='opcion_menu' ><i class='icon-male'></i><span>Mi Membresia</span><span class='pull-right'><i class='icon-chevron-right'></i></span></a>";
            echo "<ul class='lista_menu'>";
            echo "<li><a href='" . BASE_URL."mi_rutina/" . "'>Mi Rutina</a></li>";
            echo "<li><a href='" . BASE_URL."mis_medidas/" . "'>Medidas Antropometricas</a></li>";
            echo "<li><a href='" . BASE_URL."mis_membresias/" . "'>Mis Membresias</a></li>";
            echo "<li><a href='" . BASE_URL."mis_eventos/" . "'>Eventos</a></li>";
            echo "</ul>";


        }else{
            $this->cargarmenu();
        }
        
        echo "<li><a href='" . BASE_URL . "'><i class='icon-desktop'></i><span>Portal Web</span></a></li>";
        
        echo "</ul>";
        echo '</div><div class="mainbar">';
    }

    function cargarmenu() {
        if(isset($this->_datos) && count($this->_datos)){
            for($i=0; $i< count($this->_datos); $i++){
                if($this->_c==0){
                    $descripcion= ucwords(strtolower($this->_datos[$i]['MODULO_PADRE']));
                    if($this->_datos[$i]['ID_PADRE']==$this->_id_modulopadre){
                        echo "<li class='has_sub'><a href='javascript:void' class='open subdrop'><i class='".strtolower($this->_datos[$i]['ICONO_PADRE'])."'></i><span>$descripcion</span><span class='pull-right'><i class='icon-chevron-down'></i></span></a><ul style='overflow: hidden; display: block;'>";
                    }else{
                        echo "<li class='has_sub'><a href='javascript:void' class='opcion_menu' ><i class='".strtolower($this->_datos[$i]['ICONO_PADRE'])."'></i><span>$descripcion</span><span class='pull-right'><i class='icon-chevron-right'></i></span></a><ul class='lista_menu'>";
                    }
                    $this->_c = 1;
                }
                if (strtoupper($descripcion) == strtoupper($this->_datos[$i]['MODULO_PADRE'])){
                    $url = BASE_URL . strtolower($this->_datos[$i]['URL']);
                    echo "<li><a href='$url' class='mh_".strtolower($this->_datos[$i]['URL'])."'>" . ucwords(strtolower($this->_datos[$i]['NOMBRE'])) . "</a></li>";
                } else {
                    echo "</ul></li>";
                    $this->_c = 0;
                    $i = $i -1;
                }
            }
            echo "</ul></li>";
        }
    }
}
?>
<!--FIn menu-->