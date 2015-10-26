<?php

class PDO_conexion extends BaseDatos {

    protected static $instance = null;
    public static $_servidor = null;
    

    public function __construct($config) {
        $this->set($config);
        if($this->driver=='sqlsrv'){
            $dsn = $this->driver . ':Database=' . $this->dbname . '; server=' . $this->host ;
        }else{
        $dns = $this->driver . ':dbname=' . $this->dbname . '; host=' . $this->host . '; port=' . $this->port;
        }
        parent::__construct($dns, $this->user, $this->password);
        
    }

    public static function singleton($config) {
        if (self::$instance == null) {
            self::$instance = new PDO_conexion($config);
        }
        return self::$instance;
    }

    
}

?>
