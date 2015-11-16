<?php

class compra_controlador extends controller {

    private $_compra;
    private $_almacen;
    private $_compra_producto;
    private $_almacen_producto;
    private $_cronograma_pago;
    private $_proveedor;
    private $_param;       
    private $_sesion_caja;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_compra = $this->cargar_modelo('compra');
        $this->_almacen = $this->cargar_modelo('almacen');
        $this->_proveedor = $this->cargar_modelo('proveedor');
        $this->_compra_producto = $this->cargar_modelo('compra_producto');
        $this->_cronograma_pago = $this->cargar_modelo('cronograma_pago');
        $this->_almacen_producto = $this->cargar_modelo('almacen_producto');
        $this->_param = $this->cargar_modelo('param');
        $this->_sesion_caja = $this->cargar_modelo('sesion_caja');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Compras';
        $this->_vista->setJs(array('funcion'));
        $this->_vista->datos = $this->_compra->selecciona();
        //print_r($this->_vista->datos);exit;
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('index');
    }
    
    public function inserta_prov(){
         $this->_proveedor->direccion=$_POST['dir'];
        $this->_proveedor->razon_social=$_POST['rs'];
        $this->_proveedor->email=$_POST['em'];
        $this->_proveedor->id_ubigeo=$_POST['ciu'];
        $this->_proveedor->ruc=$_POST['ruc'];
        $this->_proveedor->telefono=$_POST['tel'];
        $datos = $this->_proveedor->inserta();
        echo json_encode(array('id_proveedor'=>$datos[0]['INS_PROVEEDOR']));
    }
    
    public function nuevo() {
        $sesiones =  $this->_sesion_caja->cajas_activas();
        $emp_existente = false;
        $fecha_sesion = "";
        $id_sesion_caja = "";
        for ($i=0; $i <count($sesiones); $i++) { 
            if($sesiones[$i]["ID_EMPLEADO"] == session::get('id_empleado')){
                $emp_existente = true;
                $fecha_sesion = $sesiones[$i]["FECHA_ENTRADA"];
                $id_sesion_caja = $sesiones[$i]["ID_SESION_CAJA"];
                $monto_caja = $sesiones[$i]["MONTO_CIERRE"];
            }
        }
        
        if(!$emp_existente){
            echo "<script>alert('Aperture una Caja antes de Realizar cualquier Venta');</script>";
            $this->redireccionar('sesion_caja'); 
        }
        if ($_POST['guardar'] == 1) {
            //echo '<pre>';print_r($_POST);exit;
            $this->_compra->id_proveedor = $_POST['id_proveedor'];
            $this->_compra->id_empleado = session::get('id_empleado');
            $this->_compra->id_modalidad_transaccion= $_POST['id_tipopago'];
            $this->_compra->fecha = $_POST['fechacompra'];
            $this->_compra->monto = $_POST['subtotal'];
            $this->_compra->num_documento = $_POST['nrodoc'];
            $this->_compra->igv = $_POST['igv'];
            
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
                    $this->_cronograma_pago->id_compra=$dato_compra[0]['MAX_COMPRA'];
                    $this->_cronograma_pago->fecha_venc=$fecha_temp;
                    $this->_cronograma_pago->num_cuota=$i;
                    $this->_cronograma_pago->monto_cuota=$cuota[$i];
                    $this->_cronograma_pago->inserta();
                    $fecha_temp = date("Y-m-d", strtotime("$fecha_temp +$intervalo_dias day"));
                }
                
            }else{         
                $this->_cronograma_pago->id_compra=$dato_compra[0]['MAX_COMPRA'];
                $this->_cronograma_pago->fecha_venc=$_POST['fechacompra'];
                $this->_cronograma_pago->monto_cuota=$_POST['total'];
                $this->_cronograma_pago->num_cuota=1;
                $this->_cronograma_pago->inserta();
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
        $this->_compra_producto->id_compra = $this->filtrarInt($id);
        $dato_compra=$this->_compra_producto->comparar_stocks();
        
        $c=TRUE;
        for($i=0;$i<count($dato_compra);$i++){
            if($dato_compra[$i]['CANT_COMPRA']>$dato_compra[$i]['STOCK_ACTUAL']){
                $c=FALSE;
                break;
            }
        }
            
        if($c){
            for($i=0;$i<count($dato_compra);$i++){
                $cantidad=$dato_compra[$i]['STOCK_ACTUAL']-$dato_compra[$i]['CANT_COMPRA'];
                $this->_almacen_producto->id_almacen = $dato_compra[$i]['ID_ALMACEN'];
                $this->_almacen_producto->id_producto = $dato_compra[$i]['ID_PRODUCTO'];
                $this->_almacen_producto->cantidad = $cantidad;
                $this->_almacen_producto->quitar_stock();
            }
            $this->_compra->id_compra = $id;
            $this->_compra->elimina();
            $this->redireccionar('compra');
        }else{
            echo "<script>alert('Stock menor a la cantidad comprada')</script>";
            $this->redireccionar('compra');
        }
        
        
    }
    
    public function getParam(){
        $this->_param->id_param = $_POST['id_param'];
        echo json_encode($this->_param->selecciona());
    }

    public function getComprasProveedor(){
        $this->_compra->id_proveedor = $_POST['id_p'];
        echo json_encode($this->_compra->compras_x_proveedor());

    }
    
    public function get_proveedor(){
        echo json_encode($this->_proveedor->selecciona());
    }
    
    public function ver(){
        $this->_compra->id_compra=$_POST['id_compra'];
        echo json_encode($this->_compra->selecciona_id());
    }
}

?>
