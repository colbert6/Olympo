<?php

class contacto extends Main{

    public $id_contacto;
    public $nombre;
    public $telefono;
    public $correo;
    public $mensaje;
    
    public function selecciona() {
        $r = $this->get_consulta("pa_m1_contacto",null);
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
        
      
        $datos = array($this->id_contacto);
        
        $r = $this->get_consulta("pa_m2_contacto",$datos);
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
        $datos = array($this->nombre,$this->telefono,$this->correo,$this->mensaje);
        $r = $this->get_consulta("pa_i_contacto", $datos);
        
        $error = $r[1];
        $r = null;
        return $error;
    }
    

}

?>