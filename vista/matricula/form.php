<link href="<?php echo $_params['ruta_css']; ?>jquery-ui.custom.css" rel="stylesheet" />
<script src="<?php echo $_params['ruta_js']; ?>bootbox.min.js"></script>
<div class="navbar-inner">
    
    <form class="form-horizontal" role="form" id="frm" method="post" action="<?php echo $this->action; ?>">
        <input name="guardar" id="guardar" type="hidden" value="1">
        
        <?php if(isset ($this->datos[0]['ID_MATRICULA'])) {?>
        <div class="row"  style="border-bottom: solid 1px #D8D8D8;margin: 0px 0px 0px 0px;">
            <div class="form-group">
                <label class="control-label col-sm-6" >Item:</label>
                <div class="col-sm-6">
                    <input name="id_almacen" id="id_almacen" class="form-control"  readonly="readonly"
                       value="<?php echo $this->datos[0]['ID_ALMACEN'];?>">
                </div>
            </div> 
        </div> 
        <?php } ?>  
           
        <div class="row"  style="border-bottom: solid 1px #D8D8D8;margin: 0px 0px 0px 0px;">
             <div class="col-md-7 ">
                <div class="form-group" style="margin: 5px auto 5px auto">
                <label class="col-md-4 control-label" >Socio:</label>
                    <div >
                        <input type="hidden" name="id_socio" id="id_socio"/>
                        <input type="text" name="socio" id="socio" readonly="readonly" placeholder="Socio" data-toggle="modal" data-target="#modalSocio" class="form-control"  style="width: 60%;margin-left: 13px;" />
                        <button data-toggle="modal" data-target="#modalSocio" type="button" class="btn btn-primary btn-sm" title="Buscar Socio" id="AbrirVtnBuscarSocio"><i class="icon-search icon-white"></i></button>
                        <!--button style="margin-right: 10px" data-toggle="modal" data-target="#modalNuevoProveedor" type="button" class="btn btn-primary btn-sm" title="Insertar Socio"><i class="icon-plus icon-white"></i></button-->
                    </div>
                </div>
            </div>
            <div class="col-md-5 ">
                <div class="form-group" style="margin: 5px auto 5px auto">
                <label class="col-md-4 control-label" >DNI:</label>
                    <div class="col-md-7 ">
                    <input type="text" name="dni_socio" id="dni_socio" readonly="readonly" placeholder="DNI"  class="form-control"/>
                    </div>
                </div>
            </div>      
        </div>
        
        <div class="row" style="margin: 0px 0px 0px 0px;" >
             <div class="col-md-6 ">
                <div class="form-group" style="margin: 5px auto 5px auto">
                <label class="col-md-4 control-label" >Membresia:</label>
                    <div >
                        <input type="hidden" name="id_membresia" id="id_membresia"/>
                        <input type="text" name="tipo_membresia" id="tipo_membresia" readonly="readonly" placeholder="Membresia" data-toggle="modal" data-target="#modalMembresia" class="form-control"  style="width: 60%;margin-left: 13px;" />
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
        <div id="celda_servicios" style="display:none ">
            <div class="row" style="margin: 0px 0px 0px 0px;">
                <div class="col-md-5 ">
                    <div class="form-group" style="margin: 5px auto 5px auto">
                    <label class="col-md-6 control-label" >Servicio:</label>
                        <div >
                            <input type="hidden" name="id_servicio" id="id_servicio"/>
                            <input type="text" name="servicio" id="servicio" readonly="readonly" placeholder="Servicio" data-toggle="modal" data-target="#modalServicio" class="form-control"  style="width: 55%;margin-left: 11px;" />
                            <button data-toggle="modal" data-target="#modalServicio" type="button" class="btn btn-primary btn-sm" title="Buscar Servicio" id="AbrirVtnBuscarServicio"><i class="icon-search icon-white"></i></button>
                            <!--button style="margin-right: 10px" data-toggle="modal" data-target="#modalNuevoProveedor" type="button" class="btn btn-primary btn-sm" title="Insertar Socio"><i class="icon-plus icon-white"></i></button-->
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="form-group" style="margin: 5px auto 6px auto">
                    <label class="col-md-6 control-label" >Cantidad:</label>
                        <div class="col-md-5 ">
                            <input type="text" readonly="readonly" name="numero_servicios" id="numero_servicios" class="form-control" value=""/>
                        </div>
                    </div>
                </div> 

                <div class="col-md-4 ">
                    <div class="form-group" style="margin: 5px auto 5px auto">
                    <label class="col-md-6 control-label" >Precio:</label>
                        <div class="col-md-5 ">
                            <input type="" name="precio" id="precio" placeholder="Precio" class="form-control" value=""/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row" style="border-TOP: solid 1px #D8D8D8;margin: 0px 0px 0px 0px;">
            <div class="col-md-12" >
                <table class="table table-bordered" id="tblDetalle" style="margin-right: 10px;margin-top: 5px;">
                    <th>ITEM</th>
                    <th>SERVICIO</th>
                    <th>AMBIENTE</th>
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