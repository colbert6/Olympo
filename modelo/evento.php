<?php

class evento extends Main{

    public $id_evento;
    public $id_categoria_evento;
    public $nombre;
    public $descripcion;
    public $fecha_inicio;
    public $fecha_fin;
    public $lugar;
    public $estado;
    public $hora_evento;
    public function selecciona() {
        $r = $this->get_consulta("pa_m1_evento",null);
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
        
        $datos = array($this->id_evento);
        
        $r = $this->get_consulta("pa_m2_evento",$datos);
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
        $datos = array($this->id_categoria_evento,$this->nombre,$this->descripcion,
            $this->fecha_inicio,$this->fecha_fin,$this->lugar,$this->hora_evento);

        $r = $this->get_consulta("pa_i_evento", $datos);

        $error = $r[1];
        $r = null;
        return $error;
    }

    public function actualiza() {
       
        $datos = array($this->id_categoria_evento,$this->nombre,$this->descripcion,
            $this->fecha_inicio,$this->fecha_fin,$this->lugar,$this->hora_evento,$this->id_evento);
        
        $r = $this->get_consulta("pa_u_evento", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

    

    public function elimina() {
        $datos = array($this->id_evento);
        $r = $this->get_consulta("pa_d_evento", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    

}

?>
