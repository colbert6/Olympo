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
                <select class="form-control" name='marca' id='marca'>
                    <option value='' >Seleccione Marca...</option>
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
                <select class="form-control glyphicon" name='categoria_producto' id='categoria_producto'>
                    <option value='' >Seleccione Categoria...</option>
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
                <input name="nombre" id="nombre" class="form-control"  placeholder="Descripcion" autofocus
                maxlength="30"  value="<?php if(isset ($this->datos[0]['NOMBRE']))echo $this->datos[0]['NOMBRE']?>">
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-6" >Presentacion:</label>
            <div class="col-sm-6">
                <select class="form-control glyphicon" name='presentacion' id='presentacion'>
                    <option value='' >Seleccione Presentacion...</option>
                    <option value='Unidad'>Unidad</option>
                    <option value='Frasco'>Frasco</option>
                    <option value='Barra'>Barra</option>
                    <option value='Sobre'>Sobre</option>
                    
                    
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-6" >Stock Min:</label>
            <div class="col-sm-6">
                <input name="stock_min" id="stock_min" class="form-control"  placeholder="Descripcion" autofocus
                maxlength="30"  value="<?php if(isset ($this->datos[0]['STOCK_MIN']))echo $this->datos[0]['STOCK_MIN']?>">
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-6" >Stock Min:</label>
            <div class="col-sm-6">
                <input name="stock_max" id="stock_max" class="form-control"  placeholder="Descripcion" autofocus
                maxlength="30"  value="<?php if(isset ($this->datos[0]['STOCK_MAX']))echo $this->datos[0]['STOCK_MAX']?>">
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