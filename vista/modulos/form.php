<div class="navbar-inner">
    
    <div class="col-md-2"></div>
    
    <div class="col-md-7" style="color:#000">
        <form class="form-horizontal" role="form" id="form_modulo" method="post" action="<?php echo $this->action; ?>">
           <input name="guardar" id="guardar" type="hidden" value="1">
            <?php if(isset ($this->datos[0]['ID_MODULO'])) {?>  
            <div class="form-group">
              <label class="control-label col-sm-3" >ITEM:</label>
              <div class="col-sm-9">
                  <input name="id_modulo" id="id_modulo" class="form-control"  readonly="readonly"
                         value="<?php echo $this->datos[0]['ID_MODULO'];?>">
              </div>
            </div>  
            <?php } ?>  
           
            <div class="form-group">
              <label class="control-label col-sm-3" >NOMBRE:</label>
              <div class="col-sm-9">
                <input name="nombre" id="nombre" class="form-control"  placeholder="Nombre" autofocus
                      value="<?php if(isset ($this->datos[0]['NOMBRE']))echo $this->datos[0]['NOMBRE']?>">
              </div>
            </div>
           
            <div class="form-group">
              <label class="control-label col-sm-3" for="url">URL:</label>
              <div class="col-sm-9">
                  <input name="url" id="url" class="form-control"  placeholder="url"
                      value="<?php if(isset ($this->datos[0]['URL']))echo $this->datos[0]['URL']?>">
              </div>
            </div>
           
            <div class="form-group">
              <label class="control-label col-sm-3" for="email">ORDEN:</label>
              <div class="col-sm-9">
                <input name="orden" id="orden" class="form-control"  placeholder="Orden"
                       value="<?php if(isset ($this->datos[0]['ORDEN']))echo $this->datos[0]['ORDEN']?>">
              </div>
            </div>
           
            <div class="form-group">
              <label class="control-label col-sm-3" for="email">ICONO:</label>
              <div class="col-sm-9">
                <input name="icono" id="icono" class="form-control"  placeholder="Icono"
                       value="<?php if(isset ($this->datos[0]['ICONO']))echo $this->datos[0]['ICONO']?>">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-3" >PADRE:</label>
              <div class="col-sm-9"> 
                  <select class="form-control glyphicon" name='padre' id='padre'>
                      <option value='0' >NO TIENE MODULO PADRE</option>
                      <?php for($i=0;$i<count($this->modulos_padre);$i++){ //Aca va la lista de los modulos padres ?> 
                      <?php if( $this->datos[0]['ID_PADRE']==$this->modulos_padre[$i]['ID_MODULO']){?>
                           <option selected value="<?php echo $this->modulos_padre[$i]['ID_MODULO']."/".$this->modulos_padre[$i]['NOMBRE']?>"><?php echo $this->modulos_padre[$i]['NOMBRE']?></option>
                      <?php }else{?>
                           <option value="<?php echo $this->modulos_padre[$i]['ID_MODULO']."/".$this->modulos_padre[$i]['NOMBRE']?>"><?php echo $this->modulos_padre[$i]['NOMBRE']?></option>
                      <?php } ?>
                      <?php } ?>
                  </select>
              </div>
            </div>


            <div class="form-group" style="margin-top: 8%"> 
                <div class="col-sm-offset-3 col-sm-9">
                  <button type="submit" class="btn btn-primary"> Guardar</button>
                  <a style="margin-left: 8%" href="<?php echo BASE_URL?>modulos" type="submit" class="btn btn-danger">Cancelar</a>
                </div>
            </div>

        </form>
    </div>