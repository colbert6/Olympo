<?php

class img_inicio extends Main{

    public $id_imagen_inicio;
    public $imagen;
    public $titulo;
    public $descripcion;
    public $url1;
    public $estado;
    
    public function selecciona() {
        $r = $this->get_consulta("pa_m1_ii",null);
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
        
      
        $datos = array($this->id_imagen_inicio);
        
        $r = $this->get_consulta("pa_m2_ii",$datos);
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
        $datos = array($this->imagen,$this->titulo,$this->descripcion,$this->url1);
        $r = $this->get_consulta("pa_i_ii", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
       
        $datos = array($this->id_imagen_inicio,$this->imagen,$this->titulo, $this->descripcion,$this->url1);
        
        $r = $this->get_consulta("pa_u_ii", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    

    public function elimina() {
        $datos = array($this->id_imagen_inicio);
        $r = $this->get_consulta("pa_d_ii", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    

}

?>