<?php

class triaje extends Main{

    public $id_triaje;
    public $id_socio;
    public $id_concepto_triaje;
    public $unidad_medida;
    public $valor;
    public $fecha;
    
    public function triaje_x_socio() {
        $datos = array($this->id_socio);  
        $r = $this->get_consulta("triaje_socio",$datos);
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
    public function ultimo_triaje() {
        $datos = array($this->id_socio);
        $r = $this->get_consulta("ultimo_triaje",$datos);
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
    public function fecha_socio() {
        $datos = array($this->id_socio);
        $r = $this->get_consulta("t_fechxsocio",$datos);
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
    public function triaje_x_fecha() {
        $datos = array($this->id_socio,$this->fecha);
        $r = $this->get_consulta("triajexfecha",$datos);
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

    //------------------------------------------------------------------------------
    
    public function inserta() {
        $datos = array($this->id_socio,$this->id_concepto_triaje,
                        $this->unidad_medida,$this->valor,$this->fecha);
        $r = $this->get_consulta("pa_i_triaje", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
       
        $datos = array($this->id_triaje,$this->id_socio,$this->id_concepto_triaje,
                        $this->unidad_medida,$this->valor,$this->fecha);
        
        $r = $this->get_consulta("pa_u_triaje", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    public function elimina() {
        $datos = array($this->id_socio,$this->fecha);
        $r = $this->get_consulta("pa_d_triaje", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    

}

?>
