<?php

class usuario extends Main{

    public $id_usuario;
    public $id_actor;
    public $usuario;
    public $clave;
    public $tipo_actor;
    public $id_perfil_usuario;
    
    public function inserta() {
        $datos = array($this->id_actor,$this->usuario,$this->clave,$this->tipo_actor,
                        $this->id_perfil_usuario);
        $r = $this->get_consulta("pa_i_usuario", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
       
        $datos = array($this->usuario,$this->clave);
    
        $r = $this->get_consulta("pa_u_usuario", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    
    public function login($usuario,$clave) {
        $datos = array($usuario,$clave);
        $r = $this->get_consulta("pa_usuario", $datos);
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

    
    public function validaAdmin($usuario,$clave){
        $datos = array($usuario,$clave);
        $r = $this->get_consulta("valida_admin", $datos);
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

    

}

?>
