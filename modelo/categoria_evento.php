<?php

class categoria_evento extends Main{

    public $id_categoria_evento;
    public $descripcion;
    public $estado;
    
    public function selecciona() {
        $r = $this->get_consulta("pa_m1_caev",null);
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
        $datos = array($this->id_categoria_evento);
        
        $r = $this->get_consulta("pa_m2_caev",$datos);
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
        $datos = array($this->descripcion);
        $r = $this->get_consulta("pa_i_caev", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function edita() {
       
        $datos = array($this->id_categoria_evento,$this->descripcion);
        $r = $this->get_consulta("pa_u_caev", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    

    public function elimina() {
        $datos = array($this->id_categoria_evento);
        $r = $this->get_consulta("pa_d_caev", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    

}

?>


