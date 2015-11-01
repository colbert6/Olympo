<?php

class movimiento extends Main{
    
    public $id_movimiento;
    public $id_sesion_caja;
    public $id_concepto_movimiento;
    public $id_forma_pago;
    public $id_serie_documento;
    public $monto;
    public $extornado;

    public function selecciona() {
  
        $r = $this->get_consulta("pa_m1_compra", null);
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
    public function selecciona_id() {
        $datos=array($this->id_compra);
//        echo '<pre>';print_r($datos);exit;
        $r = $this->get_consulta("pa_m2_compra", $datos);
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

    public function inserta() {
        $datos = array($this->id_proveedor,$this->id_empleado, $this->id_modalidad_transaccion, $this->fecha, $this->monto, $this->num_documento, $this->igv);
        $r = $this->get_consulta("pa_i_compra", $datos);
//        echo '<pre>';print_r($datos);exit;
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

    public function elimina() {
        $datos = array($this->id_compra);
        $r = $this->get_consulta("pa_d_compra", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

}

?>
