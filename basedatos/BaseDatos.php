<?php
abstract class BaseDatos extends PDO
{
    protected static $instance = NULL;
    protected $host;
    protected $port;
    protected $dbname;
    protected $user;
    protected $password;
    protected $driver;
    public static $_driver;
    public static $_servidor;
    public function set(ConfigReader $config)
    {
        $config_data = $config->getConfig();
        $keybd = key($config_data);
        $this->host = $config_data[$keybd]['host'];
        $this->port = $config_data[$keybd]['puerto'];
        $this->dbname = $config_data[$keybd]['basedatos'];
        self::$_servidor= $config_data[$keybd]['archivo'];
        $this->driver = $config_data[$keybd]['driver'];
        $this->user = $config_data[$keybd]['usuario'];
        self::$_driver= $this->driver;
        
        $this->password = trim($config_data[$keybd]['password']);
    }
}


?>
