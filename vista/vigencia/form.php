<div class="navbar-inner">
    
    <div class="col-md-2"></div>
    
    <div class="col-md-7" style="color:#000">
        <form class="form-horizontal" role="form" id="frm" method="post" action="<?php echo $this->action; ?>">
            <input name="guardar" id="guardar" type="hidden" value="1">
          <?php if(isset ($this->datos[0]['ID_VIGENCIA'])) {?>  
          <div class="form-group">
            <label class="control-label col-sm-6" >Item:</label>
            <div class="col-sm-6">
                <input name="id_vigencia" id="id_vigencia" class="form-control"  readonly="readonly"
                       value="<?php echo $this->datos[0]['ID_VIGENCIA'];?>">
            </div>
          </div>  
          <?php } ?>  
          <div class="form-group">
            <label class="control-label col-sm-6" >Descripcion:</label>
            <div class="col-sm-6">
                <input name="descripcion" id="descripcion" class="form-control"  placeholder="Descripcion" 
                    maxlength="30" value="<?php if(isset ($this->datos[0]['DESCRIPCION']))echo $this->datos[0]['DESCRIPCION']?>" autofocus>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-6" >Nro. Dias:</label>
            <div class="col-sm-6">
                <input name="dias" id="dias" class="form-control"   placeholder="Numero de Servicios" 
                    maxlength="2" value="<?php if(isset ($this->datos[0]['DIAS']))echo $this->datos[0]['DIAS']?>" autofocus>
            </div>
          </div>
             
            <div class="form-group" style="margin-top: 8%"> 
            <div class="col-sm-offset-3 col-sm-9">
              <button id="save" type='button' class="btn btn-primary"> Guardar</button>
              <a style="margin-left: 8%" href="<?php echo BASE_URL?>vigencia" class="btn btn-danger">Cancelar</a>
            </div>
          </div>

        </form>
    </div>