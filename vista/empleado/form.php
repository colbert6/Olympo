<div class="navbar-inner">
  </script>
    <div class="col-md-2"></div>
    <div class="col-md-7" style="color:#000">
    <form  role="form" id="frm" method="post" action="<?php echo $this->action; ?>">
        <input name="guardar" id="guardar" type="hidden" value="1">

         <?php 
        if(isset ($this->datos[0]['ID_EMPLEADO'])) {?>  
              <div class="form-group">
                <label class="control-label" >IDENTIFICADOR:</label>
                
                    <input name="id_empleado" id="id_empleado" class="form-control"  readonly="readonly"
                           value="<?php echo $this->datos[0]['ID_EMPLEADO'];?>">
        
              </div>  
        <?php } ?> 

        <div class="row">
         <div class="col-md-12">
                <div class="form-group">
                        <label class="control-label" >CATEGORIA EMPLEADO: &nbsp;&nbsp;&nbsp;&nbsp;*</label>
                       <select s class="form-control glyphicon" name='id_categoria_empleado' id='id_categoria_empleado' autofocus>
                           <option value='' >Selecciona...</option>
                           <?php for($i=0;$i<count($this->cat_empleado);$i++){ ?> 
                            <?php if( strcmp($this->datos[0]['ID_CATEGORIA_EMPLEADO'], $this->cat_empleado[$i]['ID_CATEGORIA_EMPLEADO']) == 0){?>
                                 <option selected value="<?php echo $this->cat_empleado[$i]['ID_CATEGORIA_EMPLEADO'];?>"><?php echo $this->cat_empleado[$i]['DESCRIPCION']?></option>
                            <?php }else{?>
                                 <option value="<?php echo $this->cat_empleado[$i]['ID_CATEGORIA_EMPLEADO'];?>"><?php echo $this->cat_empleado[$i]['DESCRIPCION']?></option>
                            <?php } ?>
                           <?php } ?>
                      </select>
                </div>
            </div>
       </div>

        <div class="row"  >
            <div class="col-md-12">
            <div class="form-group">
                    <label class="control-label "  for="nombre" > NOMBRE:&nbsp;&nbsp;&nbsp;&nbsp;*</label>
                      <input  onKeyPress="return soloLetras(event);" maxlength='30' name="nombre" id="nombre" class="form-control"  placeholder="Nombre(s)"
                            value="<?php if(isset ($this->datos[0]['NOMBRE']))echo $this->datos[0]['NOMBRE']?>">
                
                </div>  
            </div>

            <div class="col-md-12">
            <div class="form-group">
                    <label class="control-label" for="apellido_paterno" >APELLIDO PATERNO:&nbsp;&nbsp;&nbsp;&nbsp;*</label>
                      <input onKeyPress="return soloLetras(event);" maxlength='30'  name="apellido_paterno" id="apellido_paterno" class="form-control"  placeholder="Apellido Paterno" 
                            value="<?php if(isset ($this->datos[0]['APELLIDO_PATERNO']))echo $this->datos[0]['APELLIDO_PATERNO']?>">
                    
                  </div>
            </div>

            <div class="col-md-12">
            <div class="form-group">
                    <label class="control-label" for="apellido_materno" >APELLIDO MATERNO:&nbsp;&nbsp;&nbsp;&nbsp;*</label>
                
                      <input  onKeyPress="return soloLetras(event);"  maxlength='30' name="apellido_materno" id="apellido_materno" class="form-control"  placeholder="Apellido Materno" 
                            value="<?php if(isset ($this->datos[0]['APELLIDO_MATERNO']))echo $this->datos[0]['APELLIDO_MATERNO']?>">
                   
                  </div>
             </div>
        </div>

    
        
        <div class="row" >
            <div class="col-md-12">
                <div class="form-group">
                <label class="control-label" for="dni" >DNI:&nbsp;&nbsp;&nbsp;&nbsp;*</label>
                
                  <input onKeyPress="return soloNumeros(event);" maxlength='8'  name="dni" id="dni" class="form-control"  placeholder="DNI" 
                        value="<?php if(isset ($this->datos[0]['DNI']))echo $this->datos[0]['DNI']?>">
        
              </div>
            </div>
             
             <div class="col-md-12">
                 <div class="form-group">
                    <label class="control-label" for="email" >E-MAIL:</label>
            
                      <input  id="email" class="form-control"  placeholder="E-mail"  name='email'
                            value="<?php if(isset ($this->datos[0]['EMAIL'])) echo $this->datos[0]['EMAIL']?>">
                  
                  </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label " for="telefono" >TELEFONO:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    
                      <input  onKeyPress="return soloNumeros(event);" maxlength='9'  name="telefono" id="telefono" class="form-control"  placeholder="Telefono" 
                            value="<?php if(isset ($this->datos[0]['TELEFONO'])) echo $this->datos[0]['TELEFONO']?>">
                
                  </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label" for="celular" >CELULAR:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    
                      <input  onKeyPress="return soloNumeros(event);" maxlength='9'   name="celular" id="celular" class="form-control" placeholder="Celular" 
                            value="<?php if(isset ($this->datos[0]['CELULAR'])) echo $this->datos[0]['CELULAR']?>">
                
                  </div>
            </div>

            <div class="col-md-12">
                 <div class="form-group">
                    <label class="control-label" for="sexo" >SEXO:</label>
                    
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

           <!-- <div class="col-md-12">
            <div class="form-group">
                <label class="control-label" for="aliass" >ALIAS:</label>
                  <input maxlength='45' <?php echo $bloqueo;?> name="aliass" id="aliass" class="form-control"  placeholder="Alias" 
                        value="<?php if(isset ($this->datos[0]['ALIASS']))echo $this->datos[0]['ALIASS']?>">
        
              </div>
            </div>-->
            
        </div>
        <!--div class="row" >
            <div class="col-md-12">
                <div class="form-group">
                        <label class="control-label" >DEPARTAMENTO:</label>
                       <select <?php echo $bloqueo;?> class="form-control glyphicon" name='region' id='region'>
                           <option value='' >Selecciona...</option>
                           <?php for($i=0;$i<count($this->regiones);$i++){ ?> 
                                        <option value="<?php echo $this->regiones[$i]['CODIGO_REGION'];?>"><?php echo $this->regiones[$i]['DESCRIPCION']?></option>
                           <?php } ?>
                      </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                        <label class="control-label" >PROVINCIA:</label>
                       <select <?php echo $bloqueo;?> class="form-control glyphicon" name='provincia' id='provincia'>
                           <option value='' >Selecciona...</option>
                           
                      </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                        <label class="control-label" >DISTRITO</label>
                       <select <?php echo $bloqueo;?> class="form-control glyphicon" name='distrito' id='distrito'>
                           <option value='' >Selecciona...</option>
                           
                      </select>
                </div>
            </div>

        </div-->

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label  class="control-label" for="direccion" >DIRECION:&nbsp;&nbsp;&nbsp;&nbsp;*</label>
                    
                      <input  name="direccion" id="direccion" class="form-control"  placeholder="Direccion" 
                            maxlength='45' value="<?php if(isset ($this->datos[0]['DIRECCION'])) echo $this->datos[0]['DIRECCION']?>">
                    </div>
            </div>

            <div class="col-md-12">
                 <div class="form-group">
                    <label class="control-label" for="fecha_nacimiento" >FECHA NACIMIENTO:&nbsp;&nbsp;&nbsp;&nbsp;*</label>
                   
                      <input  readonly name="fecha_nacimiento" id="fecha_nacimiento" class="form-control"   placeholder="Fecha Nacimiento" 
                            value="<?php if(isset ($this->datos[0]['FECHA_NACIMIENTO'])) echo $this->datos[0]['FECHA_NACIMIENTO']?>">
                    
                  </div>
            </div>
            
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label" for="estado_civil" >ESTADO CIVIL:&nbsp;&nbsp;&nbsp;&nbsp;*</label>
                  
                      <select  class="form-control glyphicon" name='estado_civil' id='estado_civil'>
                           <option value='' >Selecciona...</option>
                           <?php 
                           $estado_civil = array('soltero','casado','divorciado','viudo');
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

        <div class="row" >
            
            <!--<div class="col-md-12">
                 <div class="form-group">
                    <label class="control-label" for="ocupacion" >OCUPACION:</label>
                   
                      <input s name="ocupacion" id="ocupacion" class="form-control" placeholder="Ocupacion" 
                            value="<?php if(isset ($this->datos[0]['OCUPACION'])) echo $this->datos[0]['OCUPACION']?>">
                   
                  </div>
            </div>
            div class="col-md-12">
                <div class="form-group">
                    <label class="control-label" for="grupo_sanguineo" >GRUPO SANGUINEO:</label>
                    
                      <input <?php echo $bloqueo;?> name="grupo_sanguineo" id="grupo_sanguineo" class="form-control" placeholder="Grupo Sanguineo" 
                            value="<?php if(isset ($this->datos[0]['GRUPO_SANGUINEO'])) echo $this->datos[0]['GRUPO_SANGUINEO']?>">
                   
                  </div>
            </div-->
        </div>
        
        <!--div class="row" >
            <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label " for="hobby" >HOBBY:</label>
                    
                      <input <?php echo $bloqueo;?> name="hobby" id="hobby" class="form-control"  placeholder="Hobby" 
                            value="<?php if(isset ($this->datos[0]['HOBBY'])) echo $this->datos[0]['HOBBY']?>">
                   
                  </div>
            </div>
            <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label" for="nacionalidad" >NACIONALIDAD:</label>
                    
                      <input <?php echo $bloqueo;?> name="nacionalidad" id="nacionalidad" class="form-control"  placeholder="Nacionalidad" 
                            value="<?php if(isset ($this->datos[0]['NACIONALIDAD'])) echo $this->datos[0]['NACIONALIDAD']?>">
                    
                  </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label" for="seguro_medico" >SEGURO MEDICO:</label>

                      <input <?php echo $bloqueo;?> name="seguro_medico" id="seguro_medico" class="form-control" placeholder="Seguro Medico" 
                            value="<?php if(isset ($this->datos[0]['SEGURO_MEDICO'])) echo $this->datos[0]['SEGURO_MEDICO']?>">
                  </div>
            </div>
        </div-->
        <!--div class="row" >
            <div class="col-md-12">
                  <div class="form-group">
                    <label  class="control-label" for="observacion" >OBSERVACION:</label>
                    
                      <input <?php echo $bloqueo;?> name="observacion" id="observacion" class="form-control" placeholder="Observacion" 
                            value="<?php if(isset ($this->datos[0]['OBSERVACION'])) echo $this->datos[0]['OBSERVACION']?>">
                   
                  </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label" for="antecedente_medico" >ANTECEDENTES MEDICOS:</label>
                    
                      <input <?php echo $bloqueo;?> name="antecedente_medico" id="antecedente_medico" class="form-control" placeholder="Antecedente Medico" 
                            value="<?php if(isset ($this->datos[0]['ANTECEDENTE_MEDICO'])) echo $this->datos[0]['ANTECEDENTE_MEDICO']?>">
                 
                  </div>

            </div>
            <div class="col-md-12">
               <div class="form-group">
                    <label class="control-label" for="codigo_postal" >CODIGO POSTAL:</label>
                  
                      <input <?php echo $bloqueo;?> name="codigo_postal" id="codigo_postal" class="form-control" placeholder="Codigo Postal" 
                            value="<?php if(isset ($this->datos[0]['CODIGO_POSTAL'])) echo $this->datos[0]['CODIGO_POSTAL']?>">
                
                  </div>

            </div>
        </div-->

         <div class="row" >
            <!--div class="col-md-12">
                  <div class="form-group">
                <label class="control-label" for="fax" >FAX:</label>
               
                  <input <?php echo $bloqueo;?> name="fax" id="fax" class="form-control" placeholder="Fax" 
                        value="<?php if(isset ($this->datos[0]['FAX'])) echo $this->datos[0]['FAX']?>">
            
              </div>
            </div-->
            <div class="col-md-12">
                <div class="form-group">
                <label class="control-label" for="numero_hijo" >NUMERO DE HIJOS:</label>
               
                  <input onKeyPress="return soloNumeros(event);" maxlength='9' s name="numero_hijo" id="numero_hijo" class="form-control"   placeholder="Numero de Hijos" 
                        value="<?php if(isset ($this->datos[0]['NUMERO_HIJO'])) echo $this->datos[0]['NUMERO_HIJO']?>">
            
              </div>

            </div>
           <!-- <div class="col-md-12">
               <div class="form-group">
                <label class="control-label" for="sector" >SECTOR:</label>
               
                  <input s name="sector" id="sector" class="form-control" placeholder="Sector" 
                        value="<?php if(isset ($this->datos[0]['SECTOR'])) echo $this->datos[0]['SECTOR']?>">

              </div>

            </div>-->
        </div>

        <div class="row" >
            <div class="col-md-12">
                 <div class="form-group">
                        <label class="control-label" for="grado_estudio" >GRADO DE ESTUDIO:</label>

                          <input s name="grado_estudio" id="grado_estudio" class="form-control" placeholder="Grado de Estudio" 
                                value="<?php if(isset ($this->datos[0]['GRADO_ESTUDIO'])) echo $this->datos[0]['GRADO_ESTUDIO']?>">

                      </div>

            </div>
            
            <div class="col-md-12">
                 <div class="form-group">
                        <label class="control-label" for="usuario" >USUARIO:</label>

                          <input  name="usuario" id="usuario" class="form-control" placeholder="Usuario" 
                                value="<?php if(isset ($this->datos[0]['USUARIO'])) echo $this->datos[0]['USUARIO']?>">

                      </div>

            </div>
            
            <div class="col-md-12">
                 <div class="form-group">
                        <label class="control-label" for="clave" >CLAVE:</label>

                          <input type="password" name="clave" id="clave" class="form-control" placeholder="Clave" 
                                value="<?php if(isset ($this->datos[0]['CLAVE'])) echo $this->datos[0]['CLAVE']?>">

                      </div>

            </div>
            
            <div class="col-md-12">
                <div class="form-group">
                        <label class="control-label" >PERFIL USUARIO: &nbsp;&nbsp;&nbsp;&nbsp;*</label>
                       <select class="form-control glyphicon" name='id_perfil_usuario' id='id_perfil_usuario'>
                           <option value='' >Selecciona...</option>
                           <?php for($i=0;$i<count($this->perfil);$i++){ ?> 
                            <?php if( strcmp($this->datos[0]['ID_PERFIL_USUARIO'], $this->perfil[$i]['ID_PERFIL_USUARIO']) == 0){?>
                                 <option selected value="<?php echo $this->perfil[$i]['ID_PERFIL_USUARIO'];?>"><?php echo $this->perfil[$i]['DESCRIPCION']?></option>
                            <?php }else{?>
                                 <option value="<?php echo $this->perfil[$i]['ID_PERFIL_USUARIO'];?>"><?php echo $this->perfil[$i]['DESCRIPCION']?></option>
                            <?php } ?>
                           <?php } ?>
                      </select>
                </div>
            </div>
            <!--div class="col-md-12">
                <div class="form-group">
                    <label class="control-label" for="ingreso" >INGRESO:</label>
                  
                      <input <?php echo $bloqueo;?> name="ingresos" id="ingreso" class="form-control"  placeholder="Ingreso" 
                            value="<?php if(isset ($this->datos[0]['INGRESOS'])) echo $this->datos[0]['INGRESOS']?>">
                 
                  </div>


            </div-->
            <!--div class="col-md-12">
               <div class="form-group">
                <label class="control-label" for="sector" >SECTOR:</label>
               
                  <input <?php echo $bloqueo;?> name="sector" id="sector" class="form-control"  placeholder="Sector" 
                        value="<?php if(isset ($this->datos[0]['SECTOR'])) echo $this->datos[0]['SECTOR']?>">

              </div>

            </div-->
        </div>
        
        <div class="form-group" style="margin-top: 8%"> 
            <div class="col-sm-offset-3 col-sm-8">
            <button type="button" class="btn btn-primary" id="save"> Guardar</button>
                <a style="margin-left: 8%" href="<?php echo BASE_URL?>empleado"  class="btn btn-danger">Cancelar</a>
            </div>
        </div>

    </form>
    </div>