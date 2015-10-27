<?php

class perfiles extends Main{

    public $id_perfil_usuario;
    public $descripcion;

    public function selecciona() {
        $r = $this->get_consulta("pa_m1_peus", null);
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
        };
    }
    public function selecciona_id() {
        $datos=array($this->id_perfil_usuario);
        $r = $this->get_consulta("pa_m2_peus", $datos);
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
        };
    }

    public function elimina() {
        $datos = array($this->id_perfil_usuario);
        $r = $this->get_consulta("pa_d_peus", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function inserta() {
        $datos = array($this->descripcion);
        $r = $this->get_consulta("pa_i_peus", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
        $datos = array($this->id_perfil_usuario, $this->descripcion);
        $r = $this->get_consulta("pa_u_peus", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

}

?>
