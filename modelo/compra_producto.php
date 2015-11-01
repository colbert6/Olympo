<?php

class compra_producto extends Main{
    
    public $id_compra;
    public $id_producto;
    public $id_almacen;
    public $cantidad;
    public $precio;
    
    public function comparar_stocks() {
        if (is_null($this->id_compra)) {
            $this->id_compra = 0;
        }
        $datos = array($this->id_compra);
//        echo '<pre>';print_r($datos);exit;
        $r = $this->get_consulta("pa_m2_copr", $datos);
        if ($r[1] == '') {
            $stmt = $r[0];
        } else {
            die($r[1]);
        }
        $r = null;
        if (BaseDatos::$_servidor == 'oci') {
            oci_fetch_all($stmt, $data, null, null, OCI_FETCHSTATEMENT_BY_ROW);
            return $data;
        } else {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchall();
        }
    }
    
    public function inserta() {
        $datos = array($this->id_compra, $this->id_producto, $this->id_almacen, $this->cantidad, $this->precio);
//        print_r($datos);exit;
        $r = $this->get_consulta("pa_i_copr", $datos);
        $error = $r[1];
        $r = null;
        return $error;
    }

}

?>
