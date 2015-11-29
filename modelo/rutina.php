<?php

class rutina extends Main{

    public $id_rutina;
    public $dia;
    public $id_categoria_ejercicio;
    public $id_socio;
    
    public function selecciona() {
        $r = $this->get_consulta("pa_m1_rutina",null);
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
        
      
        $datos = array($this->id_rutina);
        
        $r = $this->get_consulta("pa_m2_rutina",$datos);
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
    public function rutina_x_dia() {
        
      
        $datos = array($this->dia,$this->id_socio);
        
        $r = $this->get_consulta("pa_m3_rutina",$datos);
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
    public function elimina_2() {
        
      
        $datos = array($this->dia,$this->id_socio,$this->id_categoria_ejercicio);
        
        $r = $this->get_consulta("pa_d_rutina2",$datos);
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
    
    public function socio_x_rutina() {
        
        $datos = array($this->id_socio);
        
        $r = $this->get_consulta("rutinaxsocio",$datos);
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
        
        $datos = array($this->dia,$this->id_categoria_ejercicio,$this->id_socio);
        $r = $this->get_consulta("pa_i_rutina", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
       
        $datos = array($this->id_rutina,$this->dia,$this->id_categoria_ejercicio,$this->id_socio);
        
        $r = $this->get_consulta("pa_u_rutina", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    

    public function elimina() {
        $datos = array($this->id_rutina);
        $r = $this->get_consulta("pa_d_rutina", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    

}

?>


