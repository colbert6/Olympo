<div class="navbar-inner">
    
<div class="col-md-2"></div>
<div class="col-md-7" style="color:#000">    
    <form method="post" action="<?php if(isset ($this->action))echo $this->action ?>" id="frm" class="form-horizontal" role="form">
        <fieldset>    
            <input type="hidden" name="guardar" id="guardar" value="1"/>
            <div class="form-group">
                <label for="sgbd" class="control-label col-sm-6" >SGBD: </label>
                <div class="col-sm-6">
                  <select placeholder="Seleccione..." class="form-control" name="sgbd" required id="sgbd">
                            <option></option>
                            <option value="mysql">MySQL</option>
                            <option value="pgsql">PostgreSQL</option>
                            <option value="sqlsrv">SQL Server</option>
                            <option value="oci">Oracle</option>
                        </select>    
                </div>
            </div>
            <div class="form-group">
                <label for="usuario" class="control-label col-sm-6"> Usuario: </label>
                <div class="col-sm-6">
                <input placeholder="Ingrese usuario" required class="form-control" name="usuario" id="usuario"  value="" />
                </div> 
            </div>
            <div class="form-group">
                <label for="password"  class="control-label col-sm-6"> Clave: </label>
                <div class="col-sm-6">
                <input type="password" placeholder="Ingrese contrase&ntilde;a" class="form-control" name="clave" id="password" value="" />
                </div> 
            </div>
            <div class="form-group">
                <label for="host" class="control-label col-sm-6"> Host: </label>
                <div class="col-sm-6">
                <input placeholder="Ingrese host" class="form-control" required name="host" id="host" value="" />
                </div> 
            </div> 
            <div class="form-group">
                <label for="puerto" class="control-label col-sm-6"> Puerto: </label>
                <div class="col-sm-6">
                <input placeholder="Ingrese puerto" class="form-control" required name="puerto" id="puerto" value="" />
                </div> 
            </div>
            <div class="form-group">
                <label for="basedatos"  class="control-label col-sm-6"> Base de Datos: </label>
                <div class="col-sm-6">
                <input placeholder="Ingrese nombre bd" class="form-control" name="basedatos" id="basedatos" />
                </div> 
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-6"> </label>
                 <div class="col-sm-offset-3 col-sm-8">
                    <button type="submit" id="save" class="btn btn-primary">Guardar</button>
                    <a href="<?php echo BASE_URL ?>inicio" class="btn btn-info">Cancelar</a></p>
                </div>
            </div>    


        </fieldset>    
    </form>
</div>