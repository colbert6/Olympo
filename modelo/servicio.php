<?php

class servicio extends Main{

    public $id_servicio;
    public $id_ambiente;
    public $nombre;
    public $descripcion;
    public $estado;
    
    public function selecciona() {
        $r = $this->get_consulta("pa_m1_servicio",null);
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
        
        $datos = array($this->id_servicio);
        
        $r = $this->get_consulta("pa_m2_servicio",$datos);
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
        $datos = array($this->id_ambiente,$this->nombre,$this->descripcion);
        $r = $this->get_consulta("pa_i_servicio", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
       
        $datos = array($this->id_servicio, $this->id_ambiente,$this->nombre,$this->descripcion);
        
        $r = $this->get_consulta("pa_u_servicio", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    
    public function elimina() {
        $datos = array($this->id_servicio);
        $r = $this->get_consulta("pa_d_servicio", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    

}

?>
