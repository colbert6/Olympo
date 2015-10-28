<div class="navbar-inner">
    
<div class="col-md-12" style="color:#000">
    <form class="form-horizontal" role="form" id="frm" method="post" action="<?php echo $this->action; ?>">
        <input name="guardar" id="guardar" type="hidden" value="1">
        
        <div class="row">
            
            <div class="col-md-5">
                <div class="form-group">
                    <label class="col-md-4 control-label" >Razon Social:</label>
                    <div class="col-md-8">
                        <input name="razon_social" id="razon_social" class="form-control"  placeholder="Razon Social" autofocus
                        maxlength="30"  value="<?php if(isset ($this->datos[0]['RAZON_SOCIAL']))echo $this->datos[0]['RAZON_SOCIAL']?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4" >RUC:</label>
                    <div class="col-md-8">
                        <input name="ruc" id="ruc" class="form-control"  placeholder="RUC" onkeypress="return soloNumeros(event)"
                        maxlength="11"  value="<?php if(isset ($this->datos[0]['RUC']))echo $this->datos[0]['RUC']?>">
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-4 control-label" >Direccion:</label>
                    <div class="col-md-8">
                        <input name="direccion" id="direccion" class="form-control"  placeholder="Direccion" 
                        maxlength="30"  value="<?php if(isset ($this->datos[0]['DIRECCION']))echo $this->datos[0]['DIRECCION']?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4" >Contactos:</label>
                    <div class="col-md-8">
                        <div style="width: 45%;float: left;">
                            <input name="telefono" id="telefono" class="form-control"  placeholder="Telefono" onkeypress="return numeroTelefonico(event)"
                            maxlength="10"  value="<?php if(isset ($this->datos[0]['TELEFONO']))echo $this->datos[0]['TELEFONO']?>">
                        </div>
                        <div style="width: 45%;float: right;">
                            <input name="celular" id="celular" class="form-control"  placeholder="Celular" onkeypress="return numeroTelefonico(event)"
                            maxlength="10"  value="<?php if(isset ($this->datos[0]['CELULAR']))echo $this->datos[0]['CELULAR']?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row" >
            <div class="col-md-11">
                <div class="form-group">
                    <label class="control-label col-md-2" >Historia:</label>
                    <div class="col-md-10">
                        <textarea  name="historia" id="historia" class="form-control" rows="6">
                            <?php if(isset ($this->datos[0]['HISTORIA']))echo $this->datos[0]['HISTORIA']?>
                        </textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-11">
                <div class="form-group">
                    <label class="control-label col-md-2" >Vision:</label>
                    <div class="col-md-10">
                        <textarea  name="vision" id="vision"  class="form-control" rows="3">
                            <?php if(isset ($this->datos[0]['VISION']))echo $this->datos[0]['VISION']?>
                        </textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-11">
                <div class="form-group">
                    <label class="control-label col-md-2" >Mision:</label>
                    <div class="col-md-10">
                        <textarea  name="mision" id="mision"  class="form-control" rows="5">
                            <?php if(isset ($this->datos[0]['MISION']))echo $this->datos[0]['MISION']?>
                        </textarea>
                    </div>
                </div>
            
            </div>    
        </div>
        
        <div class="row" >
            <div class="col-md-11">
                <div class="form-group" > 
                    <label class="control-label col-md-2" ></label>
                    <div class="col-md-10">
                        <button type="button" class="btn btn-primary" id="save"> Guardar</button>
                        <a style="margin-left: 8%" href="<?php echo BASE_URL?>informacion"  class="btn btn-danger">Cancelar</a>
                    </div>    
                </div>
            </div>
        </div>
            
        

    </form>
</div>