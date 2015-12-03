<?php

class reportes_graficos_controlador extends controller {

    private $_reportes_graficos;
    private $_socio;

    //put your code here
    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->get_Libreria('highchart' . DS . 'Highchart');
        $this->_vista->setJs(array('funciones'));
        $this->_reportes_graficos = $this->cargar_modelo('reportes_graficos');
        $this->_socio = $this->cargar_modelo('socio');
    }

    public function index() {
        $this->_vista->renderizar('index');
    }

    public function r_ventas() {
        $this->_reportes_graficos->anio=date("Y");
        $this->_vista->datos= $this->_reportes_graficos->reporte_ventas();
        $this->_vista->renderizar_reporte('r_ventas');
    }

    public function r_compras() {
        $this->_reportes_graficos->anio=date("Y");
       // print_r($this->_reportes_graficos->anio);exit();
        $this->_vista->datos= $this->_reportes_graficos->reporte_compras();
        $this->_vista->renderizar_reporte('r_compras');
    }
    
    public function r_prod() {
        $this->_vista->datos= $this->_reportes_graficos->reporte_prod();
        $this->_vista->renderizar_reporte('r_prod');
    }
    public function historial_graf_socio($id_socio) {
        $this->_socio->id_socio=$id_socio;
        $this->_vista->datos= $this->_socio->selecciona_historial_graf();
        if(count($this->_vista->datos)<=0){
            echo '<h4> No se encontraron registros historicos del cliente </h4>';
            return false;
        }
        //print_r($this->_vista->datos);exit();
        $this->_vista->renderizar_reporte('historial');
    }

}

?>