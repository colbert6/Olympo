<?php

class BaseDatosFactory {

    public static function create_bd($type, $config) {
        $clsbase = 'BaseDatos';
        $metodo = 'singleton';
        //$type = new $type;
       if (class_exists($type) && is_subclass_of($type, $clsbase)) {
              //return call_user_func_array(array($type, $metodo), $config);
             return call_user_func( array( $type, $metodo ),$config );
        } else {
            throw new Exception("NO SE EL TIPO DE BASE DE DATOS : " . $type);
        }
    }

    /*   public static function getExecute($type)
      {
      $clsbase = 'BaseDatos';
      if(class_exists($type) && is_subclass_of($type, $clsbase))
      return call_user_func( array( $type, "getExec" ));
      else
      throw new Exception("NO SE RECONOCE EL TIPO DE BASE DE DATOS : ".$type);
      } */
}

?>