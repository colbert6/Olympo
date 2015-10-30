<div class="navbar-inner">
    
    <div class="col-md-2"></div>
    <div class="col-md-7" style="color:#000">
    <form class="form-horizontal" role="form" id="frm" method="post" action="<?php echo $this->action; ?>">
        <input name="guardar" id="guardar" type="hidden" value="1">
        
        <?php if(isset ($this->datos[0]['ID_PARAM'])) {?>  
        <div class="form-group">
            <label class="control-label col-sm-6" >Item:</label>
            <div class="col-sm-6">
                <input name="id_param" id="id_param" class="form-control"  readonly="readonly"
                   value="<?php echo $this->datos[0]['ID_PARAM'];?>">
            </div>
        </div>  
        <?php } else { ?> 
        <div class="form-group">
            <label class="control-label col-sm-6" >Item:</label>
            <div class="col-sm-6">
                <input name="id_param" id="id_param" class="form-control" autofocus placeholder="Item"
                   value="">
            </div>
        </div>  
        <?php } ?>
        
        <div class="form-group">
            <label class="control-label col-sm-6" >Valor:</label>
            <div class="col-sm-6">
                <input name="valor" id="valor" class="form-control"  placeholder="Valor" 
                maxlength="30"  value="<?php if(isset ($this->datos[0]['VALOR']))echo $this->datos[0]['VALOR']?>">
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-6" >Descripcion:</label>
            <div class="col-sm-6">
                <input name="descripcion" id="descripcion" class="form-control"  placeholder="Descripcion" 
                maxlength="30"  value="<?php if(isset ($this->datos[0]['DESCRIPCION']))echo $this->datos[0]['DESCRIPCION']?>">
            </div>
        </div>
       
        <div class="form-group" style="margin-top: 8%"> 
            <div class="col-sm-offset-3 col-sm-8">
            <button type="button" class="btn btn-primary" id="save"> Guardar</button>
                <a style="margin-left: 8%" href="<?php echo BASE_URL?>param"  class="btn btn-danger">Cancelar</a>
            </div>
        </div>

    </form>
    </div>