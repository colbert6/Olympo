
<div class="col-md-12" style="color:#000">
<?php if (isset($this->datos) && count($this->datos)) { ?>
    <form class="form-horizontal" role="form" id="frm" method="post" action="<?php echo $this->action; ?>">
        <input name="guardar" id="guardar" type="hidden" value="1">
        
        <div class="row">
            
            <div class="col-md-5">
                <div class="form-group">
                    <label class="col-md-4 control-label" >Razon Social:</label>
                    <div class="col-md-8">
                        <label class="form-control" ><?php if(isset ($this->datos[0]['RAZON_SOCIAL']))echo $this->datos[0]['RAZON_SOCIAL']?></label>
                        
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4" >RUC:</label>
                    <div class="col-md-8">
                        <label class="form-control" ><?php if(isset ($this->datos[0]['RUC']))echo $this->datos[0]['RUC']?></label>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-4 control-label" >Direccion:</label>
                    <div class="col-md-8">
                       <label class="form-control" ><?php if(isset ($this->datos[0]['DIRECCION']))echo $this->datos[0]['DIRECCION']?></label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4" >Contactos:</label>
                    <div class="col-md-8">
                        <div style="width: 45%;float: left;">
                            <label class="form-control" ><?php if(isset ($this->datos[0]['TELEFONO']))echo $this->datos[0]['TELEFONO']?></label>
                        </div>
                        <div style="width: 45%;float: right;">
                            <label class="form-control" ><?php if(isset ($this->datos[0]['CELULAR']))echo $this->datos[0]['CELULAR']?></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row" >
            <div class="col-md-11">
                <div class="form-group">
                    <label class="control-label col-md-2" >Historia:</label>
                    <div class="col-md-10" >
                        <textarea readonly="readonly" name="historia" id="historia" class="form-control" rows="6">
                            <?php if(isset ($this->datos[0]['HISTORIA']))echo $this->datos[0]['HISTORIA']?>
                        </textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-11">
                <div class="form-group">
                    <label class="control-label col-md-2" >Vision:</label>
                    <div class="col-md-10">
                        <textarea readonly="readonly" name="mision" id="mision"  class="form-control" rows="3">
                            <?php if(isset ($this->datos[0]['VISION']))echo $this->datos[0]['VISION']?>
                        </textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-11">
                <div class="form-group">
                    <label class="control-label col-md-2" >Mision:</label>
                    <div class="col-md-10">
                        <textarea readonly="readonly" name="mision" id="mision"  class="form-control" rows="5">
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
                        <a href="javascript:void(0)" onclick="editar('<?php echo BASE_URL?>informacion/editar/')" class="btn btn-primary">Editar</a>
                    </div>    
                </div>
            </div>
        </div>
            
        

    </form>
<?php } else { ?>
    <p>NO SE ENCONTRARON DATOS</p>
        <a class="btn btn-primary" href="<?php echo BASE_URL?>informacion/nuevo/" class="k-button">Agregar</a>
<?php } ?>               
</div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           