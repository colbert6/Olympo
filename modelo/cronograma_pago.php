<?php

class cronograma_pago extends Main{

    public $id_cuota_pago;
    public $id_compra;
    public $fecha;
    public $monto_cuota;
    public $nrocuota;
    public $monto_pagado;
    
    public function selecciona() {
        $r = $this->get_consulta("pa_m1_cuco",null);
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
        
      
        $datos = array($this->id_compra);
        
        $r = $this->get_consulta("pa_m2_cuco",$datos);
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
        $datos = array($this->descripcion);
        $r = $this->get_consulta("pa_i_almacen", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
       
        $datos = array($this->id_almacen, $this->descripcion);
        
        $r = $this->get_consulta("pa_u_almacen", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    

    public function elimina() {
        $datos = array($this->id_almacen);
        $r = $this->get_consulta("pa_d_almacen", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    

}

?>
