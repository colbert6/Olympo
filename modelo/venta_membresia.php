<?php

class venta_membresia extends Main{

    public $id_venta;
    public $id_matricula;
    public $id_tipo_membresia;
    public $fecha;
    public $precio;
    
    
    public function selecciona_id_venta() {
        
        $datos = array($this->id_venta);
        
        $r = $this->get_consulta("pa_m2_vema",$datos);
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
        $datos = array($this->id_venta,$this->id_matricula,$this->id_tipo_membresia,$this->fecha,$this->precio);
        $r = $this->get_consulta("pa_i_vema", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }


}

?>
