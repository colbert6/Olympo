<?php

class web_servicio extends Main{

    public $id_web_servicio;
    public $imagen;
    public $titulo;
    public $descripcion;
    public $estado;
    
    public function selecciona() {
        $r = $this->get_consulta("pa_m1_weser",null);
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
        
      
        $datos = array($this->id_web_servicio);
        
        $r = $this->get_consulta("pa_m2_weser",$datos);
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
        $datos = array($this->imagen,$this->titulo,$this->descripcion);
        $r = $this->get_consulta("pa_i_weser", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
       
        $datos = array($this->id_web_servicio,$this->imagen,$this->titulo, $this->descripcion);
        
        $r = $this->get_consulta("pa_u_weser", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    

    public function elimina() {
        $datos = array($this->id_web_servicio);
        $r = $this->get_consulta("pa_d_weser", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    

}

?>


