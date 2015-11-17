<div class="navbar-inner">
    
    <div class="col-md-2"></div>
    <div class="col-md-7" style="color:#000">
    <form class="form-horizontal" role="form" id="frm" method="post" action="<?php echo $this->action; ?>">
        <input name="guardar" id="guardar" type="hidden" value="1">
        
        <?php if(isset ($this->datos[0]['ID_PROVEEDOR'])) {?>  
        <div class="form-group">
            <label class="control-label col-sm-6" >Item:</label>
            <div class="col-sm-6">
                <input name="id_proveedor" id="id_proveedor" class="form-control"  readonly="readonly"
                   value="<?php echo $this->datos[0]['ID_PROVEEDOR'];?>">
            </div>
        </div>  
        <?php } ?>  
        
        <div class="form-group">
            <label class="control-label col-sm-6" >Razon Social:</label>
            <div class="col-sm-6">
                <input name="razon_social" id="razon_social" class="form-control"  placeholder="Razon social" autofocus
                maxlength="50"  value="<?php if(isset ($this->datos[0]['RAZON_SOCIAL']))echo $this->datos[0]['RAZON_SOCIAL']?>">
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-6" >RUC:</label>
            <div class="col-sm-6">
                <input name="ruc" id="ruc" class="form-control"  placeholder="RUC" autofocus
                maxlength="11"  value="<?php if(isset ($this->datos[0]['RUC']))echo $this->datos[0]['RUC']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-6" >Telefono:</label>
            <div class="col-sm-6">
                <input name="telefono" id="telefono" class="form-control"  placeholder="Telefono" autofocus
                maxlength="15"  value="<?php if(isset ($this->datos[0]['TELEFONO']))echo $this->datos[0]['TELEFONO']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-6" >Email:</label>
            <div class="col-sm-6">
                <input name="email" id="email" class="form-control"  placeholder="Email" autofocus
                maxlength="50"  value="<?php if(isset ($this->datos[0]['EMAIL']))echo $this->datos[0]['EMAIL']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-6" >Direccion:</label>
            <div class="col-sm-6">
                <input name="direccion" id="direccion" class="form-control"  placeholder="Direccion" autofocus
                maxlength="50"  value="<?php if(isset ($this->datos[0]['DIRECCION']))echo $this->datos[0]['DIRECCION']?>">
            </div>
        </div>
        
        <div class="form-group" >
            <label class="control-label col-sm-6" >Departamento:</label>
            <div class="col-sm-6">
                <select  class="form-control glyphicon" name='region' id='region'>
                    <option value='' >Selecciona...</option>
                        <?php for($i=0;$i<count($this->region);$i++){ ?> 
                         <?php if( strcmp($this->region[$i]['CODIGO_REGION'], $this->ubigeo[0]['CODIGO_REGION']) == 0){?>
                              <option selected value="<?php echo $this->region[$i]['CODIGO_REGION'];?>"><?php echo $this->region[$i]['DESCRIPCION']?></option>
                         <?php }else{?>
                              <option value="<?php echo $this->region[$i]['CODIGO_REGION'];?>"><?php echo $this->region[$i]['DESCRIPCION']?></option>
                         <?php } ?>
                        <?php } ?>
                </select>
            </div>    
        </div>
        <div class="form-group" >
            <label class="control-label col-sm-6" >Provincia:</label>
            <div class="col-sm-6">
                <select class="form-control glyphicon" name='provincia' id='provincia'>
                    <option value='' >Selecciona...</option>
                    <?php for($i=0;$i<count($this->provincia);$i++){ ?> 
                     <?php if( strcmp($this->provincia[$i]['CODIGO_PROVINCIA'], $this->ubigeo[0]['CODIGO_PROVINCIA']) == 0){?>
                          <option selected value="<?php echo $this->provincia[$i]['CODIGO_PROVINCIA'];?>"><?php echo $this->provincia[$i]['DESCRIPCION']?></option>
                     <?php }else{?>
                          <option value="<?php echo $this->provincia[$i]['CODIGO_PROVINCIA'];?>"><?php echo $this->provincia[$i]['DESCRIPCION']?></option>
                     <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group" style="margin-right: 0px;">
            <label class="control-label col-sm-6" >Distrito:</label>
            <div class="col-sm-6">
                <select class="form-control glyphicon" name='id_ubigeo' id='id_ubigeo'>
                    <option value='' >Selecciona...</option>
                    <?php for($i=0;$i<count($this->distrito);$i++){ ?> 
                     <?php if( strcmp($this->distrito[$i]['CODIGO_DISTRITO'], $this->ubigeo[0]['CODIGO_DISTRITO']) == 0){?>
                          <option selected value="<?php echo $this->distrito[$i]['IDUBIGEO'];?>"><?php echo $this->distrito[$i]['DESCRIPCION']?></option>
                     <?php }else{?>
                          <option value="<?php echo $this->distrito[$i]['IDUBIGEO'];?>"><?php echo $this->distrito[$i]['DESCRIPCION']?></option>
                     <?php } ?>
                    <?php } ?>
                </select>
             </div>
        </div>

       
        <div class="form-group" style="margin-top: 8%"> 
            <div class="col-sm-offset-3 col-sm-8">
            <button type="button" class="btn btn-primary" id="save"> Guardar</button>
                <a style="margin-left: 8%" href="<?php echo BASE_URL?>proveedor"  class="btn btn-danger">Cancelar</a>
            </div>
        </div>

    </form>
    </div>