<?php
class caja extends Main{

    public $id_caja;
    public $nombre;
    
    public function selecciona() {
        $r = $this->get_consulta("pa_m1_caja",null);
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
        $datos = array($this->id_caja);
        
        $r = $this->get_consulta("pa_m2_caja",$datos);
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
        
        $datos = array($this->nombre);
        $r = $this->get_consulta("pa_i_caja", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
       
        $datos = array($this->id_caja,$this->nombre);
        //print_r($datos);exit;
        $r = $this->get_consulta("pa_u_caja", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    

    public function elimina() {
        $datos = array($this->id_caja);
        $r = $this->get_consulta("pa_d_caja", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
}
?>
