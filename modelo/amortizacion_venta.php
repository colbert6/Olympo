<?php

class amortizacion_venta extends Main{
    
    public $id_amortizacion_venta;
    public $id_cuota_venta;
    public $id_movimiento;
    public $monto;

    public function inserta(){
        $datos = array($this->id_cuota_venta, $this->id_movimiento, $this->monto);
        $r = $this->get_consulta("pa_i_amve", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }


}

?>
