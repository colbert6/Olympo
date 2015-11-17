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

    public function elimina(){
        $datos = array($this->id_movimiento);
        $r = $this->get_consulta("pa_d_amve", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    public function amortizacion_x_movimiento(){
        $datos = array($this->id_movimiento);
        $r = $this->get_consulta("pa_m2_amve", $datos);
        if ($r[1] == '') {
            $stmt = $r[0];
        } else {
            die($r[1]);
        }
        $r = null;
        if (BaseDatos::$_servidor == 'oci') {
            oci_fetch_all($stmt, $data, null, null, OCI_FETCHSTATEMENT_BY_ROW);
            return $data;
        } else {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchall();
        }
    }


}

?>
