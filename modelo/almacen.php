<?php

class almacenModel extends Main{

    public $id_almacen;
    public $descripcion;
    public $estado;
    
    public function selecciona() {
        $r = $this->get_consulta("pa_m1_almacen",null);
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
    public function selecciona_filtro() {
        if (is_null($this->id_almacen)) {
            $this->id_almacen = 0;
        }
        if (is_null($this->descripcion)) {
            $this->descripcion = 'nulo';
        }
        $datos = array($this->id_almacen,$this->descripcion);
        
        $r = $this->get_consulta("pa_m2_almacen",$datos);
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
        $r = $this->get_consulta("pa_i_almacen", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function editar() {
       
        $datos = array($this->id_almacen, $this->descripcion);
        
        $r = $this->get_consulta("pa_u_almacen", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    

    public function elimina() {
        $datos = array($this->id_almacen);
        $r = $this->get_consulta("pa_d_almacen", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    

}

?>
