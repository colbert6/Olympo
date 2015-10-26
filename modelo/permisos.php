<?php

class permisos extends Main{

    public $id_perfil_usuario;
    public $id_modulo;
    public $estado;
    public $url;
    
    public function valida_acceso(){
        $datos = array($this->id_perfil_usuario, $this->url);
        $r = $this->get_consulta("pa_acceso", $datos);
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

    public function selecciona() {
        $datos = array($this->id_perfil_usuario);
//        echo '<pre>';print_r($datos);exit;
        $r = $this->get_consulta("pa_m1_permisos", $datos);
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
        $datos = array($this->id_perfil_usuario, $this->id_modulo,'0');
//        echo '<pre>';print_r($datos);exit;
        $r = $this->get_consulta("pa_u_permisos", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function inserta() {
        $datos = array($this->id_perfil_usuario, $this->id_modulo,'1');
//        print_r($datos);exit;
        $r = $this->get_consulta("pa_u_permisos", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
        $datos = array($this->idperfil, $this->idmodulo, $this->estado);
        $r = $this->get_consulta("pa_inserta_actualiza_permisos", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
}

?>