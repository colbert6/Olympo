<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of conexion_oci
 *
 * @author eveR
 */
class OCI_conexion extends BaseDatos {

    private static $instancia = null;
    private static $link;
    private static $stmt;
    public static $servidor;
    //public static $_servidor = null;

    public function __construct($config) {
        $this->set($config);
        self::$link = oci_connect($this->user, $this->password, $this->host . '/' . $this->dbname);

        return self::$link;
            
    }

    public static function singleton($config) {
        if (self::$instancia == null) {
            self::$instancia = new self($config);
        }
        if (!self::$link) {
            return 'ERROR';
        }
        return self::$instancia;
    }

    public static function ejecutar($sql) {
        self::$stmt = oci_parse(self::$link, $sql);
        return self::$stmt;
    }

    public static function crea_cursor() {
        $cursor = oci_new_cursor(self::$link);
        return $cursor;
    }

    public static function cerrar() {
        oci_free_statement(self::$stmt);
        oci_close(self::$link);
    }
    public static function execute(){
        oci_execute(self::$stmt ,OCI_DEFAULT);
    }
       
}

?>
