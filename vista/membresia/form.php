<div class="navbar-inner">
    <div class="col-md-2"></div>
    
    <div class="col-md-7" style="color:#000">
        <form class="form-horizontal"  id="frm" method="post" action="<?php echo $this->action; ?>">
            <input name="guardar" id="guardar" type="hidden" value="1">
            <?php if(isset ($this->datos[0]['ID_TIPO_MEMBRESIA'])) {?>  
            <div class="form-group">
                <label class="control-label col-sm-5" >Item:</label>
                <div class="col-sm-7">
                    <input name="id_tipo_membresia" id="id_tipo_membresia" class="form-control"  readonly="readonly"
                       value="<?php echo $this->datos[0]['ID_TIPO_MEMBRESIA'];?>">
                </div>
            </div>  
            <?php } ?>  
            <div class="form-group">
                <label class="control-label col-sm-5" >Descripcion:</label>
                <div class="col-sm-7">
                    <input name="descripcion" id="descripcion" class="form-control"  placeholder="Descripcion" 
                    maxlength="30" value="<?php if(isset ($this->datos[0]['DESCRIPCION']))echo $this->datos[0]['DESCRIPCION'];?>" autofocus>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-5" >Vigencia:</label>
                <div class="col-sm-3">
                    <input name="duracion" id="duracion" class="form-control"  placeholder="Duracion" onKeyPress="return soloNumeros(event);"
                    maxlength="2" value="<?php if(isset ($this->datos[0]['DURACION'])){echo $this->datos[0]['DURACION']; }else {echo'1';}?>" >
                </div>
                <div class="col-sm-4">    
                    <select class="form-control" name='vigencia' id='vigencia'>
                    <?php $vigencia=array('Día','Mes'); ?>
                     
                    <?php   for($i=0;$i<count($vigencia);$i++){ //Aca va la lista de los modulos padres ?> 
                    <?php       if( $vigencia[$i]==$this->datos[0]['VIGENCIA']){?>
                                    <option selected value="<?php echo $vigencia[$i];?>"><?php echo $vigencia[$i]?></option>
                    <?php       }else{  ?>
                                    <option value="<?php echo $vigencia[$i];?>"><?php echo $vigencia[$i];?></option>
                    <?php       } ?>
                    <?php   } ?>            
                         
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-6" >Numero Servicios:</label>
                <div class="col-sm-6">
                    <input name="numero_servicios" id="numero_servicios" class="form-control" onKeyPress="return soloNumeros(event);"  placeholder="Numero de Servicios" 
                    maxlength="2" value="<?php if(isset ($this->datos[0]['NUMERO_SERVICIOS']))echo $this->datos[0]['NUMERO_SERVICIOS']?>" >
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-6" >Precio:</label>
                <div class="col-sm-6">
                    <input name="precio" id="precio" class="form-control" onKeyPress="return dosDecimales(event,this);"  placeholder="Precio" 
                     value="<?php if(isset ($this->datos[0]['PRECIO']))echo $this->datos[0]['PRECIO']?>" >
                </div>
            </div>
             
            <div class="form-group" style="margin-top: 4%"> 
            <div class="col-sm-offset-2 col-sm-8">
            <button type="button" class="btn btn-primary" id="save"> Guardar</button>
                <a style="margin-left: 8%" href="<?php echo BASE_URL?>membresia"  class="btn btn-danger">Cancelar</a>
            </div>
        </div>

        </form>
    </div>