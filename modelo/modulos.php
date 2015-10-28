<?php

class modulos extends Main{

    public $id_modulo;
    public $nombre;
    public $url;
    public $orden;
    public $estado;
    public $id_modulo_padre;
    public $modulo_padre;
    public $id_perfil_usuario;
    public $icono;

    public function selecciona() {
        //        echo '<pre>';print_r($datos);exit;
        
        $r = $this->get_consulta("pa_m1_modulo", null);
        if ($r[1] == '') {
            $stmt = $r[0];
        } else {
            die($r[1]);
        }
        $r = null;
        if (BaseDatos::$_servidor == 'OCI') {
            oci_fetch_all($stmt, $data, null, null, OCI_FETCHSTATEMENT_BY_ROW);
            print_r($data);exit;
            return $data;
            
        } else {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchall();
        }
    }
    public function selecciona_menu() {
        //        echo '<pre>';print_r($datos);exit;
        $datos = array($this->id_perfil_usuario);
        $r = $this->get_consulta("pa_menu", $datos);
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
    
    public function seleccionaxurl() {
        if (is_null($this->url)) {
            $this->url= '';
        }
        $datos = array($this->url);
//        echo '<pre>';print_r($datos);exit;
        $r = $this->get_consulta("pa_m3_modulo", $datos);
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
    
    public function selecciona_padre($idmodulo_padre) {
        $datos = array($idmodulo_padre);
        $r = $this->get_consulta("pa_m2_modulo", $datos);
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
    
    public function selecciona_id() {
        $datos = array($this->id_modulo);
        $r = $this->get_consulta("pa_m4_modulo", $datos);
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
        $datos = array( $this->nombre, $this->url,$this->orden,$this->id_padre, $this->modulo_padre, $this->icono);
        $r = $this->get_consulta("pa_i_modulo", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
        $datos = array($this->id_modulo, $this->nombre, $this->url, $this->orden,
            $this->id_padre,$this->modulo_padre, $this->icono);
        $r = $this->get_consulta("pa_u_modulo", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function elimina() {
        $datos = array($this->id_modulo);
        $r = $this->get_consulta("pa_d_modulo", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

}

?>
