<link href="<?php echo $_params['ruta_css']; ?>jquery-ui.custom.css" rel="stylesheet" />
<script src="<?php echo $_params['ruta_js']; ?>bootbox.min.js"></script>
<div class="navbar-inner">
  </script>
    <div class="col-md-1"></div>
    <div class="col-md-10" style="color:#000">
    <form  role="form" id="frm" method="post" action="<?php echo $this->action; ?>">
        <input name="guardar" id="guardar" type="hidden" value="1">
    <div class="row">
         <?php 
        if(isset ($this->datos[0]['ID_EMPLEADO'])) {?> 
        <div class="col-md-4"> 
              <div class="form-group" style="margin-right: 0px;">
                <label class="control-label">IDENTIFICADOR:</label>
                
                    <input name="id_empleado" id="id_empleado" class="form-control"  readonly="readonly"
                           value="<?php echo $this->datos[0]['ID_EMPLEADO'];?>">
                
              </div>  
        </div>
        <?php } ?> 

        <?php if(isset ($this->datos[0]['ID_EMPLEADO'])) {
                           echo '<div class="col-md-4">' ;
              }else{
                            echo '<div class="col-md-6">' ;
              } ?>

         
                <div class="form-group" style="margin-right: 0px;">
                        <label class="control-label" >CATEGORIA EMPLEADO: &nbsp;&nbsp;&nbsp;&nbsp;*</label>
                       <select s class="form-control glyphicon" name='id_categoria_empleado' id='id_categoria_empleado' autofocus>
                           <option value='' >Selecciona...</option>
                           <?php for($i=0;$i<count($this->cat_empleado);$i++){ ?> 
                            <?php if( strcmp($this->datos[0]['ID_CATEGORIA_EMPLEADO'], $this->cat_empleado[$i]['ID_CATEGORIA_EMPLEADO']) == 0){?>
                                 <option selected value="<?php if(isset ($this->cat_empleado[$i]['ID_CATEGORIA_EMPLEADO'])) echo $this->cat_empleado[$i]['ID_CATEGORIA_EMPLEADO'];?>"><?php echo $this->cat_empleado[$i]['DESCRIPCION']?></option>
                            <?php }else{?>
                                 <option value="<?php echo $this->cat_empleado[$i]['ID_CATEGORIA_EMPLEADO'];?>"><?php echo $this->cat_empleado[$i]['DESCRIPCION']?></option>
                            <?php } ?>
                           <?php } ?>
                      </select>
                </div>
            </div>

          <?php if(isset ($this->datos[0]['ID_EMPLEADO'])) {
                           echo '<div class="col-md-4">' ;
              }else{
                            echo '<div class="col-md-6">' ;
              } ?>

              <div class="form-group" style="margin-right: 0px;">
                    <label class="control-label" for="estado_civil" >ESTADO CIVIL:&nbsp;&nbsp;&nbsp;&nbsp;*</label>
                  
                      <select  class="form-control glyphicon" name='estado_civil' id='estado_civil'>
                           <option value='' >Selecciona...</option>
                           <?php 
                           $estado_civil = array('soltero(a)','casado(a)','divorciado(a)','viudo(a)');
                            for($i=0;$i<count($estado_civil);$i++){ ?> 
                            <?php if(strcmp($this->datos[0]['ESTADO_CIVIL'], $estado_civil[$i])==0){?>
                                 <option selected value="<?php echo $estado_civil[$i];?>"><?php echo strtoupper($estado_civil[$i]);?></option>
                            <?php }else{?>
                                 <option value="<?php echo $estado_civil[$i];?>"><?php echo strtoupper($estado_civil[$i]);?></option>
                            <?php } ?>
                           <?php } ?>
                          
                      </select>
                
                  </div>
            </div>
       </div>

        <div class="row"  >
            <div class="col-md-4">
                <div class="form-group" style="margin-right: 0px;">
                    <label class="control-label "  for="nombre" > NOMBRE:&nbsp;&nbsp;&nbsp;&nbsp;*</label>
                      <input  onKeyPress="return soloLetras(event);" maxlength='30' name="nombre" id="nombre" class="form-control"  placeholder="Nombre(s)"
                            value="<?php if(isset ($this->datos[0]['NOMBRE']))echo $this->datos[0]['NOMBRE']?>">
                
                </div>  
            </div>

            <div class="col-md-4">
            <div class="form-group" style="margin-right: 0px;">
                    <label class="control-label" for="apellido_paterno" >APELLIDO PATERNO:&nbsp;&nbsp;&nbsp;&nbsp;*</label>
                      <input onKeyPress="return soloLetras(event);" maxlength='30'  name="apellido_paterno" id="apellido_paterno" class="form-control"  placeholder="Apellido Paterno" 
                            value="<?php if(isset ($this->datos[0]['APELLIDO_PATERNO']))echo $this->datos[0]['APELLIDO_PATERNO']?>">
                    
                  </div>
            </div>

            <div class="col-md-4">
            <div class="form-group" style="margin-right: 0px;">
                    <label class="control-label" for="apellido_materno" >APELLIDO MATERNO:&nbsp;&nbsp;&nbsp;&nbsp;*</label>
                
                      <input  onKeyPress="return soloLetras(event);"  maxlength='30' name="apellido_materno" id="apellido_materno" class="form-control"  placeholder="Apellido Materno" 
                            value="<?php if(isset ($this->datos[0]['APELLIDO_MATERNO']))echo $this->datos[0]['APELLIDO_MATERNO']?>">
                   
                  </div>
             </div>
        </div>

    
        
        <div class="row" >
            <div class="col-md-4">
                <div class="form-group" style="margin-right: 0px;">
                <label class="control-label" for="dni" >DNI:&nbsp;&nbsp;&nbsp;&nbsp;*</label>
                
                  <input onKeyPress="return soloNumeros(event);" maxlength='8'  name="dni" id="dni" class="form-control"  placeholder="DNI" 
                        value="<?php if(isset ($this->datos[0]['DNI']))echo $this->datos[0]['DNI']?>">
        
              </div>
            </div>
             
             <div class="col-md-4">
                 <div class="form-group" style="margin-right: 0px;">
                    <label class="control-label" for="email" >E-MAIL:</label>
            
                      <input type="email" id="email" class="form-control"  placeholder="E-mail"  name='email'
                            value="<?php if(isset ($this->datos[0]['EMAIL'])) echo $this->datos[0]['EMAIL']?>">
                  
                  </div>
            </div>
            <div class="col-md-4">
                <div class="form-group" style="margin-right: 0px;">
                    <label class="control-label " for="telefono" >TELEFONO:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    
                      <input  onKeyPress="return soloNumeros(event);" maxlength='9'  name="telefono" id="telefono" class="form-control"  placeholder="Telefono" 
                            value="<?php if(isset ($this->datos[0]['TELEFONO'])) echo $this->datos[0]['TELEFONO']?>">
                
                  </div>
            </div>
        </div>

        <div class="row" >

            <div class="col-md-4">
                <div class="form-group" style="margin-right: 0px;">
                    <label class="control-label" for="celular" >CELULAR:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    
                      <input  onKeyPress="return soloNumeros(event);" maxlength='9'   name="celular" id="celular" class="form-control" placeholder="Celular" 
                            value="<?php if(isset ($this->datos[0]['CELULAR'])) echo $this->datos[0]['CELULAR']?>">
                
                  </div>
            </div>

            <div class="col-md-4">
                 <div class="form-group" style="margin-right: 0px;">
                    <label class="control-label" for="sexo" >SEXO:&nbsp;&nbsp;&nbsp;&nbsp;*</label>
                    
                      <select  class="form-control glyphicon" name='sexo' id='sexo'>
                        <option value='' >Selecciona...</option>
                           <?php 
                           $sexo = array('femenino','masculino');
                           $sexo_id = array('F','M');
                            for($i=0;$i<count($sexo);$i++){ ?> 
                            <?php if(strcmp($this->datos[0]['SEXO'], $sexo_id[$i])==0){?>
                                 <option selected value="<?php echo $sexo_id[$i];?>"><?php echo strtoupper($sexo[$i]);?></option>
                            <?php }else{?>
                                 <option value="<?php echo $sexo_id[$i];?>"><?php echo strtoupper($sexo[$i]);?></option>
                            <?php } ?>
                           <?php } ?>
                      </select>
                   
                  </div>
            </div>

            <div class="col-md-4">
                <div class="form-group" style="margin-right: 0px;">
                <label class="control-label" for="numero_hijo" >NUMERO DE HIJOS:</label>
               
                  <input onKeyPress="return soloNumeros(event);" maxlength='9' s name="numero_hijo" id="numero_hijo" class="form-control"   placeholder="Numero de Hijos" 
                        value="<?php if(isset ($this->datos[0]['NUMERO_HIJO'])) echo $this->datos[0]['NUMERO_HIJO']?>">
            
              </div>
            
             </div>

        </div>
        

        <div class="row">
            <div class="col-md-4">
                <div class="form-group" style="margin-right: 0px;">
                    <label  class="control-label" for="direccion" >DIRECION:&nbsp;&nbsp;&nbsp;&nbsp;*</label>
                    
                      <input  name="direccion" id="direccion" class="form-control"  placeholder="Direccion" 
                            maxlength='45' value="<?php if(isset ($this->datos[0]['DIRECCION'])) echo $this->datos[0]['DIRECCION']?>">
                    </div>
            </div>

            <div class="col-md-4">
                 <div class="form-group" style="margin-right: 0px;">
                    <label class="control-label" for="fecha_nacimiento" >FECHA NACIMIENTO:&nbsp;&nbsp;&nbsp;&nbsp;*</label>
                   
                      <input  readonly name="fecha_nacimiento" id="fecha_nacimiento" class="form-control"   placeholder="Fecha Nacimiento" 
                            value="<?php if(isset ($this->datos[0]['FECHA_NACIMIENTO'])) echo $this->datos[0]['FECHA_NACIMIENTO']?>">
                    
                  </div>
            </div>

            <div class="col-md-4">
                 <div class="form-group" style="margin-right: 0px;">
                        <label class="control-label" for="grado_estudio" >GRADO DE ESTUDIO:</label>

                          <input s name="grado_estudio" id="grado_estudio" class="form-control" placeholder="Grado de Estudio" 
                                value="<?php if(isset ($this->datos[0]['GRADO_ESTUDIO'])) echo $this->datos[0]['GRADO_ESTUDIO']?>">

                      </div>

            </div>
        </div>
        
        <div class="form-group" style="margin-top: 8%"> 
            <div class="col-sm-offset-3 col-sm-8">
            <button type="button" class="btn btn-primary" id="save"> Guardar</button>
                <a style="margin-left: 8%" href="<?php echo BASE_URL?>empleado"  class="btn btn-danger">Cancelar</a>
            </div>
        </div>

    </form>
    </div>