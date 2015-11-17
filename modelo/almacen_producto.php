<?php

class almacen_producto extends Main{
    
    public $id_producto;
    public $id_almacen;
    public $cantidad;
    
  

    public function actualizar_stock() {
        $datos = array($this->id_almacen, $this->id_producto,$this->cantidad);
        $r = $this->get_consulta("pa_u_alpr", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

}

?>
