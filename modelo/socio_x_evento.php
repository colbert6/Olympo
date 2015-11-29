<?php

class socio_x_evento extends Main{

    public $id_socio_x_evento;
    public $id_evento;
    public $id_socio;
    public $asistencia;
    public $condicion;

    
    public function selecciona() {
        $datos = array($this->id_socio);
        $r = $this->get_consulta("pa_m1_soev", $datos);
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

      
    }
    
    public function inserta() {
        $datos = array($this->id_evento,$this->id_socio,$this->asistencia,$this->condicion);
        $r = $this->get_consulta("pa_i_soev", $datos);
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

    public function actualiza() {
       
    }

    public function elimina() {
        $datos = array($this->id_socio_x_evento);
        $r = $this->get_consulta("pa_d_soev", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    

}

?>
