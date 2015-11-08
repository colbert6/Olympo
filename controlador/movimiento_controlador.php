<?php

class movimiento_controlador extends controller {

    private $_movimiento;
    private $_sesion_caja;
    private $_amortizacion_compra;
    private $_cronograma_pago;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->_movimiento = $this->cargar_modelo('movimiento');
        $this->_sesion_caja = $this->cargar_modelo('sesion_caja');
        $this->_amortizacion_compra = $this->cargar_modelo('amortizacion_compra');
        $this->_cronograma_pago = $this->cargar_modelo('cronograma_pago');
    } 

    public function index() {
        $this->_vista->titulo = 'Lista de Movimientos';
        //$this->_vista->setJs(array('funcion'));
        $this->_vista->datos = $this->_movimiento->selecciona();
        //print_r($this->_vista->datos);exit;
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
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
            }
        }
        if($emp_existente){
            if(new DateTime((substr($fecha_sesion,0,10)),new DateTimeZone('America/Lima'))!=new DateTime(date('d-m-Y'),new DateTimeZone('America/Lima'))){
                echo '<script>alert("Cierre la caja de fecha pasada y aperture la caja para el dia de hoy")</script>';
                $this->redireccionar('sesion_caja');
            }
            if($_POST['guardar']==1){
                //--------VARIABLES--------------------------------------------
                $id_concepto_movimiento = $_POST['id_concepto_movimiento'];
                $tipo_movimiento = $_POST['tipo_movimiento'];
                $id_forma_pago = $_POST['id_forma_pago'];
                $monto = $_POST['importe'];
                $referencia = $_POST['referencia'];
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

                }else if($tipo_movimiento == "EGRESO"){
                    $this->_cronograma_pago->id_compra = $id_accion;
                    $cuotas = $this->_cronograma_pago->cuota_x_compra;
                    for ($i = 0; $i < count($cuotas); $i++) {
                        if ($cuotas[$i]['MONTO_CUOTA'] > $cuotas[$i]['MONTO_PAGADO']) {
                            $monto_restantexcuota = $cuotas[$i]['MONTO_CUOTA'] - $cuotas[$i]['MONTO_PAGADO'];
                            if ($monto != 0) {
                                if ($monto_restantexcuota >= $monto) {
                                    //actualiza monto_pagado en cuota_pago
                                    $this->_cronogcobro->id_cronogcobro = $datos_cronogcobro[$i]['ID_CRONOGCOBRO'];
                                    $this->_cronogcobro->id_venta= $idventa;
                                    $this->_cronogcobro->monto = $monto_amortizado + $datos_cronogcobro[$i]['MONTO_COBRADO'];
                                    $this->_cronogcobro->nrocuota = $datos_cronogcobro[$i]['NROCUOTA'];
                                    $this->_cronogcobro->actualiza();
                                    $monto = 0;
                                } else {
                                    //actualiza monto_pagado en cuota_pago
                                    $this->_cronogcobro->id_cronogcobro = $datos_cronogcobro[$i]['ID_CRONOGCOBRO'];
                                    $this->_cronogcobro->id_venta= $idventa;
                                    $this->_cronogcobro->monto = $datos_cronogcobro[$i]['MONTO_CUOTA'];
                                    $this->_cronogcobro->nrocuota = $datos_cronogcobro[$i]['NROCUOTA'];
                                    $this->_cronogcobro->actualiza();
                                    $monto_amortizado = $monto_amortizado - $monto_restantexcuota;
                                }
                            }
                        }
                    }
                }

                $id_movimiento = $ultimo[0]["ULTIMO_ID"];
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


    public function getActores(){
        $datos = $this->_movimiento->actores();
        echo json_encode($datos);
    }


}

?>
