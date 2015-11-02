<?php

class membresia extends Main{

    public $id_tipo_membresia;
    public $descripcion;
    public $numero_servicios;
    public $duracion;
    public $vigencia;
    public $precio;
    public $estado;

    public function selecciona() {
        //        echo '<pre>';print_r($datos);exit;
        $r = $this->get_consulta("pa_m1_time", null);
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
        $datos = array($this->id_tipo_membresia);
        $r = $this->get_consulta("pa_m2_time", $datos);
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
        $datos = array($this->descripcion,$this->numero_servicios,$this->duracion,$this->vigencia,$this->precio);
        $r = $this->get_consulta("pa_i_time", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
        $datos = array($this->id_tipo_membresia,$this->descripcion,$this->numero_servicios,$this->duracion,$this->vigencia,$this->precio);
        $r = $this->get_consulta("pa_u_time", $datos);       
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function elimina() {
        $datos = array($this->id_tipo_membresia);
        $r = $this->get_consulta("pa_d_time", $datos);
        $error = $r[1];
        
        $r = null;
        return $error;
    }

}

?>
