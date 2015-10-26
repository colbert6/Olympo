<?php

class Main {

    protected static $db;
    private static $stmt;

    public function __construct() {
        $site_path = realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'config.ini';
        try {
            if (!file_exists($site_path)) {
                throw new PDOException('No se encontro el archivo: '.$site_path);
            } else {
                self::$db = DatabaseFactory::create($site_path);
                if(self::$db=='ERROR'){
                  throw new PDOException('H');
                }
          
            }
            // $this->exec = DatabaseFactory::getExecute($site_path);
        } catch (PDOException $e) {
            //$error = 'Conexion Fallada: ' . $e->getMessage();
            // header("Location:index.php?controller=BaseDatos&action=orror&str=" . $error);
            if($_POST['guardar']==1){
                $host = $_POST['host'];
                $comando = "ping ".$host." -n 5";
                $salida=shell_exec($comando);
                if(strstr($salida,'unreachable') || strstr($salida,'failed') || strstr($salida,'could not find host')){//0 = error, 1 = bien
                    $err = 0;
                } else { $err = 1;}
                if($err==1){
                    $driver = $_POST['sgbd'];
                    $user = $_POST['usuario'];
                    $password = $_POST['clave'];
                    $port = $_POST['puerto'];
                    $dbname = $_POST['basedatos'];
                    $archivo = '';
                    if($driver=='oci'){
                        $archivo = 'OCI';
                    }else{
                        $archivo = 'PDO';
                    }
                    $configuracion = array("archivo" => $archivo, "driver" => $driver, "usuario" => $user, "password" => $password, "host" => $host,
                        "puerto" => $port, "basedatos" => $dbname);
                    $fp = fopen(ROOT.DS."basedatos".DS."config.ini", "w");
                    fwrite($fp, "[database]");
                    $fp = fopen(ROOT.DS."basedatos".DS."config.ini", "a+");
                    foreach ($configuracion as $key => $valor) {
                        fwrite($fp, "\n" . $key . " = " . $valor);
                    }
                    fclose($fp);
        //            conexion::conexionSingleton();
                    echo '<script>
                                alert("Datos GRABADOS Correctamente");
                                window.location="'.BASE_URL.'";
                            </script>';
                } else{
                    echo '<script>
                                alert("No se pudo obtener respuesta del HOST indicado. Los datos seran descartados.");
                                window.location="'.BASE_URL.'";
                        </script>';
                }
                
            }
            ?> 

            <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                    <link href="<?php echo BASE_URL ?>public/css/bootstrap.css" rel="stylesheet">
                    
                </head>
                <body>
                <script type="text/javascript">
                        alert("¡Conexion Fallida!. El sistema se inicializara, los datos que hayan sido guardados no se perderan.");
                    </script>    
                    <div class="row" style="width: 800; margin:0 auto;">
                        <img src="<?php echo BASE_URL ?>public/img/logo.png" height="100" width="800" />
                    </div>
                     <div class="row" style="width: 800; margin:0 auto;">
                         <h2>ES NECESARIO LLENAR ALGUNOS DATOS</h2>
                         <h4>Para mayor informacion contacte con la FISI</h4>
                    </div>
                    <div class="row" style="width: 800; margin:1% auto ;">
                        <form method="post" action="#"  class="form-horizontal" role="form">
                        <fieldset>    
                            <input type="hidden" name="guardar" id="guardar" value="1"/>
                            <div class="form-group">
                                <label for="sgbd" class="col-lg-4 control-label">SGBD: </label>
                                <div class="col-lg-4">
                                  <select placeholder="Seleccione..." class="form-control" name="sgbd" required id="sqbd">
                                            <option></option>
                                            <option value="mysql">MySQL</option>
                                            <option value="pgsql">PostgreSQL</option>
                                            <option value="sqlsrv">SQL Server</option>
                                            <option value="oci">Oracle</option>
                                        </select>    
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="usuario" class="col-lg-4 control-label"> Usuario: </label>
                                <div class="col-lg-4">
                                <input type="text" placeholder="Ingrese usuario" required class="form-control" name="usuario" value="" />
                                </div> 
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-lg-4 control-label"> Clave: </label>
                                <div class="col-lg-4">
                                <input type="password" placeholder="Ingrese contrase&ntilde;a" class="form-control" name="clave" value="" />
                                </div> 
                            </div>
                            <div class="form-group">
                                <label for="host" class="col-lg-4 control-label"> Host: </label>
                                <div class="col-lg-4">
                                <input type="text" placeholder="Ingrese host" class="form-control" required name="host" value="" />
                                </div> 
                            </div> 
                            <div class="form-group">
                                <label for="puerto" class="col-lg-4 control-label"> Puerto: </label>
                                <div class="col-lg-4">
                                <input type="text" placeholder="Ingrese puerto" class="form-control" required name="puerto" value="" />
                                </div> 
                            </div>
                            <div class="form-group">
                                <label for="basedatos" class="col-lg-4 control-label"> Base de Datos: </label>
                                <div class="col-lg-4">
                                <input type="text" placeholder="Ingrese nombre bd" class="form-control" required name="basedatos" value="" />
                                </div> 
                            </div>
                            <div class="form-group">
                                <label class="col-lg-4 control-label"> </label>
                                 <div class="col-lg-2">
                                   <button type="submit" class="btn btn-success" >Guardar</button>
                                </div>
                                <div class="col-lg-4">
                                    <button type="button" class="btn btn-danger" onclick="window.location = '<?php echo BASE_URL ?>'">Cancelar</button>
                                
                                </div>
                            </div>    
                                
                                
                        </fieldset>    
                        </form>
                    </div>
                </body>
            </html>

            <?php
            die();
        }
    }

