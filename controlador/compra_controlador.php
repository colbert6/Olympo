<?php

class compra_controlador extends controller {

    private $_compra;
    private $_almacen;
    private $_compra_producto;
    private $_cuota_compra;
    private $_proveedor;
    private $_param;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_compra = $this->cargar_modelo('compra');
        $this->_almacen = $this->cargar_modelo('almacen');
        $this->_proveedor = $this->cargar_modelo('proveedor');
        $this->_compra_producto = $this->cargar_modelo('compra_producto');
        $this->_cuota_compra = $this->cargar_modelo('amortizacion_compra');
        $this->_param = $this->cargar_modelo('param');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Compras';
        //$this->_vista->datos = $this->_compra->selecciona();
        $this->_vista->setJs(array('funcion'));
        //$this->_vista->setJs_Foot(array('scriptgrilla'));
        $this->_vista->datos = $this->_compra->selecciona();
        //print_r($this->_vista->datos);exit;
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }
    
    public function inserta_prov(){        
        $this->_proveedor->nombre=$_POST['nombre'];
        $this->_proveedor->direccion=$_POST['dir'];
        $this->_proveedor->razonsocial=$_POST['rs'];
        $this->_proveedor->email=$_POST['em'];
        $this->_proveedor->ciudad=$_POST['ciu'];
        $this->_proveedor->ruc=$_POST['ruc'];
        $this->_proveedor->telefmovil=$_POST['tel'];
        $datos = $this->_proveedor->inserta();
        echo json_encode(array('id_proveedor'=>$datos[0]['INS_PROVEEDOR']));
    }
    
    public function get_proveedor(){
        $this->_proveedor->id_proveedor=9999;
        echo json_encode($this->_proveedor->selecciona());
    }
    
    
    public function ver(){
        $this->_compra->id_compra=$_POST['id_compra'];
        //print_r($this->_compra->selecciona());exit;
        echo json_encode($this->_compra->selecciona_id());
    }
    
    public function nuevo() {
        
        
        if ($_POST['guardar'] == 1) {
            print_r($_POST);exit;
//            echo '<pre>';print_r($_POST);exit;
            $this->_cuota_compra->id_proveedor = $_POST['id_proveedor'];
            $this->_cuota_compra->id_empleado = session::get('id_empleado');
            $this->_cuota_compra->id_modalidad_transaccion= $_POST['id_tipopago'];
            $this->_cuota_compra->fecha = $_POST['fechacompra'];
            $this->_cuota_compra->monto = $_POST['subtotal'];
            $this->_cuota_compra->num_documento = $_POST['nrodoc'];
            $this->_cuota_compra->igv = $_POST['igv'];
            
            $dato_compra = $this->_compra->inserta();
//            print_r($dato_compra);exit;
            //inserta detalle compra
            for($i=0;$i<count($_POST['id_producto']);$i++){
                $this->_compra_producto->id_compra=$dato_compra[0]['MAX_COMPRA'];
                $this->_compra_producto->id_producto= $_POST['id_producto'][$i];
                $this->_compra_producto->id_almacen= $_POST['id_almacen'][$i];
                $this->_compra_producto->cantidad= $_POST['cantidad'][$i];
                $this->_compra_producto->precio= $_POST['precio'][$i];
                $this->_compra_producto->inserta();
            }
            //insertamos cronograma de pago
            if($_POST['id_tipopago']==2){
                $fecha_compra = $_POST['fechacompra'];
                $intervalo_dias = $_POST['intervalo'];
                $letras=$_POST['cuotas'];
                $monto = $_POST['total'];
                $c=$letras;
                $fecha_temp = $fecha_compra;
                $mayor = true;
                $cuota = array();
                
                $monto_pagado = 0;
                $pago_mensual = (int)($monto / $c);

                for($i=1;$i<=$c;$i++){
                    $cuota[$i]=$pago_mensual;
                    $monto_pagado = $monto_pagado + $pago_mensual;  
                }
                if($monto_pagado != $monto){
                    $cuota[$c]=	$cuota[$c] + ($monto- $monto_pagado);
                }
                $fecha_temp = date("Y-m-d", strtotime("$fecha_compra +$intervalo_dias day"));
                for($i=1;$i<=$c;$i++){
                    $this->_cronogpago->id_cuota_pago=$dato_compra[0]['INS_COMPRA'];
                    $this->_cronogpago->fecha=$fecha_temp;
                    $this->_cronogpago->monto=$cuota[$i];
                    $this->_cronogpago->nrocuota=$i;
                    $this->_cronogpago->inserta();
                    $fecha_temp = date("Y-m-d", strtotime("$fecha_temp +$intervalo_dias day"));
                }
                
                
            }else{
                $this->_cronogpago->id_compra = $dato_compra[0]['MAX_COMPRA'];
                $this->_cronogpago->fecha = $_POST['fechacompra'];
                $this->_cronogpago->monto = $_POST['total'];
                $this->_cronogpago->nrocuota = 1;
                $this->_cronogpago->inserta();
            }
            $this->redireccionar('compra');
        }
        $this->_vista->almacen = $this->_almacen->selecciona();
        $this->_vista->titulo = 'Registrar Compra';
        $this->_vista->action = BASE_URL . 'compra/nuevo';
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min'));
        $this->_vista->setJs(array('funciones_form','jquery-ui.min'));
        $this->_vista->renderizar('form');
    }

    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('compra');
        }
        $this->_compra->id_compra = $this->filtrarInt($id);
        $this->_compra->elimina();
        $this->redireccionar('compra');
    }
    
    public function getParam(){
        $this->_param->id_param = $_POST['id_param'];
        echo json_encode($this->_param->selecciona());
    }
    
    public function getUnidadesInsumo(){
        $this->_detinsumoum->id_insumo = $_POST['id_insumo'];
        echo json_encode($this->_detinsumoum->selecciona());
    }

}

?>
