<?php

class venta_controlador extends controller {

    private $_venta;
    private $_serie_comprobante;
    private $_almacen;
    private $_param;
    private $_venta_membresia;
    private $_venta_producto;
    private $_cronograma_cobro;    
    private $_sesion_caja;
    private $_movimiento;
    private $_almacen_producto;
    private $_matricula;
    
    
    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_venta = $this->cargar_modelo('venta');
        $this->_serie_comprobante = $this->cargar_modelo('serie_comprobante');
        $this->_almacen = $this->cargar_modelo('almacen');
        $this->_param = $this->cargar_modelo('param');
        $this->_venta_membresia = $this->cargar_modelo('venta_membresia');
        $this->_venta_producto = $this->cargar_modelo('venta_producto');
        $this->_cronograma_cobro = $this->cargar_modelo('cronograma_cobro');        
        $this->_sesion_caja = $this->cargar_modelo('sesion_caja');        
        $this->_movimiento = $this->cargar_modelo('movimiento');
        $this->_almacen_producto = $this->cargar_modelo('almacen_producto');
        $this->_matricula = $this->cargar_modelo('matricula');
    }

    public function index() {
        $this->_vista->titulo = 'Lista de Ventas';
        $this->_vista->datos = $this->_venta->selecciona();
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->setJs(array('funcion'));
        $this->_vista->renderizar('index');
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
            $this->_venta->id_cliente = $_POST['id_cliente'];
            $this->_venta->id_empleado = session::get('id_empleado');
            $this->_venta->id_tipopago = $_POST['id_tipopago'];
            $this->_venta->fechaventa = date("Y-m-d H:i:s");
            $this->_venta->subtotal = $_POST['subtotal'];
            $this->_venta->igv = $_POST['igv'];
            $this->_venta->id_tipocomprobante = $_POST['sel_tipo_documento'];
            $this->_venta->nrodoc = $_POST['nrodoc'];
            $dato_venta = $this->_venta->inserta();
//            print_r($dato_venta);exit;
            //inserta detalle venta
            for($i=0;$i<count($_POST['id_vendido']);$i++){
                if($_POST['id_tipo'][$i]=='m'){
                    $this->_venta_membresia->id_venta=$dato_venta[0]['MAX_VENTA'];
                    $this->_venta_membresia->id_matricula= $_POST['id_vendido'][$i];
                    $this->_venta_membresia->id_tipo_membresia= $_POST['id_campo2'][$i];
                    $this->_venta_membresia->fecha= $_POST['numero'][$i];
                    $this->_venta_membresia->precio= $_POST['precio'][$i];
                    $this->_venta_membresia->inserta();
                    
                }else if($_POST['id_tipo'][$i]=='p'){
                    $this->_venta_producto->id_venta=$dato_venta[0]['MAX_VENTA'];
                    $this->_venta_producto->id_producto= $_POST['id_vendido'][$i];
                    $this->_venta_producto->id_almacen= $_POST['id_campo2'][$i];
                    $this->_venta_producto->cantidad= $_POST['numero'][$i];
                    $this->_venta_producto->precio= $_POST['precio'][$i];
                    $this->_venta_producto->inserta();
                }
                
            }
            //actualizamos el correlativo
            $this->_serie_comprobante->id_tipo_documento=$_POST['sel_tipo_documento'];
            $datos=$this->_serie_comprobante->selecciona_num();
//            echo '<pre>';print_r($datos);exit;
            if($datos[0]['NUMERO']==$datos[0]['MAX_NUMERO']){
                $this->_serie_comprobante->id_serie_documento=$datos[0]['ID_SERIE_DOCUMENTO'];
                $this->_serie_comprobante->elimina();
                $this->_serie_comprobante->numero=$datos[0]['CODIGO']+1;
                $this->_serie_comprobante->id_tipo_documento=$datos[0]['ID_TIPO_DOCUMENTO'];
                $this->_serie_comprobante->max_numero=$datos[0]['MAX_NUMERO'];
                $this->_serie_comprobante->inserta();
            }else{
                $this->_serie_comprobante->id_serie_documento=$datos[0]['ID_SERIE_DOCUMENTO'];
                $this->_serie_comprobante->numero=$datos[0]['NUMERO']+1;
                $this->_serie_comprobante->act_correlativo();
            }
            
            //insertamos cronograma de pago
            if($_POST['id_tipopago']==2){
                
                for($i=0;$i<$_POST['cuotas'];$i++){

                    $this->_cronograma_cobro->id_venta=$dato_venta[0]['MAX_VENTA'];
                    $this->_cronograma_cobro->fecha_venc=$_POST['fecha_cuota'][$i];
                    $this->_cronograma_cobro->num_cuota=$i+1;
                    $this->_cronograma_cobro->monto_cuota=$_POST['monto_cuota'][$i];
                    $this->_cronograma_cobro->inserta();
                }
                
            }else{
                //------------- CRONOGRAMA AL CONTADO--------------------------
                $this->_cronograma_cobro->id_venta=$dato_venta[0]['MAX_VENTA'];
                $this->_cronograma_cobro->fecha_venc=$_POST['fechaventa'];
                $this->_cronograma_cobro->monto_cuota=$_POST['total'];
                $this->_cronograma_cobro->num_cuota=1;
                $this->_cronograma_cobro->inserta();                
                
            }
            $this->redireccionar('venta');
        }
        
        $this->_vista->titulo = 'Registrar Venta';
        $this->_vista->action = BASE_URL . 'venta/nuevo';
        
        $this->_vista->almacen = $this->_almacen->selecciona();
        
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->setJs(array('funciones_form','jquery-ui.min'));
        $this->_vista->renderizar('form');
    }
    
    public function nuevo_membresia($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('matricula');
        }
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
                
        $this->_vista->titulo = 'Registrar Venta';
        $this->_vista->action = BASE_URL . 'venta/nuevo';
        
        
        $this->_vista->almacen = $this->_almacen->selecciona();
        
        $this->_matricula->id_matricula=$this->filtrarInt($id);
        $this->_vista->matricula = $this->_matricula->selecciona_id();
        //echo '<pre>';print_r($this->_vista->matricula);exit;
        
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->setJs(array('funciones_form','jquery-ui.min'));
        $this->_vista->renderizar('form');
    }
        
    public function eliminar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('venta');
        }
        
        
        //---reponemos el stock
        $this->_venta_producto->id_venta=$id;
        $producto_venta= $this->_venta_producto->selecciona_id_venta();
        for($i=0;$i<count($producto_venta);$i++){
            
            $cantidad=$producto_venta[$i]['STOCK_ACTUAL']+$producto_venta[$i]['CANT_VENTA'];
            $this->_almacen_producto->id_almacen = $producto_venta[$i]['ID_ALMACEN'];
            $this->_almacen_producto->id_producto = $producto_venta[$i]['ID_PRODUCTO'];
            $this->_almacen_producto->cantidad = $cantidad;
            $this->_almacen_producto->actualizar_stock();
            
        }
        
        //---reponemos el estado de matricula
        $this->_venta_membresia->id_venta=$id;
        $matricula_venta= $this->_venta_membresia->selecciona_id_venta();
        
        for($i=0;$i<count($matricula_venta);$i++){
            $this->_matricula->id_matricula= $matricula_venta[$i]['ID_MATRICULA'];
            $this->_matricula->reinicio_estado_pago();
        }
        
        $this->_venta->id_venta = $id;
        $this->_venta->elimina();
        $this->redireccionar('venta');
    }
    
    public function ver(){
        $this->_venta->id_venta=$_POST['id_venta'];
        echo json_encode($this->_venta->selecciona_id());
    }
    
    public function getCorrelativo() {
        
        if($_POST['id_tipo_documento']==1||$_POST['id_tipo_documento']==2){
            $this->_serie_comprobante->id_tipo_documento=$_POST['id_tipo_documento'];
            $datos=$this->_serie_comprobante->selecciona_num();
//            echo '<pre>';print_r($datos);exit;
            if($datos[0]['NUMERO']==$datos[0]['MAX_NUMERO']){
                echo $this->number_code(intval($datos[0]['CODIGO'])+1, 3).'-'.$this->number_code(1, 7);
            }else{
                echo $this->number_code(intval($datos[0]['CODIGO']), 3).'-'.$this->number_code(intval($datos[0]['NUMERO'])+1, 7);
            }
        }else{
            echo "";
        }
    }
    public function number_code($number,$tam=0){
        $data="";
        $comodin="0";
        for($i=0;$i<$tam-strlen($number);$i++){
            $data.=$comodin;
        }
        $data.=$number;
        return $data;
    }
    public function getParam(){
        $this->_param->id_param = $_POST['id_param'];
        echo json_encode($this->_param->selecciona());
    }

    public function getVentasCliente(){
        $this->_venta->id_cliente = $_POST['id_c'];
        echo json_encode($this->_venta->ventas_x_cliente());
    }
    
}

?>