    public static function get_servidor() {
        switch (BaseDatos::$_driver) {
            case 'mssql': $_servidor = "SQL Server ";
                break;
            case 'mysql': $_servidor = "MySql ";
                break;
            case 'pgsql': $_servidor = "PostgreSQL";
                break;
            case 'oci': $_servidor = "ORACLE";
                break;
            default :
                echo "<script>alert('No existe este servidor');
                            window.location='/localhost/';
                        </script>";
                break;
        }
        return $_servidor;
    }

    protected static function get_consulta($pa, $datos) {
        if (BaseDatos::$_servidor != 'OCI') {
            //self::$db->exec("SET CHARACTER SET utf8");
            self::$db->setAttribute(PDO::ATTR_CASE, PDO::CASE_UPPER);
            return self::procedimientoAlmacenado($pa, $datos);
        } else {
            return self::procedimientoAlmacenado_oci($pa, $datos);
        }
    }

//procedimiento oci
    private static function procedimientoAlmacenado_oci($pa, $datos) {
        $identificador = explode('_', $pa);
        $identificador = array_filter($identificador);
        $selec = $identificador[1];
        //die($selec);
//        exit; pa_selecciona || pa_s_elimina_servicio
        $sql = 'BEGIN ' . $pa;
        if ($datos != null) {
            $sql = $sql . "(";
            if ($selec == 'm1' || $selec=='m2' || $selec=='m3') {
                $num_datos = count($datos) + 1;
            } else {
                $num_datos = count($datos);
            }
            for ($i = 1; $i <= $num_datos; $i++) {
                $sql = $sql . ":p" . $i;
                if ($i < $num_datos) {
                    $sql = $sql . ",";
                } else {
                    $sql = $sql . ")";
                }
            }
        }else {
            $sql = $sql . "(:p1)";
        }
        $sql = $sql . '; END;';
        //die($sql);
        //poner if en el cursor
        if ($selec == 'm1' || $selec=='m2' || $selec=='m3') {
            $cursor = OCI_conexion::crea_cursor();
        }
        self::$stmt = OCI_conexion::ejecutar($sql);
        if ($datos != null) {
            if ($selec == 'm1' || $selec=='m2' || $selec=='m3') {
                //die('jaja');
//                print_r($datos);
//                die();
                for ($i = 0; $i < count($datos); $i++) {
                    //oci_bind_by_name(self::$stmt, ":p" . $i, $datos[$i]);
                    // $stmt->bindValue($j, $datos[$i], PDO::PARAM_INT);
                    $numero = $i + 1;
                    //   if (is_int($datos[$i])) {
                    oci_bind_by_name(self::$stmt, ":p" . $numero, $datos[$i]/* , OCI_B_INT */);
                    /* }
                      if (is_string($datos[$i])) {
                      oci_bind_by_name(self::$stmt, ":p" . $numero, $datos[$i], SQLT_STR);
                      }
                      if (is_double($datos[$i])) {
                      //echo 'nose';
                      //$stmt->bindValue($j, $datos[$i], PDO::PARAM_INT);
                      } */
                }
                $num = count($datos) + 1;
                oci_bind_by_name(self::$stmt, ":p" . $num, $cursor, -1, OCI_B_CURSOR);
                OCI_conexion::execute();
                oci_execute($cursor, OCI_DEFAULT);
                return array($cursor, $error);
                $error = 'error';
            } else {
                for ($i = 0; $i < count($datos); $i++) {
                    $numero = $i + 1;
                    oci_bind_by_name(self::$stmt, ":p" . $numero, $datos[$i]/* , OCI_B_INT */);
                }
                OCI_conexion::execute();
            }
            OCI_conexion::cerrar();
        }else{
                oci_bind_by_name(self::$stmt, ":p1" , $cursor, -1, OCI_B_CURSOR);
                OCI_conexion::execute();
                oci_execute($cursor, OCI_DEFAULT);
                return array($cursor, $error);
            
        }
        //oci_free_statement($stmt);
        //oci_close(self::$db);
    }

