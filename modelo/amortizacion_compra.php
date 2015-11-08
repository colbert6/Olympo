<?php

class amortizacion_compra extends Main{
    
    public $id_amortizacion_compra;
    public $id_cuota_compra;
    public $id_movimiento;
    public $monto;

    public function inserta(){
        $datos = array($this->id_cuota_compra, $this->id_movimiento, $this->monto);
        $r = $this->get_consulta("pa_i_amco", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }


}

?>
