
    <div class="navbar-inner">
    
    <div class="col-md-3"></div>
    <div class="col-md-5" style="color:#000">
        <label label class="control-label col-sm-3">Actor:</label>
        <div class="col-md-3">
                <select required name="actor" id="actor">
                    <option value="0">Seleccione...</option>
                    <option value="1">SOCIO</option>
                    <option value="2">EMPLEADO</option>
                </select>
        </div>

    <div id='socio' style='margin-top:70px;'>

    <form  role="form" id="frm1" method="post" action="<?php echo $this->action; ?>">
        <input name="guardar" id="guardar" type="hidden" value="1">
        <input name="tipo" id="tipo_s" type="hidden" >
        
        <div class="form-group">
            <input name="id_socio" id="id_socio" type="hidden">
            <input type="text" name="n_socio" id="n_socio" readonly="readonly" placeholder="Buscar Socio" class="form-control"  style="width: 88%" value=""/>
            <button data-toggle="modal" data-target="#modalSocio" type="button" class="btn btn-primary btn-sm" title="Buscar Socio" id="btnBSocio"><i class="icon-search icon-white"></i></button>
        
        </div>

        <div class="form-group">
            <label class="control-label " >USUARIO:</label>    
            <input name="user" id="user_s" maxlength='40' placeholder="Usuario" class="form-control" value=""/>
           
        
        </div>

        <div class="form-group">
            <label class="control-label " >CONTRASEÑA:</label>    
            <input name="pass" id="pass_s" type='password' maxlength='20' placeholder="Contraseña" class="form-control" value=""/>
        
        </div>
       
        <div class="form-group" style="margin-top: 8%"> 
            <div class="col-sm-offset-3 col-sm-8">
            <button type="button" class="btn btn-primary" id="save1"> Guardar</button>
                <a style="margin-left: 8%" href="<?php echo BASE_URL?>asignar_usuario"  class="btn btn-danger">Cancelar</a>
            </div>
        </div>
        
    </form>
    </div>

    <div id='empleado' style='margin-top:70px;'>
    <form  role="form" id="frm2" method="post" action="<?php echo $this->action; ?>">
        <input name="guardar" id="guardar" type="hidden" value="1">
        <input name="tipo" id="tipo_e" type="hidden" >
        
        <div class="form-group">
            <input name="id_empleado" id="id_empleado" type="hidden">
            <input type="text" name="n_empleado" id="n_empleado" readonly="readonly" placeholder="Buscar Empleado"
                               class="form-control"  style="width: 88%"/>
            <button data-toggle="modal" data-target="#modalEmpleado" type="button" class="btn btn-primary btn-sm" title="Buscar Empleado" id="btnBEmpleado"><i class="icon-search icon-white"></i></button>
        
        </div>

        <div class="form-group">
            <label class="control-label " >USUARIO:</label>    
            <input name="user" id="user_e" placeholder="Usuario" maxlength='40' class="form-control" value=""/>
           
        
        </div>

        <div class="form-group">
            <label class="control-label " >CONTRASEÑA:</label>    
            <input name="pass" type='password' id="pass_e" placeholder="Contraseña" maxlength='20' class="form-control" value=""/>
        
        </div>

        <div class="form-group">
            <label class="control-label " >PERFIL:</label>    
            <select id='id_perfil_usuario' class="form-control" name='id_perfil_usuario'>
                <option value='0'>---SELECCIONA---</option>
                <?php if(isset($this->perfiles) &&  count($this->perfiles)){?>
                <?php   for ($i=0; $i < count($this->perfiles) ; $i++) { ?>
                                <option value='<?php echo $this->perfiles[$i]["ID_PERFIL_USUARIO"]; ?>'><?php echo $this->perfiles[$i]["DESCRIPCION"]; ?></option>
                <?php   }?>       
                <?php }?>
            </select>
        
        </div>
       
        <div class="form-group" style="margin-top: 8%"> 
            <div class="col-sm-offset-3 col-sm-8">
            <button type="button" class="btn btn-primary" id="save2"> Guardar</button>
                <a style="margin-left: 8%" href="<?php echo BASE_URL?>asignar_usuario"  class="btn btn-danger">Cancelar</a>
            </div>
        </div>
        
    </form>
    </div>



    </div>

    <style>
        #modalSocio .modal-content, #modalEmpleado .modal-content{
            width: 800px;
            left: -18%;
        }
        #validaAdministrador #contenido{
            width: 300px;
            left: 25%;
        }

    </style>

    <div id="modalSocio" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Lista de Socios</h3>
        </div>
        <div class="modal-body">
            <form id="btn-socio">
                <div class="navbar-inner text-center">
                    
                    <div id="grillaSocio">
                        <div class="page-header">
                            <img src="<?php echo BASE_URL ?>lib/img/loading.gif" />
                        </div>
                    </div>
                    
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Cerrar</button>
        </div>
        </div>
        </div>
    </div>

    <div id="modalEmpleado" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Lista de Empleados</h3>
        </div>
        <div class="modal-body">
            <form id="btn-empleado">
                <div class="navbar-inner text-center">
                    
                    <div id="grillaEmpleado">
                        <div class="page-header">
                            <img src="<?php echo BASE_URL ?>lib/img/loading.gif" />
                        </div>
                    </div>
                    
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Cerrar</button>
        </div>
        </div>
        </div>
    </div>


    <div id="validaAdministrador" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
        <div class="modal-content" id='contenido'>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Cambiar Credencial</h3>
            <small>Usuario y Contraseña de Administrador</small>
        </div>
        <div class="modal-body">

        <input name="formulario" id="formulario" type='hidden' >
                    <div id='alerta'>
                    </div>
                    <div class="form-group">
                      <input name="user" id="user" class="form-control" type='text' placeholder="Usuario" value="">
                    </div> 
                    <div class="form-group">
                      <input  name="pass" id="pass" class="form-control"  type='password' placeholder="Contraseña" value="">
                    </div> 
        </div>
        <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cerrar</button>
            <button class="btn btn-success" data-dismiss="modal" id='cambiar' aria-hidden="true">Cambiar</button>
        </div>
        </div>
        </div>
    </div>