    // procedimiento almacenado para ejecutar consultas
    private function procedimientoAlmacenado($pa, $datos) {
        //arreglar archivo
        //$config = parse_ini_file('config.ini', TRUE);
        $driver = BaseDatos::$_driver;
        switch ($driver) {
            case 'mssql': $sql = "execute ";
                break;
            case 'mysql': $sql = "call ";
                break;
            case 'pgsql': $sql = "select * from ";
                break;
            case 'oci': $sql = "execute ";
                break;
        }
        $sql = $sql . $pa . " ";
        if ($driver != 'mssql') {
            $sql = $sql . "(";
        }

        if ($datos != null) {
            for ($i = 1; $i <= count($datos); $i++) {
                $sql = $sql . "?";
                if ($i < count($datos)) {
                    $sql = $sql . ",";
                } else {
                    if ($driver != 'mssql') {
                        $sql = $sql . ")";
                    }
                }
            }
        } else {
            if ($driver != 'mssql') {
                $sql = $sql . ")";
            }
        }
//        die($sql);
        try {

            if ($driver == 'mysql') {
                //die('jajaja');
                $stmt = self::$db->prepare($sql, array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true));
            } else {
                $stmt = self::$db->prepare($sql);
            }
            $j = 0;
            if ($datos != null) {
                for ($i = 0; $i < count($datos); $i++) {
                    $j++;
                    if (is_int($datos[$i])) {
                        $stmt->bindValue($j, $datos[$i], PDO::PARAM_INT);
                    }
                    if (is_string($datos[$i])) {
                        $stmt->bindValue($j, $datos[$i], PDO::PARAM_STR);
                    }
                    if (is_double($datos[$i])) {
                        $stmt->bindValue($j, $datos[$i], PDO::PARAM_INT);
                    }
                    if (is_null($datos[$i])) {
                        $stmt->bindValue($j, $datos[$i], PDO::PARAM_NULL);
                    }
                }
            }
            $stmt->execute();
            $error = $stmt->errorInfo();
            if ($driver == 'mssql') {
                if ($error[2] == '(null) [0] (severity 0) [(null)]') {
                    return array($stmt, '');
                } else {
                    $url=str_replace(' ', '_', $error[2]);
                    die("<script> window.location=\"".BASE_URL."error/error_bd/".$url."\" ; </script>");
                }
            } else {
                return array($stmt, $error[2]);
//                if($error[2]!=''){
//                    return array($stmt, $error[2]);
//                }else{
//                    $url=str_replace(' ', '_', $error[2]);
//                    die("<script> window.location=\"".BASE_URL."error/error_bd/".$url."\" ; </script>");
//                }
            }

//            return array($stmt,$error[2]);
//            return $stmt;
        } catch (PDOException $e) {
            return false;
            echo '<script>
                alert("Fallo ejecucion!: ' . $e->getMessage() . '");
                    window.location="index.php";
                </script>';
        } catch (Exception $ex) {
            return false;
            echo '<script>
                alert("Fallo ejecucion!: ' . $ex->getMessage() . '");
                    window.location="index.php";
                </script>';
        }
    }

}

?>