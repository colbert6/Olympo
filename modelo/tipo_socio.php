<?php

class tipo_socio extends Main{

    public $id_tipo_socio;
    public $descripcion;

    public function selecciona() {
        //        echo '<pre>';print_r($datos);exit;
        $r = $this->get_consulta("pa_m1_tiso", null);
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
        $datos = array($this->id_tipo_socio);
        $r = $this->get_consulta("pa_m2_tiso", $datos);
        if ($r[1] == '') {
            $stmt = $r[0];
        } else {
            die($r[1]);
        }
         if (BaseDatos::$_servidor == 'oci') {
            oci_fetch_all($stmt, $data, null, null, OCI_FETCHSTATEMENT_BY_ROW);
            return $data;
        } else {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchall();
        }
    }
    
    public function inserta() {
        $datos = array($this->descripcion);
        $r = $this->get_consulta("pa_i_tiso", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
        $datos = array($this->id_tipo_socio,$this->descripcion);
        $r = $this->get_consulta("pa_u_tiso", $datos);       
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function elimina() {
        $datos = array($this->id_tipo_socio);
        $r = $this->get_consulta("pa_d_tiso", $datos);
        $error = $r[1];
        
        $r = null;
        return $error;
    }

}

?>
