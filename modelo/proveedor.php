<?php

class proveedor extends Main{

    public $id_proveedor;
    public $razon_social;
    public $ruc;
    public $telefono;
    public $email;
    public $direccion;
    public $id_ubigeo;
    
    public function selecciona() {
        $r = $this->get_consulta("pa_m1_proveedor",null);
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
        
      
        $datos = array($this->id_proveedor);
        
        $r = $this->get_consulta("pa_m2_proveedor",$datos);
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
        $datos = array( $this->razon_social,$this->ruc,
                        $this->telefono,$this->email, $this->direccion, $this->id_ubigeo);
        $r = $this->get_consulta("pa_i_proveedor", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
       
        $datos = array($this->id_proveedor, $this->razon_social,$this->ruc,
                        $this->telefono,$this->email, $this->direccion, $this->id_ubigeo  );
        
        $r = $this->get_consulta("pa_u_proveedor", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    

    public function elimina() {
        $datos = array($this->id_proveedor);
        $r = $this->get_consulta("pa_d_proveedor", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    

}

?>
