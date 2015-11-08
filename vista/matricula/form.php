<link href="<?php echo $_params['ruta_css']; ?>jquery-ui.custom.css" rel="stylesheet" />
<script src="<?php echo $_params['ruta_js']; ?>bootbox.min.js"></script>
<div class="navbar-inner">
    
    <form class="form-horizontal" role="form" id="frm" method="post" action="<?php echo $this->action; ?>">
        <input name="guardar" id="guardar" type="hidden" value="1">
        
        <?php if(isset ($this->datos[0]['ID_MATRICULA'])) {?>
        <div class="row"  style="border-bottom: solid 1px #D8D8D8;margin: 0px 0px 0px 0px;">
            <div class="col-md-7 " >
                <div class="form-group" style="margin: 5px auto 5px auto">
                    <label class=" col-md-4 control-label " >Item:</label>
                    <div class="col-md-6">
                        <input name="id_matricula" id="id_matricula" class="form-control"  readonly="readonly"
                           value="<?php echo $this->datos[0]['ID_MATRICULA'];?>" >
                    </div>
                </div>
            </div> 
        </div> 
        <?php } ?>  
           
        <div class="row"  style="border-bottom: solid 1px #D8D8D8;margin: 0px 0px 0px 0px;">
            <div class="col-md-7 ">
                <div class="form-group" style="margin: 5px auto 5px auto">
                <label class="col-md-4 control-label" >Socio:</label>
                    <div>
                        <input type="hidden" name="id_socio" id="id_socio"
                               value="<?php if(isset($this->datos[0]['ID_SOCIO'])) echo $this->datos[0]['ID_SOCIO'] ?>"/>
                        <input type="text" name="socio" id="socio" readonly="readonly" placeholder="Socio" data-toggle="modal" data-target="#modalSocio" 
                               class="form-control"  style="width: 60%;margin-left: 13px;" value="<?php if(isset ($this->datos[0]['ID_SOCIO'])) echo $this->datos[0].['NOMBRE'].' '.$this->datos[0].['APELLIDO_PATERNO'].' '. $this->datos[0].['APELLIDO_MATERNO'];?>"/>
                        <?php if(!isset ($this->datos[0]['ID_SOCIO'])){?>
                        <button data-toggle="modal" data-target="#modalSocio" type="button" class="btn btn-primary btn-sm" title="Buscar Socio" id="AbrirVtnBuscarSocio"><i class="icon-search icon-white"></i></button>
                        <?php   } ?>
                        <!--button style="margin-right: 10px" data-toggle="modal" data-target="#modalNuevoProveedor" type="button" class="btn btn-primary btn-sm" title="Insertar Socio"><i class="icon-plus icon-white"></i></button-->
                    </div>
                </div>
            </div>
            <div class="col-md-5 ">
                <div class="form-group" style="margin: 5px auto 5px auto">
                <label class="col-md-4 control-label" >DNI:</label>
                    <div class="col-md-7 ">
                        <input type="text" name="dni" id="dni" readonly="readonly" placeholder="DNI" class="form-control"
                               value="<?php if(isset ($this->datos[0]['DNI'])) echo $this->datos[0]['DNI'];?>"/>
                    </div>
                </div>
            </div>      
        </div>
        
        <div class="row" style="margin: 0px 0px 0px 0px;" >
             <div class="col-md-6 ">
                <div class="form-group" style="margin: 5px auto 5px auto">
                <label class="col-md-4 control-label" >Membresia:</label>
                    <div >
                        <input type="hidden" name="id_membresia" id="id_membresia" value="<?php if(isset ($this->datos[0]['ID_TIPO_MEMBRESIA'])) echo $this->datos[0]['ID_TIPO_MEMBRESIA'];?>"/>
                        <input type="text" name="membresia" id="membresia" readonly="readonly" placeholder="Membresia" data-toggle="modal" data-target="#modalMembresia" class="form-control" 
                               value="<?php if(isset ($this->datos[0]['ID_TIPO_MEMBRESIA'])) echo $this->datos[0].['DESCRIPCION'].' '.$this->datos[0].['DURACION'].' '. $this->datos[0].['VIGENCIA'];?>" style="width: 60%;margin-left: 13px;" />
                        <button data-toggle="modal" data-target="#modalMembresia" type="button" class="btn btn-primary btn-sm" title="Buscar Membresia" id="AbrirVtnBuscarMembresia"><i class="icon-search icon-white"></i></button>
                        <!--button style="margin-right: 10px" data-toggle="modal" data-target="#modalNuevoProveedor" type="button" class="btn btn-primary btn-sm" title="Insertar Socio"><i class="icon-plus icon-white"></i></button-->
                    </div>
                </div>
            </div>
            <div class="col-md-6 ">
                <div class="form-group" style="margin: 5px auto 5px auto">
                <label class="col-md-7 control-label" >Fecha:</label>
                    <div class="col-md-5 ">
                        <input type="" name="fecha_registro" id="fecha_resgistro" readonly="readonly" class="form-control" value="<?php echo date('Y-m-d'); ?> "/>
                    </div>
                </div>
            </div>       
        </div>
        <div id="celda_servicio" style="display:none ">
            <div class="row" style="margin: 0px 0px 0px 0px;">
                <div class="col-md-5 ">
                    <div class="form-group" style="margin: 5px auto 5px auto">
                    <label class="col-md-6 control-label" >Servicio:</label>
                        <div >
                            <input type="text" name="servicio_sel" id="servicio_sel" readonly="readonly" placeholder="Servicio" data-toggle="modal" data-target="#modalServicio" class="form-control"  style="width: 55%;margin-left: 11px;" />
                            <button data-toggle="modal" data-target="#modalServicio" type="button" class="btn btn-primary btn-sm" title="Buscar Servicio" id="AbrirVtnBuscarServicio"><i class="icon-search icon-white"></i></button>
                            <!--button style="margin-right: 10px" data-toggle="modal" data-target="#modalNuevoProveedor" type="button" class="btn btn-primary btn-sm" title="Insertar Socio"><i class="icon-plus icon-white"></i></button-->
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="form-group" style="margin: 5px auto 6px auto">
                    <label class="col-md-6 control-label" >Cantidad:</label>
                        <div class="col-md-5 ">
                            <input type="text" readonly="readonly" name="numero_servicios" id="numero_servicios" class="form-control" 
                                   value="<?phpif(isset ($this->datos[0]['NUMERO_SERVICIOS'])) echo $this->datos[0]['NUMERO_SERVICIOS'];?>"/>
                        </div>
                    </div>
                </div> 

                <div class="col-md-4 ">
                    <div class="form-group" style="margin: 5px auto 5px auto">
                    <label class="col-md-6 control-label" >Precio:</label>
                        <div class="col-md-5 ">
                            <input readonly="readonly" name="precio"  id="precio" placeholder="Precio" class="form-control" 
                                   value="<?phpif(isset ($this->datos[0]['COSTO'])) echo $this->datos[0]['COSTO'];?>"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row" style="border-top: solid 1px #D8D8D8;margin: 0px 0px 0px 0px;">
            <div class="col-md-12" >
                <table class="table table-bordered" id="tblDetalle" style="margin-right: 10px;margin-top: 5px;">
                    <th>Item</th>
                    <th>Servicio</th>
                    <th>Ambiente</th>
                    <th>Acciones</th>   
                </table>
            </div>
        </div> 
       
        <div class="row-fluid">
            <div class="span12 text-center">
                <p>
                    <button type="button" class="btn btn-primary" id="save">Guardar</button>
                    <a href="<?php echo BASE_URL ?>matricula" class="btn btn-danger">Cancelar</a>
                </p>
            </div>
        </div>

    </form>
    
    <!-- Modal -->
    <style>
        #modalMembresia .modal-content,#modalSocio .modal-content,#modalServicio .modal-content {
            width: 800px;
            left: -18%;
        }
    </style>
    <div id="modalMembresia" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Lista de Membresias</h3>
        </div>
        <div class="modal-body">
            <form id="VtnBuscarMembresia">
                <div class="navbar-inner text-center">
                    
                    <div id="grillaMembresia">
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
    
    <div id="modalSocio" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Lista de Socios</h3>
        </div>
        <div class="modal-body">
            <form id="VtnBuscarSocio">
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
    <div id="modalServicio" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Lista de Servicios</h3>
        </div>
        <div class="modal-body">
            <form id="VtnBuscarServicio">
                <div class="navbar-inner text-center">
                    
                    <div id="grillaServicio">
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