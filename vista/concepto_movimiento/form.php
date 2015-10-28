<div class="navbar-inner">
    
    <div class="col-md-2"></div>
    
    <div class="col-md-7" style="color:#000">
        <form class="form-horizontal" role="form" id="frm" method="post" action="<?php echo $this->action; ?>">
            <input name="guardar" id="guardar" type="hidden" value="1">
          <?php if(isset ($this->datos[0]['ID_CONCEPTO_MOVIMIENTO'])) {?>  
          <div class="form-group">
            <label class="control-label col-sm-6" >Item:</label>
            <div class="col-sm-6">
                <input name="id_concepto_movimiento" id="id_concepto_movimiento" class="form-control"  readonly="readonly"
                       value="<?php echo $this->datos[0]['ID_CONCEPTO_MOVIMIENTO'];?>">
            </div>
          </div>  
          <?php } ?>  
            
                    
        <div class="form-group">
        <label class="control-label col-sm-3" >TIPO MOVIMIENTO:</label>
          <div class="col-sm-9"> 
           <select  class="form-control" name='id_tipo_movimiento' id='id_tipo_movimiento'>
               <option value='' >Selecciona...</option>
               <?php for($i=0;$i<count($this->datos_1);$i++){ ?> 
                <?php if( $this->datos[0]['ID_TIPO_MOVIMIENTO']== $this->datos_1[$i]['ID_TIPO_MOVIMIENTO']){?>
                     <option selected value="<?php echo $this->datos_1[$i]['ID_TIPO_MOVIMIENTO'];?>"><?php echo $this->datos_1[$i]['DESCRIPCION']?></option>
                <?php }else{?>
                     <option value="<?php echo $this->datos_1[$i]['ID_TIPO_MOVIMIENTO'];?>"><?php echo $this->datos_1[$i]['DESCRIPCION']?></option>
                <?php } ?>
               <?php } ?>
          </select>
         </div>
        </div>  
          <div class="form-group">
            <label class="control-label col-sm-6" >Descripcion:</label>
            <div class="col-sm-6">
                <input name="descripcion" id="descripcion" class="form-control"  placeholder="Descripcion" 
                    maxlength="30" value="<?php if(isset ($this->datos[0]['DESCRIPCION']))echo $this->datos[0]['DESCRIPCION']?>" autofocus>
            </div>
          </div>
             
            <div class="form-group" style="margin-top: 8%"> 
            <div class="col-sm-offset-3 col-sm-9">
              <button id="save" type='button' class="btn btn-primary"> Guardar</button>
              <a style="margin-left: 8%" href="<?php echo BASE_URL?>concepto_movimiento" class="btn btn-danger">Cancelar</a>
            </div>
          </div>

        </form>
    </div>