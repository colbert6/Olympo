<?php

class concepto_movimiento extends Main{

    public $id_concepto_movimiento;
    public $id_tipo_movimiento;
    public $descripcion;
    
    public function selecciona() {
        $r = $this->get_consulta("pa_m1_como",null);
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
    public function selecciona_id() {
        
      
        $datos = array($this->id_concepto_movimiento);
        
        $r = $this->get_consulta("pa_m2_como",$datos);
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

     public function selecciona_x_tipo() {
        
        $datos = array($this->id_tipo_movimiento);
        
        $r = $this->get_consulta("pa_m3_como",$datos);
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
        
        $datos = array($this->id_tipo_movimiento,$this->descripcion);
        $r = $this->get_consulta("pa_i_como", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
       
        $datos = array($this->id_concepto_movimiento,$this->id_tipo_movimiento,$this->descripcion);
        
        $r = $this->get_consulta("pa_u_como", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    

    public function elimina() {
        $datos = array($this->id_concepto_movimiento);
        $r = $this->get_consulta("pa_d_como", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    

}

?>


