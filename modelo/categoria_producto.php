<?php

class categoria_producto extends Main{

    public $id_categoria_producto;
    public $descripcion;
    public $estado;
    
    public function selecciona() {
        $r = $this->get_consulta("pa_m1_capr",null);
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
        $datos = array($this->id_categoria_producto);
        
        $r = $this->get_consulta("pa_m2_capr",$datos);
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
        $r = $this->get_consulta("pa_i_capr", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function edita() {
       
        $datos = array($this->id_categoria_producto,$this->descripcion);
        $r = $this->get_consulta("pa_u_capr", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    

    public function elimina() {
        $datos = array($this->id_categoria_producto);
        $r = $this->get_consulta("pa_d_capr", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    

}

?>


