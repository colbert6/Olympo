<?php

class movimiento_controlador extends controller {

    private $_movimiento;
    private $_sesion_caja;
    private $_amortizacion_compra;
    private $_amortizacion_venta;
    private $_cronograma_pago;
    private $_cronograma_cobro;
    private $_compra;
    private $_venta;
    private $_tipo_movimiento;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_tipo_movimiento = $this->cargar_modelo('tipo_movimiento');
        $this->_movimiento = $this->cargar_modelo('movimiento');
        $this->_sesion_caja = $this->cargar_modelo('sesion_caja');
        $this->_amortizacion_compra = $this->cargar_modelo('amortizacion_compra');
        $this->_cronograma_pago = $this->cargar_modelo('cronograma_pago');
        $this->_cronograma_cobro = $this->cargar_modelo('cronograma_cobro');
        $this->_amortizacion_venta = $this->cargar_modelo('amortizacion_venta');
        $this->_compra = $this->cargar_modelo('compra');
        $this->_venta = $this->cargar_modelo('venta');
    } 

    public function index() {
        $this->_vista->titulo = 'Lista de Movimientos';
        //$this->_vista->setJs(array('funcion'));
        $this->_vista->datos = $this->_movimiento->selecciona();
        //print_r($this->_vista->datos);exit;
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('index');
    }

    public function otros_movimientos() {
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
        if($emp_existente){
            if(new DateTime((substr($fecha_sesion,0,10)),new DateTimeZone('America/Lima'))!=new DateTime(date('d-m-Y'),new DateTimeZone('America/Lima'))){
                echo '<script>alert("Cierre la caja de fecha pasada y aperture la caja para el dia de hoy")</script>';
                $this->redireccionar('sesion_caja');
            }            
            if ($_POST['guardar'] == 1) {
                $id_tipo_movimiento = $_POST["id_tipo_movimiento"];
                $monto = $_POST["monto"];
                if($id_tipo_movimiento==1){
                    if(($monto_caja - $monto) < 50){
                        echo '<script>alert("No hay suficiente saldo para ejecutar el pago")</script>';
                        $this->redireccionar('sesion_caja');
                    }
                }
                $id_concepto_movimiento = $_POST["id_concepto_movimiento"];
                $id_forma_pago = $_POST["id_forma_pago"]; 
                $descripcion = $_POST["descripcion"];
                $fecha = date("Y-m-d H:i:s");
                //-------------------------------------------------------------------------
                $this->_movimiento->id_sesion_caja = $id_sesion_caja;
                $this->_movimiento->id_concepto_movimiento = $id_concepto_movimiento;
                $this->_movimiento->id_forma_pago = $id_forma_pago;
                $this->_movimiento->monto = $monto;
                $this->_movimiento->descripcion = $descripcion;
                $this->_movimiento->fecha = $fecha;
                $ultimo = $this->_movimiento->inserta();
                // ---------------- ACTUALIZACION DE SALDO --------------------
                if($id_tipo_movimiento == 2){
                    $this->_sesion_caja->aumenta=1;    
                }else if($id_tipo_movimiento == 1){
                    $this->_sesion_caja->aumenta=0;
                }
                $this->_sesion_caja->id_sesion_caja = $id_sesion_caja;
                $this->_sesion_caja->monto_cierre=$monto;
                $this->_sesion_caja->actualiza_saldo();

                $this->redireccionar('movimiento');
            }
            $this->_vista->titulo = 'Otros Movimientos';
            $this->_vista->action = BASE_URL . 'movimiento/otros_movimientos';
            $this->_vista->tipo_movimiento = $this->_tipo_movimiento->selecciona();
            $this->_vista->setJs(array('funciones'));
            $this->_vista->renderizar('otros_movimientos');

        }else{
            echo "<script>alert('Aperture una Caja antes de Realizar cualquier Movimiento');</script>";
            $this->redireccionar('sesion_caja'); 
        }
        
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
        if($emp_existente){
            if(new DateTime((substr($fecha_sesion,0,10)),new DateTimeZone('America/Lima'))!=new DateTime(date('d-m-Y'),new DateTimeZone('America/Lima'))){
                echo '<script>alert("Cierre la caja de fecha pasada y aperture la caja para el dia de hoy")</script>';
                $this->redireccionar('sesion_caja');
            }
            if($_POST['guardar']==1){
                //echo '<pre>';print_r($_POST);exit;
                //--------VARIABLES--------------------------------------------
                
                if ($_POST['id_modalidad_t']=='CONTADO'){
                    $monto = $_POST['monto_contado'];
                    $deuda_total = $monto;
                    $pago_total = $monto;
                    if($_POST['id_concepto_movimiento']==1){
                        $referencia = 'COMPRA AL CONTADO';
                    }else{
                        $referencia = 'VENTA AL CONTADO';
                    }
                }else{
                    $monto = $_POST['importe'];
                    $referencia = $_POST['referencia'];
                    $deuda_total = $_POST['deuda'];
                    $pago_total = $_POST['pago'];
                }
                
                $tipo_movimiento = $_POST['tipo_movimiento'];

                if($tipo_movimiento == "EGRESO"){
                    if(($monto_caja - $monto) < 50){
                        echo '<script>alert("No hay suficiente saldo para ejecutar el pago")</script>';
                        $this->redireccionar('sesion_caja');
                    }
                }

                $id_concepto_movimiento = $_POST['id_concepto_movimiento'];
                $id_forma_pago = $_POST['id_forma_pago'];
                $id_accion = $_POST['id_accion'];
                $fecha = date("Y-m-d H:i:s");
                
                
                
                //-------------------------------------------------------------
                //------------INSERTAR MOVIMIENTO------------------------------
                $this->_movimiento->id_sesion_caja = $id_sesion_caja;
                $this->_movimiento->id_concepto_movimiento = $id_concepto_movimiento;
                $this->_movimiento->id_forma_pago = $id_forma_pago;
                $this->_movimiento->monto = $monto;
                $this->_movimiento->descripcion = $referencia;
                $this->_movimiento->fecha = $fecha;
                $ultimo = $this->_movimiento->inserta();
                $id_movimiento = $ultimo[0]["ULTIMO_ID"];

                //-------------------------------------------------------------
                // ---------------- ACTUALIZACION DE SALDO --------------------
                if($tipo_movimiento == "INGRESO"){
                    $this->_sesion_caja->aumenta=1;    
                }else if($tipo_movimiento == "EGRESO"){
                    $this->_sesion_caja->aumenta=0;
                }
                $this->_sesion_caja->id_sesion_caja = $id_sesion_caja;
                $this->_sesion_caja->monto_cierre=$monto;
                $this->_sesion_caja->actualiza_saldo();
                //-------------------------------------------------------------
                //----------------INSERTAR TABLA AMORTIZACIONES----------------
                if($tipo_movimiento == "INGRESO"){
                    
                    $this->_cronograma_cobro->id_venta = $id_accion;
                    $cuotas = $this->_cronograma_cobro->cuota_x_venta();
                    //print_r($cuotas);
                    for ($i = 0; $i < count($cuotas); $i++) {
                        if ($cuotas[$i]['MONTO_CUOTA'] > $cuotas[$i]['MONTO_PAGADO']) {
                            $monto_restantexcuota = $cuotas[$i]['MONTO_CUOTA'] - $cuotas[$i]['MONTO_PAGADO'];
                            if ($monto != 0) {
                                if ($monto_restantexcuota >= $monto) {
                                    //---------ACTUALIZAMOS TABLA CUOTA VENTAS-----------------------
                                    $this->_cronograma_cobro->id_cuota_venta = $cuotas[$i]['ID_CUOTA_VENTA'];
                                    $this->_cronograma_cobro->monto_pagado = $monto + $cuotas[$i]['MONTO_PAGADO'];
                                    if($monto_restantexcuota == $monto){
                                        $this->_cronograma_cobro->fecha_cancelacion = $fecha;      
                                    }else{
                                        $this->_cronograma_cobro->fecha_cancelacion = '1990-01-01';
                                    }
                                    $this->_cronograma_cobro->actualiza();
                                    //---------INSERTAMOS EN LA TABLA AMORTIZACINO-----------------------
                                    $this->_amortizacion_venta->id_cuota_venta = $cuotas[$i]['ID_CUOTA_VENTA'];
                                    $this->_amortizacion_venta->id_movimiento = $id_movimiento;
                                    $this->_amortizacion_venta->monto = $monto;
                                    $this->_amortizacion_venta->inserta();
                                    $monto = 0;
                                } else {

                                    $this->_cronograma_cobro->id_cuota_venta = $cuotas[$i]['ID_CUOTA_VENTA'];
                                    $this->_cronograma_cobro->monto_pagado = $cuotas[$i]['MONTO_CUOTA'];
                                    $this->_cronograma_cobro->fecha_cancelacion = $fecha; 
                                    $this->_cronograma_cobro->actualiza();
                                    //---------INSERTAMOS EN LA TABLA AMORTIZACINO-----------------------
                                    $this->_amortizacion_venta->id_cuota_venta = $cuotas[$i]['ID_CUOTA_VENTA'];
                                    $this->_amortizacion_venta->id_movimiento = $id_movimiento;
                                    $this->_amortizacion_venta->monto = $monto_restantexcuota;
                                    $this->_amortizacion_venta->inserta();
                                    $monto = $monto - $monto_restantexcuota;
                                }
                            }
                        }
                    }
                    
                    $this->_venta->id_venta = $cuotas[0]['ID_VENTA'];
                    
                    if($pago_total!=0){  $this->_venta->estado_pago = '1';      }
                    if($deuda_total == 0){ $this->_venta->estado_pago = '2';    }
                    if ($_POST['id_modalidad_t']=='CONTADO'){ $this->_venta->estado_pago = '2'; }
                    
                    $this->_venta->actualizar_estado();
                    
                }else if($tipo_movimiento == "EGRESO"){
                    
                    $this->_cronograma_pago->id_compra = $id_accion;
                    $cuotas = $this->_cronograma_pago->cuota_x_compra();
                    for ($i = 0; $i < count($cuotas); $i++) {
                        if ($cuotas[$i]['MONTO_CUOTA'] > $cuotas[$i]['MONTO_PAGADO']) {
                            $monto_restantexcuota = $cuotas[$i]['MONTO_CUOTA'] - $cuotas[$i]['MONTO_PAGADO'];
                            if ($monto != 0) {
                                if ($monto_restantexcuota >= $monto) {
                                    //---------ACTUALIZAMOS TABLA CUOTA COMPRAS-----------------------
                                    $this->_cronograma_pago->id_cuota_compra = $cuotas[$i]['ID_CUOTA_COMPRA'];
                                    $this->_cronograma_pago->monto_pagado = $monto + $cuotas[$i]['MONTO_PAGADO'];
                                    if($monto_restantexcuota == $monto){
                                        $this->_cronograma_pago->fecha_cancelacion = $fecha;      
                                    }else{
                                        $this->_cronograma_pago->fecha_cancelacion = '1990-01-01';
                                    }
                                    $this->_cronograma_pago->actualiza();
                                    //---------INSERTAMOS EN LA TABLA AMORTIZACINO-----------------------
                                    $this->_amortizacion_compra->id_cuota_compra = $cuotas[$i]['ID_CUOTA_COMPRA'];
                                    $this->_amortizacion_compra->id_movimiento = $id_movimiento;
                                    $this->_amortizacion_compra->monto = $monto;
                                    $this->_amortizacion_compra->inserta();
                                    $monto = 0;
                                } else {

                                    $this->_cronograma_pago->id_cuota_compra = $cuotas[$i]['ID_CUOTA_COMPRA'];
                                    $this->_cronograma_pago->monto_pagado = $cuotas[$i]['MONTO_CUOTA'];
                                    $this->_cronograma_pago->fecha_cancelacion = $fecha; 
                                    $this->_cronograma_pago->actualiza();
                                    //---------INSERTAMOS EN LA TABLA AMORTIZACINO-----------------------
                                    $this->_amortizacion_compra->id_cuota_compra = $cuotas[$i]['ID_CUOTA_COMPRA'];
                                    $this->_amortizacion_compra->id_movimiento = $id_movimiento;
                                    $this->_amortizacion_compra->monto = $monto_restantexcuota;
                                    $this->_amortizacion_compra->inserta();
                                    $monto = $monto - $monto_restantexcuota;
                                }
                            }
                        }
                    }
                    $this->_compra->id_compra = $cuotas[0]["ID_COMPRA"];
                    
                    if($pago_total!=0){   $this->_compra->estado_pago = '1';   }
                    if($deuda_total == 0){  $this->_compra->estado_pago = '2'; }
                    if ($_POST['id_modalidad_t']=='CONTADO'){ $this->_compra->estado_pago = '2'; }
                    
                    $this->_compra->actualizar_estado();
                }

                $this->redireccionar('movimiento');     

            }
            $this->_vista->datos = $this->_movimiento->selecciona();
            $this->_vista->titulo = 'Registrar Movimiento';
            $this->_vista->action = BASE_URL . 'movimiento/nuevo';
            $this->_vista->setCss_public(array('jquery.dataTables'));
            $this->_vista->setJs_public(array('jquery.dataTables.min'));
            $this->_vista->setJs(array('funciones_form','jquery-ui.min'));
            $this->_vista->renderizar('form');
        }else{
            echo "<script>alert('Aperture una Caja antes de Realizar cualquier Movimiento');</script>";
            $this->redireccionar('sesion_caja'); 
        }
            
    }
    public function extornar($id){
        $this->_movimiento->id_movimiento = $this->filtrarInt($id);
        $movimiento = $this->_movimiento->selecciona_id();
        if($movimiento[0]["ID_TIPO_MOVIMIENTO"]==1){
            $this->_amortizacion_compra->id_movimiento = $this->filtrarInt($id);
            $amortizacion_compra = $this->_amortizacion_compra->amortizacion_x_movimiento();
            for ($i=0; $i <count($amortizacion_compra) ; $i++) { 
                //--------------DATOS TABLA AMORTIZACION COMPRA ---------------------------
                $id_cuota_compra = $amortizacion_compra[$i]["ID_CUOTA_COMPRA"];
                $monto_amortizacion = $amortizacion_compra[$i]["MONTO"];
                //---------------------DATOS TABLA CUOTA COMPRA ---------------------------
                $this->_cronograma_pago->id_cuota_compra = $id_cuota_compra;
                $cronog = $this->_cronograma_pago->selecciona_id();
                print_r($cronog); exit;
                if($cronog[0]["MONTO_CUOTA"] == $cronog[0]["MONTO_PAGADO"]){

                }else{

                }


                $id_compra = $cronog[0]["ID_COMPRA"];    
                

                //echo $amortizacion_compra[$i]["ID_CUOTA_COMPRA"]."/".$amortizacion_compra[$i]["MONTO"]."<br>";    

            }
            exit;
        }else if($movimiento[0]["ID_TIPO_MOVIMIENTO"]==2){

        }


    }
    public function getActores(){
        $datos = $this->_movimiento->actores();
        echo json_encode($datos);
    }


}

?>
