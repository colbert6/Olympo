<?php

class sesion_caja_controlador extends controller {

    private $_sesion_caja;
    private $_caja;
    private $_pdf;

    public function __construct() {
        if (!$this->acceso()) {
            $this->redireccionar('error/access/5050');
        }
        parent::__construct();
        $this->get_Libreria('fpdf/fpdf2');
        $this->_pdf = new FPDF('P','mm','A4');
        $this->_sesion_caja = $this->cargar_modelo('sesion_caja');
        $this->_caja = $this->cargar_modelo('caja');
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
        $this->_pdf->AddPage();

        $this->_pdf->SetFont('Arial', 'B', 12);
        $this->_pdf->SetY(27);
        $this->_pdf->SetX(15);
        $this->_pdf->Cell(270, 5, utf8_decode('MOVIMIENTOS DE LA FECHA:'), 0, 0, 'C');
        $this->_pdf->SetFillColor(96,197,253);
        $this->_pdf->SetFont('Arial', 'B', 10);
        $this->_pdf->SetY(35);
        $this->_pdf->SetX(15);
        $this->_pdf->Cell(135, 6, utf8_decode('INGRESOS'), 'BTLR', 0, 'C', 1);
        $this->_pdf->SetX(150);
        $this->_pdf->Cell(135, 6, utf8_decode('EGRESOS'), 'BTLR', 0, 'C', 1);
        $this->_pdf->SetY(41);
        $this->_pdf->SetX(15);
        $this->_pdf->Cell(20, 6, utf8_decode('Hora'), 'BTLR', 0, 'R', 1);
        $this->_pdf->SetX(35);
        $this->_pdf->Cell(55, 6, utf8_decode('Concepto'), 'BTLR', 0, 'L', 1);
        $this->_pdf->SetX(90);
        $this->_pdf->Cell(40, 6, utf8_decode('Forma de Pago'), 'BTLR', 0, 'L', 1);
        $this->_pdf->SetX(130);
        $this->_pdf->Cell(20, 6, utf8_decode('Monto'), 'BTLR', 0, 'R', 1);
        $this->_pdf->SetX(150);
        $this->_pdf->Cell(20, 6, utf8_decode('Hora'), 'BTLR', 0, 'R', 1);
        $this->_pdf->SetX(170);
        $this->_pdf->Cell(55, 6, utf8_decode('Concepto'), 'BTLR', 0, 'L', 1);
        $this->_pdf->SetX(225);
        $this->_pdf->Cell(40, 6, utf8_decode('Forma de Pago'), 'BTLR', 0, 'L', 1);
        $this->_pdf->SetX(265);
        $this->_pdf->Cell(20, 6, utf8_decode('Monto'), 'BTLR', 0, 'R', 1);



        $this->_pdf->Output();
    }

}

?>
