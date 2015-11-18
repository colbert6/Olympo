<div class="navbar-inner">
  </script>
    <div class="col-md-1"></div>
    <div class="col-md-10" style="color:#000">
    <form  role="form" id="frm" method="post" action="<?php echo $this->action; ?>" class="form-horizontal">
        <input name="guardar" id="guardar" type="hidden" value="1">

         <?php 
        if(isset ($this->datos[0]['ID_SOCIO'])) {?>  
              <div class="form-group">
                <label class="col-md-6 control-label" style="width:110px ; " >IDENTIFICADOR:</label>
                <div class="col-md-3">
                    <input name="id_socio" id="id_socio" class="form-control"  readonly="readonly"
                           value="<?php echo $this->datos[0]['ID_SOCIO'];?>">
                </div>
              </div>  
        <?php } ?> 
        <div class="row"  >
            <div class="col-md-4" >
                <div class="form-group" style="margin-right: 0px;">
                    <label class="col-md-6 control-label "  >NOMBRE:&nbsp;&nbsp;&nbsp;&nbsp;*</label>
                    <input <?php echo $bloqueo;?> onKeyPress="return soloLetras(event);" maxlength='30' name="nombre" id="nombre" class="form-control"  placeholder="Nombre(s)" autofocus
                            value="<?php if(isset ($this->datos[0]['NOMBRE']))echo $this->datos[0]['NOMBRE']?>">
                    
                </div>  
            </div> 
            
            <div class="col-md-4">
            <div class="form-group" style="margin-right: 0px;">
                <label class="col-md-6 control-label" for="apellido_paterno" style="width: 180px;">APELLIDO PATERNO:  &nbsp;&nbsp;&nbsp;&nbsp;*</label>
                      <input onKeyPress="return soloLetras(event);" maxlength='30' <?php echo $bloqueo;?> name="apellido_paterno" id="apellido_paterno" class="form-control"  placeholder="Apellido Paterno" 
                            value="<?php if(isset ($this->datos[0]['APELLIDO_PATERNO']))echo $this->datos[0]['APELLIDO_PATERNO']?>">
                    
                  </div>
            </div>
            <div class="col-md-4">
            <div class="form-group" style="margin-right: 0px;">
                    <label class="col-md-6 control-label" for="apellido_materno" style="width: 180px;">APELLIDO MATERNO:&nbsp;&nbsp;&nbsp;&nbsp;*</label>
                    <input  onKeyPress="return soloLetras(event);" <?php echo $bloqueo;?> maxlength='30' name="apellido_materno" id="apellido_materno" class="form-control"  placeholder="Apellido Materno" 
                            value="<?php if(isset ($this->datos[0]['APELLIDO_MATERNO']))echo $this->datos[0]['APELLIDO_MATERNO']?>">
                    </div>
            </div>
        </div>

        <br>
        
        <div class="row" >
            
            <div class="col-md-4">
                <div class="form-group" style="margin-right: 0px;">
                <label class="col-md-6 control-label" for="dni" >DNI: &nbsp;&nbsp;&nbsp;&nbsp;*</label>
                    <input onKeyPress="return soloNumeros(event);" maxlength='8' <?php echo $bloqueo;?> name="dni" id="dni" class="form-control"  placeholder="DNI" 
                        value="<?php if(isset ($this->datos[0]['DNI']))echo $this->datos[0]['DNI']?>">
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group" style="margin-right: 0px;">
                    <label class="col-md-6 control-label" style="width: 180px;" >TIPO SOCIO:&nbsp;&nbsp;&nbsp;&nbsp;*</label>
                        <select class="form-control" name='id_tipo_socio' id='id_tipo_socio'>
                           <option value='' >Selecciona...</option>
                           <?php for($i=0;$i<count($this->tipo_socio);$i++){ ?> 
                            <?php if( strcmp($this->datos[0]['ID_TIPO_SOCIO'], $this->tipo_socio[$i]['ID_TIPO_SOCIO']) == 0){?>
                                 <option selected value="<?php echo $this->tipo_socio[$i]['ID_TIPO_SOCIO'];?>"><?php echo $this->tipo_socio[$i]['DESCRIPCION']?></option>
                            <?php }else{?>
                                 <option value="<?php echo $this->tipo_socio[$i]['ID_TIPO_SOCIO'];?>"><?php echo $this->tipo_socio[$i]['DESCRIPCION']?></option>
                            <?php } ?>
                           <?php } ?>
                      </select>  
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group" style="margin-right: 0px;" >
                    <label class="col-md-6 control-label" for="fecha_nacimiento" style="width: 180px;" >FECHA NACIMIENTO: &nbsp;&nbsp;&nbsp;&nbsp;*</label>
                        <input <?php echo $bloqueo;?> readonly name="fecha_nacimiento" id="fecha_nacimiento" class="form-control"   placeholder="Fecha Nacimiento" 
                            value="<?php if(isset ($this->datos[0]['FECHA_NACIMIENTO'])) echo $this->datos[0]['FECHA_NACIMIENTO']?>">
                </div>
            </div>
        </div>
        
        <div class="row" >
            <div class="col-md-4">
                <div class="form-group" style="margin-right: 0px;">
                        <label class="control-label" >DEPARTAMENTO:</label>
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
            <div class="col-md-4">
                <div class="form-group" style="margin-right: 0px;">
                        <label class="control-label" >PROVINCIA:</label>
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
            <div class="col-md-4">
                <div class="form-group" style="margin-right: 0px;">
                        <label class="control-label" >DISTRITO</label>
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

        </div>

        <div class="row">
            <div class="col-md-4">
               <div class="form-group" style="margin-right: 0px;">
                <label class="control-label" for="sector" >SECTOR:</label>
               
                  <input <?php echo $bloqueo;?> name="sector" id="sector" class="form-control" placeholder="Sector" 
                        value="<?php if(isset ($this->datos[0]['SECTOR'])) echo $this->datos[0]['SECTOR']?>">

              </div>

            </div>
            <div class="col-md-6">
                <div class="form-group" style="margin-right: 0px;">
                    <label  class="control-label" for="direccion" >DIRECION: &nbsp;&nbsp;&nbsp;&nbsp;*</label>
                    
                      <input <?php echo $bloqueo;?> name="direccion" id="direccion" class="form-control"  placeholder="Direccion" 
                            maxlength='45' value="<?php if(isset ($this->datos[0]['DIRECCION'])) echo $this->datos[0]['DIRECCION']?>">
                    </div>
            </div>
            
        </div>
        
        <br>
        <div class="row">
            <div class="col-md-3">
                 <div class="form-group" style="margin-right: 0px;">
                    <label class="control-label" for="sexo" >SEXO:</label>
                    
                      <select <?php echo $bloqueo;?> class="form-control glyphicon" name='sexo' id='sexo'>
                        <option value='' >Selecciona...</option>

                          <?php 
                           $des_sexo = array("Masculino","Femenino");
                           $id_sexo = array("m","f");
                            for($i=0;$i<count($des_sexo);$i++){  ?> 
                            <?php if(strcmp($this->datos[0]['SEXO'], $id_sexo[$i]) == 0 ){?>
                                 <option selected value="<?php echo $id_sexo[$i];?>"><?php echo strtoupper($des_sexo[$i]);?></option>
                            <?php }else{?>
                                 <option value="<?php echo $id_sexo[$i];?>"><?php echo strtoupper($des_sexo[$i]);?></option>
                            <?php } ?>
                           <?php } ?>
                      </select>
                   
                  </div>
            </div>
            <div class="col-md-3">
                <div class="form-group" style="margin-right: 0px;">
                    <label class="control-label" for="estado_civil" style="width: 130px;" >ESTADO CIVIL: &nbsp;&nbsp;&nbsp;&nbsp;*</label>
                  
                      <select class="form-control glyphicon" name='estado_civil' id='estado_civil'>
                           <option value='' >Selecciona...</option>
                           <?php 
                           $estado_civil = array('soltero','casado','divorciado','viudo');
                            for($i=0;$i<count($estado_civil);$i++){ ?> 
                            <?php if(strcmp($this->datos[0]['ESTADO_CIVIL'], $estado_civil[$i])==0){?>
                                 <option selected value="<?php echo $estado_civil[$i];?>"><?php echo strtoupper($estado_civil[$i]);?></option>
                            <?php }else{?>
                                 <option value="<?php echo $estado_civil[$i];?>"><?php echo strtoupper($estado_civil[$i]);;?></option>
                            <?php } ?>
                           <?php } ?>
                          
                      </select>
                
                  </div>
            </div>
            <div class="col-md-4">
            <div class="form-group" style="margin-right: 0px;">
                <label class="col-md-6 control-label" for="aliass" >ALIAS:</label>
                  <input maxlength='45' <?php echo $bloqueo;?> name="aliass" id="aliass" class="form-control"  placeholder="Alias" 
                        value="<?php if(isset ($this->datos[0]['ALIASS']))echo $this->datos[0]['ALIASS']?>">
        
              </div>
            </div>

        </div>
        
        <div class="row" >
            <div class="col-md-6">
                 <div class="form-group" style="margin-right: 0px;">
                    <label class="control-label" for="email" >E-MAIL:</label>
            
                      <input <?php echo $bloqueo;?>  id="email" class="form-control"  placeholder="E-mail"  name='email'
                            value="<?php if(isset ($this->datos[0]['EMAIL'])) echo $this->datos[0]['EMAIL']?>">
                  
                  </div>
            </div>
            <div class="col-md-3">
                <div class="form-group" style="margin-right: 0px;">
                    <label class="control-label " for="telefono" >TELEFONO: &nbsp;&nbsp;&nbsp;&nbsp;*</label>
                    
                      <input  onKeyPress="return soloNumeros(event);" maxlength='9' <?php echo $bloqueo;?> name="telefono" id="telefono" class="form-control"  placeholder="Telefono" 
                            value="<?php if(isset ($this->datos[0]['TELEFONO'])) echo $this->datos[0]['TELEFONO']?>">
                
                  </div>
            </div>
            <div class="col-md-3">
                <div class="form-group" style="margin-right: 0px;">
                    <label class="control-label" for="celular" >CELULAR: &nbsp;&nbsp;&nbsp;&nbsp;*</label>
                    
                      <input  onKeyPress="return soloNumeros(event);" maxlength='9' <?php echo $bloqueo;?>  name="celular" id="celular" class="form-control" placeholder="Celular" 
                            value="<?php if(isset ($this->datos[0]['CELULAR'])) echo $this->datos[0]['CELULAR']?>">
                
                  </div>
            </div>
        </div>

        

         <div class="row" >
            <div class="col-md-5">
                <div class="form-group" style="margin-right: 0px;">
                        <label class="control-label" for="grado_estudio" style="width: 130px;" >GRADO DE ESTUDIO:</label>
                            <input <?php echo $bloqueo;?> name="grado_estudio" id="grado_estudio" class="form-control" placeholder="Grado de Estudio" 
                                value="<?php if(isset ($this->datos[0]['GRADO_ESTUDIO'])) echo $this->datos[0]['GRADO_ESTUDIO']?>">
                </div>
            </div>
            <div class="col-md-4">
                 <div class="form-group" style="margin-right: 0px;">
                    <label class="control-label" for="ocupacion" >OCUPACION:</label>
                   
                      <input <?php echo $bloqueo;?> name="ocupacion" id="ocupacion" class="form-control" placeholder="Ocupacion" 
                            value="<?php if(isset ($this->datos[0]['OCUPACION'])) echo $this->datos[0]['OCUPACION']?>">
                   
                  </div>
            </div>
            <div class="col-md-3">
                <div class="form-group" style="margin-right: 0px;">
                <label class="control-label" for="numero_hijo" style="width: 130px;" >NUMERO DE HIJOS:</label>
               
                  <input onKeyPress="return soloNumeros(event);" maxlength='9' <?php echo $bloqueo;?> name="numero_hijo" id="numero_hijo" class="form-control"   placeholder="Numero de Hijos" 
                        value="<?php if(isset ($this->datos[0]['NUMERO_HIJO'])) echo $this->datos[0]['NUMERO_HIJO']?>">
            
                </div>
            </div>
           
            
        </div>

        <div class="form-group" style="margin-top: 8%"> 
            <div class="col-sm-offset-3 col-sm-8">
            <button type="button" class="btn btn-primary" id="save"> Guardar</button>
                <a style="margin-left: 8%" href="<?php echo BASE_URL?>socio"  class="btn btn-danger">Cancelar</a>
            </div>
        </div>

    </form>
    </div>