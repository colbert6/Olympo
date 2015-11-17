<?php

class movimiento extends Main{
    
    public $id_movimiento;
    public $id_sesion_caja;
    public $id_concepto_movimiento;
    public $id_forma_pago;
    public $monto;
    public $descripcion;
    public $fecha;
    public $extornado;

    public function selecciona() {
        $r = $this->get_consulta("pa_m1_movimiento", null);
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
        $datos = array($this->id_movimiento);
        $r = $this->get_consulta("pa_m2_movimiento", $datos);
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
        $datos = array($this->id_sesion_caja,$this->id_concepto_movimiento, $this->id_forma_pago,
                      $this->monto,$this->descripcion,$this->fecha);
        $r = $this->get_consulta("pa_i_movimiento", $datos);

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

    public function extorna(){
        $datos = array($this->id_movimiento);
        $r = $this->get_consulta("pa_u_movimiento", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    public function actores() {
        $r = $this->get_consulta("pa_actores",null);
        if ($r[1] == '') {
            $stmt = $r[0];
        } else {
            die($r[1]);
        }
        $r = null;
        if (BaseDatos::$_servidor == 'OCI') {
            oci_fetch_all($stmt, $data, null, null, OCI_FETCHSTATEMENT_BY_ROW);
            return $data;
        } else {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchall();
        }   
    }

}

?>
