<?php

class venta extends Main{
    
    public $id_venta;
    public $id_cliente;
    public $id_empleado;
    public $id_tipopago;
    public $fechaventa;
    public $subtotal;
    public $igv;
    public $id_tipocomprobante;
    public $nrodoc;
    public $estadopago;
    public $cliente;
    public $empleado;

    public function selecciona() {
         $r = $this->get_consulta("pa_m1_venta", null);
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
        $datos=array($this->id_venta);
         $r = $this->get_consulta("pa_m3_venta", $datos);
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
        $datos = array($this->id_cliente, $this->id_empleado, $this->id_tipopago, $this->fechaventa, $this->subtotal, 
             $this->nrodoc,$this->igv, $this->id_tipocomprobante);
        $r = $this->get_consulta("pa_i_venta", $datos);
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
        $datos = array($this->id_venta);
        $r = $this->get_consulta("elim_venta", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

}

?>