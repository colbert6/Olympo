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
    public function elimina(){
        $datos = array($this->id_movimiento);
        $r = $this->get_consulta("pa_d_amco", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    public function amortizacion_x_movimiento(){
        $datos = array($this->id_movimiento);
        $r = $this->get_consulta("pa_m2_amco", $datos);
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
