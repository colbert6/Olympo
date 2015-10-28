<?php

class categoria_empleado extends Main{

    public $id_categoria_empleado;
    public $descripcion;
    public $estado;
    
    public function selecciona() {
        $r = $this->get_consulta("pa_m1_caem",null);
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
    
        $datos = array($this->id_categoria_empleado);
        
        $r = $this->get_consulta("pa_m2_caem",$datos);
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
        $r = $this->get_consulta("pa_i_caem", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
       
        $datos = array($this->id_categoria_empleado, $this->descripcion);
        
        $r = $this->get_consulta("pa_u_caem", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }


    public function elimina() {
        $datos = array($this->id_categoria_empleado);
        $r = $this->get_consulta("pa_d_caem", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    

}

?>
