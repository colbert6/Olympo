<?php

class serie_comprobante extends Main{

    public $id_serie_documento;
    public $codigo;
    public $numero;
    public $id_tipo_documento;
    public $max_numero;

    
    public function selecciona_num() {
        
        $datos = array($this->id_tipo_documento);
//        print_r($datos);exit;
        $r = $this->get_consulta("pa_m2_sedo", $datos);
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
    public function elimina() {
        $datos = array($this->id_serie_documento);
        $r = $this->get_consulta("pa_d_sedo", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function inserta() {
        $datos = array($this->id_tipo_documento, $this->codigo, $this->maxcorrelativo);
        $r = $this->get_consulta("pa_i_sedo", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    
    public function act_correlativo(){
        $datos = array($this->id_serie_documento, $this->numero);
        $r = $this->get_consulta("pa_u_sedo", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

}

?>
