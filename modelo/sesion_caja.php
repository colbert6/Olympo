<?php

class sesion_caja extends Main{

    public $id_sesion_caja;
    public $id_caja;
    public $id_empleado;
    public $fecha_entrada;
    public $fecha_salida;
    public $monto_inicio;
    public $monto_cierre;
    public $estado;
    public $aumenta;
    
    public function sesiones_caja() {
        $datos = array($this->id_caja);
        $r = $this->get_consulta("sesiones_caja",$datos);
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
    public function selecciona() {
        $r = $this->get_consulta("pa_m1_seca",null);
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
    public function cajas_activas() {
        $r = $this->get_consulta("cajas_activas",null);
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
        $datos = array($this->id_caja,$this->id_empleado,$this->fecha_entrada,$this->monto_inicio,$this->estado);
        $r = $this->get_consulta("pa_i_seca", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
        $datos = array($this->id_caja, $this->fecha_salida,$this->estado);
        $r = $this->get_consulta("pa_u_seca", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza_saldo() {
        $datos = array($this->id_sesion_caja,$this->monto_cierre,$this->aumenta);
        $r = $this->get_consulta("act_saldo", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }



    

}

?>
