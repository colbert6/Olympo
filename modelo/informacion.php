<?php

class informacion extends Main{
    
    public $razon;
    public $ruc ;
    public $telefono ;
    public $direccion ;
    public $celular ;
    public $mision ;
    public $vision ;
    public $historia ;
            
    public function selecciona() {
        $r = $this->get_consulta("pa_m1_daem", null);
        if ($r[1] == '') {
            $stmt = $r[0];
        } else {
            die($r[1]);
        }
        $r = null;
            $stmt->setFetchMode(PDO::FETCH_ASSOC);       
            return $stmt->fetchall();
    }

    public function inserta() {
        $datos = array($this->razon, $this->ruc, $this->telefono, $this->direccion,$this->celular, $this->mision, $this->vision, $this->historia);
        $r = $this->get_consulta("pa_i_u_daem", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }
    
}

?>
