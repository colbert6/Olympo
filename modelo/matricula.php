<?php

class matricula extends Main{

    public $id_matricula;
    public $id_tipo_membresia;
    public $id_socio;
    public $estado;
    public $estado_pago;
    public $costo;
    public $fecha_registro;
    public $fecha_inicio;
    public $fecha_fin;
    public $id_servicio;
    
    public function selecciona() {
        $r = $this->get_consulta("pa_m1_matricula",null);
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
        $datos = array($this->id_matricula);
        $r = $this->get_consulta("pa_m2_matricula",$datos);
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
    public function selecciona_vigentes() {
        $r = $this->get_consulta("pa_m3_matricula",null);
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
        $datos = array($this->id_tipo_membresia,$this->id_socio,$this->fecha_registro,$this->fecha_registro,
                    $this->fecha_registro,$this->costo,$this->estado_pago);
        $r = $this->get_consulta("pa_i_matricula", $datos);
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
    public function inserta_mat_serv() {
        $datos = array($this->id_matricula,$this->id_servicio,'1');
        $r = $this->get_consulta("pa_i_mat_serv", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    public function actualiza() {
       
        $datos = array($this->id_tipo_membresia,$this->id_socio,$this->fecha_registro,$this->fecha_registro,
                    $this->fecha_registro,$this->costo,$this->estado_pago);
        $r = $this->get_consulta("pa_u_matricula", $datos);
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
    public function elimina() {
        $datos = array($this->id_matricula);
        $r = $this->get_consulta("pa_d_matricula", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    public function reinicio_estado_pago() {
        $datos = array($this->id_matricula);
        $r = $this->get_consulta("pa_d2_matricula", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    
    

}

?>
