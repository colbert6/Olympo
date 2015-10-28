<div class="navbar-inner">
    
    <div class="col-md-2"></div>
    <div class="col-md-7" style="color:#000">
    <form class="form-horizontal" role="form" id="frm" method="post" action="<?php echo $this->action; ?>">
        <input name="guardar" id="guardar" type="hidden" value="1">
        
        <?php if(isset ($this->datos[0]['ID_EJERCICIO'])) {?>  
        <div class="form-group">
            <label class="control-label col-sm-6" >Item:</label>
            <div class="col-sm-6">
                <input name="id_ejercicio" id="id_ejercicio" class="form-control"  readonly="readonly"
                   value="<?php echo $this->datos[0]['ID_EJERCICIO'];?>">
            </div>
        </div>  
        <?php } ?>  
        
        <div class="form-group">
            <label class="control-label col-sm-6" >Servicio:</label>
            <div class="col-sm-6">
                <select class="form-control" name='id_servicio' id='id_servicio'>
                    <option value='' >Seleccione Servicio...</option>
                    <?php for($i=0;$i<count($this->servicio);$i++){ //Aca va la lista de los modulos padres ?> 
                    <?php if( $this->datos[0]['ID_SERVICIO']==$this->servicio[$i]['ID_SERVICIO']){?>
                         <option selected value="<?php echo $this->servicio[$i]['ID_SERVICIO'];?>"><?php echo $this->servicio[$i]['NOMBRE']?></option>
                    <?php }else{?>
                         <option value="<?php echo $this->servicio[$i]['ID_SERVICIO'];?>"><?php echo $this->servicio[$i]['NOMBRE']?></option>
                    <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-6" >Cat. Ejercicio:</label>
            <div class="col-sm-6">
                <select class="form-control" name='id_categoria_ejercicio' id='id_categoria_ejercicio'>
                    <option value='' >Seleccione Categoria Ejercicio...</option>
                    <?php for($i=0;$i<count($this->categoria_ejercicio);$i++){ //echo "<script>alert('".$this->categoria_ejercicio[$i]['ID_CATEGORIA_EJERCICIO']."')</script>"; ?> 
                    <?php if( $this->datos[0]['ID_CATEGORIA_EJERCICIO']==$this->categoria_ejercicio[$i]['ID_CATEGORIA_EJERCICIO']){?>
                         <option selected value="<?php echo $this->categoria_ejercicio[$i]['ID_CATEGORIA_EJERCICIO'];?>"><?php echo $this->categoria_ejercicio[$i]['DESCRIPCION']?></option>
                    <?php }else{?>
                         <option value="<?php echo $this->categoria_ejercicio[$i]['ID_CATEGORIA_EJERCICIO'];?>"><?php echo $this->categoria_ejercicio[$i]['DESCRIPCION']?></option>
                    <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-6" >Descripcion:</label>
            <div class="col-sm-6">
                <input name="descripcion" id="descripcion" class="form-control"  placeholder="Descripcion" autofocus
                maxlength="30"  value="<?php if(isset ($this->datos[0]['DESCRIPCION']))echo $this->datos[0]['DESCRIPCION']?>">
            </div>
        </div>
       
        <div class="form-group" style="margin-top: 8%"> 
            <div class="col-sm-offset-3 col-sm-8">
            <button type="button" class="btn btn-primary" id="save"> Guardar</button>
                <a style="margin-left: 8%" href="<?php echo BASE_URL?>ejercicio"  class="btn btn-danger">Cancelar</a>
            </div>
        </div>

    </form>
    </div>