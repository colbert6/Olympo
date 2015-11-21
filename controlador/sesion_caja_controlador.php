<?php

class sesion_caja_controlador extends controller {

    private $_sesion_caja;
    private $_caja;
    private $_pdf;
    private $_movimiento;
    private $_sesion;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->get_Libreria('fpdf/fpdf2');
        $this->_pdf = new FPDF('L','mm','A4');
        $this->_sesion_caja = $this->cargar_modelo('sesion_caja');
        $this->_caja = $this->cargar_modelo('caja');
        $this->_movimiento = $this->cargar_modelo('movimiento');
        $this->_sesion = $this->cargar_modelo('sesion_caja');
    }

    public function index() {
        $this->_vista->titulo = 'Administrar Cajas';
        $this->_vista->e_caja = $this->_sesion_caja->selecciona();
        $this->_vista->empleado = session::get('id_empleado');
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->setJs(array('funciones_form'));
        $this->_vista->renderizar('index');
    }
    public function aperturar(){
        $this->_sesion_caja->id_caja = $_POST['id'];
        $this->_sesion_caja->id_empleado = session::get('id_empleado');
        $this->_sesion_caja->fecha_entrada = date("Y-m-d H:i:s");
        $this->_sesion_caja->monto_inicio = $_POST['monto'];
        $this->_sesion_caja->estado = 1;
        $this->_sesion_caja->inserta(); 
    }
    public function cerrar($id){
        $this->_sesion_caja->id_caja = $this->filtrarInt($id);
        $sesion_activa = $this->_sesion_caja->sesiones_caja();
        if($sesion_activa[0]["ID_EMPLEADO"]!=session::get('id_empleado')){
            echo '<script>alert("Usted No es es el Empleado que aperturo Caja")</script>';
            $this->redireccionar('sesion_caja');
        }
        $this->_sesion_caja->id_caja = $this->filtrarInt($id);
        $this->_sesion_caja->fecha_salida = date("Y-m-d H:i:s");
        $this->_sesion_caja->estado = 0;
        $this->_sesion_caja->actualiza();
        $this->redireccionar('sesion_caja');
    }

    public function sesiones_activas(){
        $sesiones = $this->_sesion_caja->cajas_activas();
        echo json_encode($sesiones);
    }
    public function historial($id){
        $this->_caja->id_caja = $this->filtrarInt($id);
        $caja = $this->_caja->selecciona_id();
        $this->_vista->titulo = 'Lista de Sesiones => '.strtoupper($caja[0]["NOMBRE"]);
        $this->_sesion_caja->id_caja = $this->filtrarInt($id);
        $this->_vista->e_caja = $this->_sesion_caja->sesiones_caja();
        $this->_vista->setCss_public(array('jquery.dataTables'));
        $this->_vista->setJs_public(array('jquery.dataTables.min','run_table'));
        $this->_vista->renderizar('historial');
    }

    public function reporte_movimientos($id){
        $caja = $this->_sesion->cajas_activas();
        for ($i=0; $i < count($caja) ; $i++) { 
            if($caja[$i]["ID_SESION_CAJA"]==$id){
                $id_caja = $caja[$i]["ID_CAJA"];
                $monto_inicio = $caja[$i]["MONTO_INICIO"];
                $nombre_caja = $caja[$i]["CAJA"];
            }
        }
        // --------------EXTRER MOVIMIENTOS--------------
        $this->_movimiento->id_sesion_caja = $this->filtrarInt($id);
        $mov = $this->_movimiento->selecciona_reporte(); 


        $this->_pdf->AddPage();
        $s = array(20,30,100,33,33,33,25);
        $this->_pdf->SetFont('Arial', 'B', 12);
        $this->_pdf->SetY(30);
        $this->_pdf->SetX(30);
        $this->_pdf->Cell(240, 5, utf8_decode('MOVIMIENTOS DE HOY: '.strtoupper($nombre_caja)), 0, 0, 'C');
        $this->_pdf->SetY(31);
        $this->_pdf->Cell(280, 5, utf8_decode('______________________________'), 0, 0, 'C');
        $this->_pdf->ln(6);
        $this->_pdf->SetFont('Arial', 'B', 10);
        $this->_pdf->Cell(280, 5, utf8_decode('FORMA PAGO: Efectivo '), 0, 0, 'C');
        $this->_pdf->SetFillColor(96,197,253);
        $this->_pdf->SetFont('Arial', 'B', 10);
        $this->_pdf->ln(10);
        $this->_pdf->Cell($s[0], 6, utf8_decode('HORA'), 1, 0, 'C', 1);
        $this->_pdf->Cell($s[1], 6, utf8_decode('MOVIMIENTO'), 1, 0, 'C', 1);
        $this->_pdf->Cell($s[2], 6, utf8_decode('CONCEPTO'), 1, 0, 'C', 1);
        $this->_pdf->Cell($s[3], 6, utf8_decode('ENTRADA'), 1, 0, 'C', 1);
        $this->_pdf->Cell($s[4], 6, utf8_decode('SALIDA'), 1, 0, 'C', 1);
        $this->_pdf->Cell($s[5], 6, utf8_decode('SALDO (S/.)'), 1, 0, 'C', 1);
        $this->_pdf->Cell($s[6], 6, utf8_decode('OBSER.'), 1, 0, 'C', 1);
        $this->_pdf->ln();
        //AQUI EMPIEZAAAAAAA
        $this->_pdf->Cell($s[0], 6, utf8_decode(''), 1, 0, 'C', 0);
        $this->_pdf->Cell($s[1], 6, utf8_decode(''), 1, 0, 'C', 0);
        $this->_pdf->Cell($s[2], 6, utf8_decode('MONTO DE APERTURA'), 1, 0, 'L', 0);
        $this->_pdf->Cell($s[3], 6, utf8_decode(''), 1, 0, 'C', 0);
        $this->_pdf->Cell($s[4], 6, utf8_decode(''), 1, 0, 'C', 0);
        $this->_pdf->Cell($s[5], 6, utf8_decode($monto_inicio), 1, 0, 'C', 0);
        $this->_pdf->Cell($s[6], 6, utf8_decode(''), 1, 0, 'C', 0);
        $this->_pdf->ln();
        //--------------------------------------------------------------------------------------
        $saldo = $monto_inicio;
        $this->_pdf->SetFillColor(245,208,051);
        for ($i=0; $i < count($mov) ; $i++) { 
            if($mov[$i]["EXTORNADO"]==1){$color=1;}else{$color=0;}
            $date = new DateTime($mov[$i]["FECHA"]);
            $this->_pdf->Cell($s[0], 6, utf8_decode($date->format('H:i:s')), 1, 0, 'C', $color);
            $this->_pdf->Cell($s[1], 6, utf8_decode($mov[$i]["TIPO_MOVIMIENTO"]), 1, 0, 'C', $color);
            $this->_pdf->Cell($s[2], 6, utf8_decode($mov[$i]["CONCEPTO_MOVIMIENTO"]), 1, 0, 'L', $color);
            if($mov[$i]["ID_TIPO_MOVIMIENTO"]==2){
                $this->_pdf->Cell($s[3], 6, utf8_decode($mov[$i]["MONTO"]), 1, 0, 'C', $color);
                if($mov[$i]["EXTORNADO"]==0){$saldo += $mov[$i]["MONTO"];}
            }else{
                $this->_pdf->Cell($s[3], 6, utf8_decode(''), 1, 0, 'C', $color);
            }
            if($mov[$i]["ID_TIPO_MOVIMIENTO"]==1){
                $this->_pdf->Cell($s[4], 6, utf8_decode($mov[$i]["MONTO"]), 1, 0, 'C', $color);
                if($mov[$i]["EXTORNADO"]==0){$saldo -= $mov[$i]["MONTO"];}
            }else{
                $this->_pdf->Cell($s[4], 6, utf8_decode(''), 1, 0, 'C', $color);
            }
            $this->_pdf->Cell($s[5], 6, utf8_decode($saldo), 1, 0, 'C', $color);
            if($mov[$i]["EXTORNADO"]==1){
                $this->_pdf->Cell($s[6], 6, utf8_decode('EXTORNADO'), 1, 0, 'C', $color);
            }else{
                $this->_pdf->Cell($s[6], 6, utf8_decode(''), 1, 0, 'C', $color);
            }
            $this->_pdf->ln();
        }
        //PARA TERMINAR
        $this->_pdf->Cell($s[0], 6, utf8_decode(''), 0, 0, 'C', 0);
        $this->_pdf->Cell($s[1], 6, utf8_decode(''), 0, 0, 'C', 0);
        $this->_pdf->Cell($s[2], 6, utf8_decode(''), 0, 0, 'L', 0);
        $this->_pdf->Cell($s[3], 6, utf8_decode(''), 0, 0, 'C', 0);
        $this->_pdf->Cell($s[4], 6, utf8_decode('SALDO ACTUAL'), 1, 0, 'C', 0);
        $this->_pdf->Cell($s[5], 6, utf8_decode('S/.'.$saldo), 1, 0, 'C', 0);
        $this->_pdf->Cell($s[6], 6, utf8_decode(''), 0, 0, 'C', 0);
        $this->_pdf->ln();



        $this->_pdf->Output();
    }

}

?>
