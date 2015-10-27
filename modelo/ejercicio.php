<?php

class ejercicio extends Main{

    public $id_ejercicio;
    public $id_servicio;
    public $id_categoria_ejercicio;
    public $descripcion;
    
    public function selecciona() {
        $r = $this->get_consulta("pa_m1_ejercicio",null);
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
        
        $datos = array($this->id_ejercicio);
        
        $r = $this->get_consulta("pa_m2_ejercicio",$datos);
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
        $datos = array($this->id_servicio,$this->id_categoria_ejercicio,$this->descripcion);
        
        $r = $this->get_consulta("pa_i_ejercicio", $datos);

        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
       
        $datos = array($this->id_ejercicio, $this->id_servicio,$this->id_categoria_ejercicio,$this->descripcion);
        
        $r = $this->get_consulta("pa_u_ejercicio", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    

    public function elimina() {
        $datos = array($this->id_ejercicio);
        $r = $this->get_consulta("pa_d_ejercicio", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    

}

?>
