<div class="navbar-inner">
    
    <div class="col-md-2"></div>
    <div class="col-md-7" style="color:#000">
    <form class="form-horizontal" role="form" id="frm" method="post" action="<?php echo $this->action; ?>">
        <input name="guardar" id="guardar" type="hidden" value="1">
        
        <?php if(isset ($this->datos[0]['ID_SERVICIO'])) {?>  
        <div class="form-group">
            <label class="control-label col-sm-6" >ID:</label>
            <div class="col-sm-6">
                <input name="id_servicio" id="id_servicio" class="form-control"  readonly="readonly"
                   value="<?php echo $this->datos[0]['ID_SERVICIO'];?>">
            </div>
        </div>  
        <?php } ?>  
        
        <div class="form-group">
        <label class="control-label col-sm-3" >AMBIENTE:</label>
          <div class="col-sm-6"> 
              <select  class="form-control" name='id_ambiente' id='id_ambiente' autofocus>
               <option value='' >Selecciona...</option>
               <?php for($i=0;$i<count($this->amb);$i++){ ?> 
                <?php if( $this->datos[0]['ID_AMBIENTE']== $this->amb[$i]['ID_AMBIENTE']){?>
                     <option selected value="<?php echo $this->amb[$i]['ID_AMBIENTE'];?>"><?php echo $this->amb[$i]['DESCRIPCION']?></option>
                <?php }else{?>
                     <option value="<?php echo $this->amb[$i]['ID_AMBIENTE'];?>"><?php echo $this->amb[$i]['DESCRIPCION']?></option>
                <?php } ?>
               <?php } ?>
          </select>
         </div>
        </div> 
        
        <div class="form-group">
            <label class="control-label col-sm-6" >NOMBRE:</label>
            <div class="col-sm-6">
                <input name="nombre" id="nombre" class="form-control"  placeholder="Nombre" 
                maxlength="30"  value="<?php if(isset ($this->datos[0]['NOMBRE']))echo $this->datos[0]['NOMBRE']?>">
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-6" >DESCRIPCION:</label>
            <div class="col-sm-6">
                <input name="descripcion" id="descripcion" class="form-control"  placeholder="Descripcion" 
                maxlength="30"  value="<?php if(isset ($this->datos[0]['DESCRIPCION']))echo $this->datos[0]['DESCRIPCION']?>">
            </div>
        </div>
       
        <div class="form-group" style="margin-top: 8%"> 
            <div class="col-sm-offset-3 col-sm-8">
            <button type="button" class="btn btn-primary" id="save"> Guardar</button>
                <a style="margin-left: 8%" href="<?php echo BASE_URL?>servicio"  class="btn btn-danger">Cancelar</a>
            </div>
        </div>

    </form>
    </div>