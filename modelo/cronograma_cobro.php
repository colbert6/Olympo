<?php

class cronograma_cobro extends Main{

    public $id_cuota_venta;
    public $id_venta;
    public $fecha_venc;
    public $monto_cuota;
    public $num_cuota;
    public $monto_pagado;
    public $fecha_cancelacion;
    
    public function selecciona() {
        $r = $this->get_consulta("pa_m1_cuve",null);
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
    public function selecciona_cuota() {
        $datos = array($this->id_venta);
        
        $r = $this->get_consulta("pa_m2_cuve",$datos);
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
     public function selecciona_id(){
        
        $datos = array($this->id_cuota_venta);
        $r = $this->get_consulta("pa_m3_cuve",$datos);
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
    
    public function inserta() {
        $datos = array($this->id_venta,$this->fecha_venc,$this->num_cuota,$this->monto_cuota);
        $r = $this->get_consulta("pa_i_cuve", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
        $datos = array($this->id_cuota_venta, $this->monto_pagado,$this->fecha_cancelacion);
        $r = $this->get_consulta("pa_u_cuve", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function elimina() {
        $datos = array($this->id_almacen);
        $r = $this->get_consulta("pa_d_cuco", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    public function cuota_x_venta() {
        $datos = array($this->id_venta);
        $r = $this->get_consulta("pa_cuotas_venta",$datos);
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
