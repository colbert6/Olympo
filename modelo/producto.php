<?php

class producto extends Main{

    public $id_producto;
    public $id_marca;
    public $id_categoria_producto;
    public $nombre;
    public $presentacion;
    public $precio;
    public $stock_min;
    public $stock_max;
    public $estado;
    
    public function selecciona() {
        $r = $this->get_consulta("pa_m1_producto",null);
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
        if (is_null($this->id_producto)) {
            $this->id_producto = 0;
        }
        if (is_null($this->id_categoria_producto)) {
            $this->id_categoria_producto = 0;
        }
        if (is_null($this->id_marca)) {
            $this->id_marca = 0;
        }
      
        $datos = array($this->id_producto,$this->id_categoria_producto,$this->id_marca);
        
        $r = $this->get_consulta("pa_m2_producto",$datos);
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
    
    public function selecciona_almacen() {
        if (is_null($this->id_almacen)) {
            $this->id_almacen = 0;
        }
      
        $datos = array($this->id_almacen);
        
        $r = $this->get_consulta("pa_m3_producto",$datos);
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
        $datos = array($this->id_categoria_producto,$this->id_marca,$this->presentacion,$this->nombre,
                        $this->stock_min,$this->stock_max,$this->precio);
        $r = $this->get_consulta("pa_i_producto", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
       
        $datos = array($this->id_producto,$this->id_categoria_producto,$this->id_marca,$this->presentacion,$this->precio,
                        $this->nombre, $this->stock_min,$this->stock_max);
        
        $r = $this->get_consulta("pa_u_producto", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    

    public function elimina() {
        $datos = array($this->id_producto);
        $r = $this->get_consulta("pa_d_producto", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    

}

?>
