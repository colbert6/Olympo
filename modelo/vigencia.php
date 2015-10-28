<?php

class vigencia extends Main{

    public $id_vigencia;
    public $descripcion;
    public $dias;

    public function selecciona() {
        //        echo '<pre>';print_r($datos);exit;
        $r = $this->get_consulta("pa_m1_vigencia", null);
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
        $datos = array($this->id_vigencia);
        $r = $this->get_consulta("pa_m2_vigencia", $datos);
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
        $datos = array($this->descripcion,$this->dias);
        $r = $this->get_consulta("pa_i_vigencia", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
        $datos = array($this->id_vigencia,$this->descripcion,$this->dias);
        $r = $this->get_consulta("pa_u_vigencia", $datos);       
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function elimina() {
        $datos = array($this->id_vigencia);
        $r = $this->get_consulta("pa_d_vigencia", $datos);
        $error = $r[1];
        
        $r = null;
        return $error;
    }

}

?>
