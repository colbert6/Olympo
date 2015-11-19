<?php

class compra extends Main{
    
    public $id_compra;
    public $id_proveedor;
    public $id_empleado;
    public $id_modalidad_transaccion;
    public $fecha;
    public $monto;
    public $estado;
    public $num_documento;
    public $igv;
    public $estado_pago;
    public $retraso;

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
    //act_est_compra
     public function actualizar_estado() {
        $datos = array($this->id_compra,$this->estado_pago);
        $r = $this->get_consulta("act_est_compra", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    public function actualizar_retraso() {
        $datos = array($this->id_compra,$this->retraso);
        $r = $this->get_consulta("act_ret_compra", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    public function compras_x_proveedor() {
        $datos=array($this->id_proveedor);
        $r = $this->get_consulta("pa_proxcomp", $datos);
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
