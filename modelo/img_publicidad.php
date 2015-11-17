<?php

class img_publicidad extends Main{

    public $id_img_publicidad;
    public $imagen;
    public $nombre;
    public $estado;
    
    public function selecciona() {
        $r = $this->get_consulta("pa_m1_impu",null);
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
        
      
        $datos = array($this->id_img_publicidad);
        
        $r = $this->get_consulta("pa_m2_impu",$datos);
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
        $datos = array($this->imagen,$this->nombre);
        $r = $this->get_consulta("pa_i_impu", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
        //print_r($this->_model->actualiza());exit();
        $datos = array($this->id_img_publicidad,$this->imagen,$this->nombre);
        
        $r = $this->get_consulta("pa_u_impu", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    

    public function elimina() {
        $datos = array($this->id_img_publicidad);
        $r = $this->get_consulta("pa_d_impu", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    

}

?>