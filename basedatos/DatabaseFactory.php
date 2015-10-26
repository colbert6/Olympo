<?php
class DatabaseFactory implements DbFactory_Interface
{
    public static function create($ruta_archivo)
    {
        $config = new ConfigReader($ruta_archivo);
        $config_data = $config->getConfig();
        
        $database_class = $config_data['database']['archivo'].'_conexion';
        $ruta_basedatos = ROOT . 'basedatos' . DS . $config_data['database']['archivo'].'_conexion.php';
        //$database_class = key($config_data).'_spdo';
        //die($ruta_basedatos);
        require_once $ruta_basedatos;
        //die($database_class);
        
        $db = BaseDatosFactory::create_bd($database_class,$config);
        
        return $db;
    }

    public static function  getExecute($sIniFile) 
    {
        $config = new ConfigReader($sIniFile);
        $config_data = $config->getConfig();
        $database_class = key($config_data).'_spdo';
        include_once $database_class.'.php';
        $exec = BaseDatosFactory::getExecute($database_class);
        return $exec;
    }
}

?>