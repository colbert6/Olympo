                            
<?php     $presentacion =array('Unidad','Frasco','Barra','Sobre');     ?>
<div class="navbar-inner">
    
    <div class="col-md-2"></div>
    <div class="col-md-7" style="color:#000">
    <form class="form-horizontal" role="form" id="frm" method="post" action="<?php echo $this->action; ?>">
        <input name="guardar" id="guardar" type="hidden" value="1">
        
        <?php if(isset ($this->datos[0]['ID_PRODUCTO'])) {?>  
        <div class="form-group">
            <label class="control-label col-sm-6" >Item:</label>
            <div class="col-sm-6">
                <input name="id_producto" id="id_producto" class="form-control"  readonly="readonly"
                   value="<?php echo $this->datos[0]['ID_PRODUCTO'];?>">
            </div>
        </div>  
        <?php } ?>  
        
        <div class="form-group">
            <label class="control-label col-sm-3" >Marca:</label>
            <div class="col-sm-9"> 
                <select class="form-control" name='id_marca' id='id_marca' placeholder="Marca">
                    <option value='' ></option>
                    <?php for($i=0;$i<count($this->marcas);$i++){ //Aca va la lista de los modulos padres ?> 
                    <?php if( $this->datos[0]['ID_MARCA']==$this->marcas[$i]['ID_MARCA']){?>
                         <option selected value="<?php echo $this->marcas[$i]['ID_MARCA'];?>"><?php echo $this->marcas[$i]['DESCRIPCION']?></option>
                    <?php }else{?>
                         <option value="<?php echo $this->marcas[$i]['ID_MARCA'];?>"><?php echo $this->marcas[$i]['DESCRIPCION']?></option>
                    <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-3" >Cat. Producto:</label>
            <div class="col-sm-9"> 
                <select class="form-control" name='id_categoria_producto' id='id_categoria_producto' placeholder="Categoria Producto">
                    <option value='' ></option>
                    <?php for($i=0;$i<count($this->cat_productos);$i++){ //Aca va la lista de los modulos padres ?> 
                    <?php if( $this->datos[0]['ID_CATEGORIA_PRODUCTO']==$this->cat_productos[$i]['ID_CATEGORIA_PRODUCTO']){?>
                         <option selected value="<?php echo $this->cat_productos[$i]['ID_CATEGORIA_PRODUCTO'];?>"><?php echo $this->cat_productos[$i]['DESCRIPCION']?></option>
                    <?php }else{?>
                         <option value="<?php echo $this->cat_productos[$i]['ID_CATEGORIA_PRODUCTO'];?>"><?php echo $this->cat_productos[$i]['DESCRIPCION']?></option>
                    <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-6" >Nombre:</label>
            <div class="col-sm-6">
                <input name="nombre" id="nombre" class="form-control"  placeholder="Nombre" 
                maxlength="30"  value="<?php if(isset ($this->datos[0]['NOMBRE']))echo $this->datos[0]['NOMBRE']?>">
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-6" >Presentacion:</label>
            <div class="col-sm-6">
                <select class="form-control" name='presentacion' id='presentacion' placeholder="Presentacion"  >
                    <option value='' ></option>
                    <?php for($i=0;$i<count($presentacion);$i++){ //Aca va la lista de los modulos padres ?> 
                    <?php if( $this->datos[0]['PRESENTACION']==$presentacion[$i]){?>
                         <option selected value="<?php echo $presentacion[$i];?>"><?php echo $presentacion[$i];?></option>
                    <?php }else{?>
                         <option value="<?php echo $presentacion[$i];?>"><?php echo $presentacion[$i];?></option>
                    <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-6" >Precio:</label>
            <div class="col-sm-6">
                <input name="precio" id="precio" class="form-control"  placeholder="Precio" onkeypress="return dosDecimales(event,this)"
                  value="<?php if(isset ($this->datos[0]['PRECIO'])){echo $this->datos[0]['PRECIO'];}else{echo "0.01";}?>">
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-6" >Stock Min:</label>
            <div class="col-sm-6">
                <input name="stock_min" id="stock_min" class="form-control"  placeholder="Stock Min" onkeypress="return soloNumeros(event)"
                maxlength="8"  value="<?php if(isset ($this->datos[0]['STOCK_MIN'])){echo $this->datos[0]['STOCK_MIN'];} else {echo 5;}?>">
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-6" >Stock Max:</label>
            <div class="col-sm-6">
                <input name="stock_max" id="stock_max" class="form-control"  placeholder="Stock Max" onkeypress="return soloNumeros(event)"
                maxlength="8"  value="<?php if(isset ($this->datos[0]['STOCK_MAX'])){echo $this->datos[0]['STOCK_MAX'];} else {echo 100;} ?>">
            </div>
        </div>
        
        <div class="form-group" style="margin-top: 8%"> 
            <div class="col-sm-offset-3 col-sm-8">
            <button type="button" class="btn btn-primary" id="save"> Guardar</button>
                <a style="margin-left: 8%" href="<?php echo BASE_URL?>producto"  class="btn btn-danger">Cancelar</a>
            </div>
        </div>

    </form>
    </div>