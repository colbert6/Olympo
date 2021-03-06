<?php $hoy=  date("Y")."-".date("m")."-".date("d");?>
<link href="<?php echo $_params['ruta_css']; ?>jquery-ui.custom.css" rel="stylesheet" />
<script src="<?php echo $_params['ruta_js']; ?>bootbox.min.js"></script>
<style>
    .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6,
    .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11 {
        padding-left: 0px;
        padding-right: 10px;
    }
</style>

<div class="navbar-inner">
    <form method="post" action="<?php if (isset($this->action)) echo $this->action ?>" id="frm" class="form-horizontal">
        <input type="hidden" name="guardar" id="guardar" value="1" />
        
        <div class="row" style="border-bottom: solid 1px #D8D8D8;margin: 0px 0px 0px 0px;" >
            <div class="col-md-4" style="padding-right: 0px;">
                <div class="form-group" style="margin: 5px 0px 5px 0px;" >
                    <label class="col-md-4 control-label" >Comprobante:</label>
                    <div class="col-md-7" style="padding-right: 0px;">
                        <select id="sel_tipo_documento" name="sel_tipo_documento" class="form-control" >
                            <option value="0"></option>
                            <option value="1">TICKE SIMPLE</option>
                            <option value="2">BOLETA</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4" style="padding-left: 0px;">
                <div class="form-group" style="margin: 5px auto 5px auto" >
                    <label class="col-md-2 control-label" > Nro.:</label>
                    <div class="col-md-7" style="padding-right: 0px;">
                        <input name="nrodoc" id="nrodoc" class="form-control" readonly="readonly" onkeypress="return serieComprobante(event)" 
                           placeholder="Numero Documento" maxlength="20"  >
                    </div>
                </div>
            </div>
            <div class="col-md-4" style="padding-left: 0px;">
                <div class="form-group" style="margin: 5px auto 5px auto">
                    <label class="col-md-2 control-label"> Fecha:</label>
                    <div class="col-md-7" style="padding-right: 0px;">
                        <input name="fechaventa" id="fechaventa" class="form-control"  placeholder="Fecha" readonly="readonly" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>
            </div>
        </div>
       
        <div class="row" style="margin: 0px 0px 0px 0px;" >
            <div class="col-md-6" >
                <div class="form-group" style="margin: 5px 0px 5px 0px;" >
                    <label class="col-md-3 control-label" > Cliente:</label>
                    <div class="col-md-9" >
                        <input type="hidden" name="id_cliente" id="id_cliente" value="<?php if(isset ($this->matricula[0]['ID_SOCIO']))echo $this->matricula[0]['ID_SOCIO']?>"/>
                        <input type="text" name="cliente" id="cliente" readonly="readonly" data-toggle="modal" data-target="#modalSocio" class="form-control" style="width: 86%" 
                           value="<?php if(isset ($this->matricula[0]['NOMBRE']))echo $this->matricula[0]['NOMBRE']." ".$this->matricula[0]['APELLIDO_PATERNO']." ".$this->matricula[0]['APELLIDO_MATERNO'];?>" />
                        <button data-toggle="modal" data-target="#modalSocio" type="button" class="btn btn-sm btn-primary" title="Buscar Cliente" id="AbrirVtnBuscarSocio"><i class="icon-search icon-white"></i></button>
                    <!--button style="margin-right: 5px" data-toggle="modal" data-target="#modalNuevoCliente" type="button" class="btn btn-primary btn-sm" title="Insertar Cliente"><i class="icon-plus icon-white"></i></button-->
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group" style="margin: 5px 0px 5px 0px;" >
                    <label class="col-md-2 control-label" > Tipo Pago:</label>
                    <div class="col-md-7" style="padding-right: 0px;">
                        <select id="id_tipopago" name="id_tipopago" class="form-control">
                            <option value="0"></option>
                            <option value="1">Contado</option>
                            <option value="2">Credito</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="border-bottom: solid 1px #D8D8D8;margin: 0px 0px 5px 0px;" >
            <div class="col-md-6 " >
                <div id="historia_socio" style="float:left;" >
                    <div class="form-group" style="float:left;margin: 5px 20px 5px 40px;">
                        <label class="col-md-4 control-label" style="width: 50px;margin-right: 0px;"> Deuda:</label>
                        <input name="deuda_socio" id="deuda_socio" class="form-control"  placeholder="Deuda" readonly
                                style="width: 70px"   >
                    </div>
                    <div class="form-group" style="float:left;margin: 5px 20px 5px auto;">
                        <label class="col-md-4 control-label" style="width: 70px;margin-right: 5px;"> Calificacion:</label>
                        <input name="retraso_socio" id="retraso_socio" class="form-control"  placeholder="Deuda" readonly
                                style="width: 70px"   >
                    </div>
                    <div class="form-group" style="float:left;margin: 8px 0px auto 10px; ">
                        <button type="button" class="btn btn-primary btn-sm" title="Ver Historial" id="verHistorial"  onclick="cargarHistorialGraf()"><i class="icon-signal icon-white"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <input type="hidden" name="estado_cronograma"  id="estado_cronograma" value="0" >
                <div id="celda_cronograma" style="display: none;"></div>
                <div id="celda_credito" style="float:left;display: none;" >
                    <div class="form-group" style="float:left;margin: 5px 20px 5px auto;">
                        <label class="col-md-4 control-label" style="width: 50px;margin-right: 12px;"> Cuotas:</label>
                        <input name="cuotas" id="cuotas" class="form-control"  placeholder="Cuotas" onkeypress="return soloNumeros(event)"
                                style="width: 70px"  maxlength="2"  >
                    </div>
                    <div class="form-group"  style="float:left;margin: 5px 20px 5px 10px;">
                        <label class="col-md-4 control-label" style="width: 55px;margin-right: 5px;padding-top: 0px;">Intervalo Dias:</label>
                        <input name="intervalo" id="intervalo" class="form-control"  onkeypress="return soloNumeros(event)"
                                style="width: 60px"  maxlength="3"  >
                    </div>
                    <div class="form-group" style="float:left;margin: 5px 0px auto 10px; ">
                        <label>
                            C.A
                            <input type="checkbox" name="CronogramaAbierto"  id="CronogramaAbierto" style="width: 15px;margin: 5px;" >
                            
                        </label>
                    </div> 
                </div>
            </div>
        </div>
        
        <div class="row" style="margin: 0px 0px 0px 0px;" >
            <div class="col-md-4">
                <div class="form-group" style="margin: 5px 0px 5px 0px;" >
                    <label class="col-md-4 control-label" style="width: 90px;"> Vender:</label>
                    <div class="col-md-7">
                        <select id="sel_venta" name="sel_venta" class="form-control">
                            <option selected value="1">Servicio</option>
                            <option value="2">Producto</option>
                        </select>
                    </div>
                </div>
            </div>
            <div  id="celda_matricula" style="margin: 0px 0px 0px 0px;" >
                <div class="col-md-8" style="padding-right: 0px;">
                    <div class="form-group" style="margin: 5px 0px 5px 0px;">
                        <label class=" col-md-2 control-label" >Membresia:</label>
                        <div class="col-md-4" style="padding-right: 0px;">
                            <input type="hidden" name="id_matricula" id="id_matricula" value="<?php if(isset ($this->matricula[0]['ID_MATRICULA']))echo $this->matricula[0]['ID_MATRICULA'];?>"/>
                            <input type="hidden" name="id_membresia" id="id_membresia" value="<?php if(isset ($this->matricula[0]['ID_TIPO_MEMBRESIA']))echo $this->matricula[0]['ID_TIPO_MEMBRESIA'];?>"/>
                            <input type="hidden" name="socio" id="socio" value="<?php if(isset ($this->matricula[0]['NOMBRE']))echo $this->matricula[0]['NOMBRE']." ".$this->matricula[0]['APELLIDO_PATERNO'];?>"/>
                            <input type="text" name="membresia" id="membresia" readonly="readonly" placeholder="Seleccione Membresia" class="form-control" data-toggle="modal" data-target="#modalMembresia"  style="width: 150px"
                                   value="<?php if(isset ($this->matricula[0]['DESCRIPCION']))echo $this->matricula[0]['DESCRIPCION']." ".$this->matricula[0]['DURACION']." ".$this->matricula[0]['VIGENCIA'];?>"/>
                            <button type="button" data-toggle="modal" data-target="#modalMembresia" class="btn btn-primary btn-sm" title="Buscar Membresia" id="AbrirVtnBuscarMembresia"><i class="icon-search icon-white"></i></button>
                        </div>
                        <div class="col-md-6" style="margin-left: 0px;padding-left: 20px;padding-right: 0px;">
                            <input type="text" name="fecha_ini" id="fecha_ini" placeholder="Fecha Inicio" class="form-control" maxlength="10" style="width: 110px" readonly
                           value="<?php if(isset ($this->matricula[0]['ID_MATRICULA']))echo date('Y-m-d');?>"/>
                            <input type="text" name="precio_m" id="precio_m" placeholder="Precio" class="form-control" onkeypress="return dosDecimales(event,this)" style="width: 110px" 
                           value="<?php if(isset ($this->matricula[0]['COSTO'])) echo $this->matricula[0]['COSTO'];?>"/>  
                            <button type="button" class="btn btn-primary btn-sm" title="Agregar al Detalle" id="addDetalleMembresia"><i class="icon-hand-down icon-white"></i></button>
                        </div>
                        
                    </div>
                </div> 
            </div>
            <div id="celda_producto" style="display:none;margin: 0px 0px 0px 0px;border-bottom: solid 1px #D8D8D8;" >
                <div class="col-md-4 " style="padding-right: 0px;">
                    <div class="form-group" style="margin: 5px 0px 5px auto" style="padding-right: 0px;">
                        <label class="col-md-5 control-label" >Almacen:</label>
                        <div class="col-md-7" style="padding-right: 0px;">
                            <select class="form-control" name='sel_almacen' id='sel_almacen' placeholder="">
                                <option value='' ></option>
                                <?php for($i=0;$i<count($this->almacen);$i++){ //Aca va la lista de los modulos padres ?> 
                                    <?php if( $this->almacen[$i]['ID_ALMACEN']==1){?>
                                        <option selected value="<?php echo $this->almacen[$i]['ID_ALMACEN'];?>"><?php echo $this->almacen[$i]['DESCRIPCION']?></option>
                                   <?php }else{?>
                                        <option value="<?php echo $this->almacen[$i]['ID_ALMACEN'];?>"><?php echo $this->almacen[$i]['DESCRIPCION']?></option>
                                   <?php } ?>

                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" style="margin: 5px auto 5px auto">
                        <label class=" col-md-4 control-label" style="width: 150px" >Stock en Almacen:</label>
                        <div class="col-md-3">
                            <input type="text" name="stockactual" id="stockactual" class="form-control" readonly/>
                        </div>
                    </div>
                </div>
                
            <div class="row"  style="margin: 0px 0px 0px 0px;">    
                <div class="col-md-6">
                    <div class="form-group" style="margin: 0px auto 5px auto">
                        <label class=" col-md-4 control-label" >Producto:</label>
                        <div class="col-md-8">
                            <input type="hidden" name="id_producto" id="id_producto"/>
                            <input type="hidden" name="id_almacen" id="id_almacen"/>
                            <input type="hidden" name="almacen" id="almacen"/>
                            <input type="text" name="producto" id="producto" readonly="readonly" placeholder="Seleccione Producto" class="form-control" data-toggle="modal" data-target="#modalProducto"  style="width: 170px"/>
                            <button type="button" data-toggle="modal" data-target="#modalProducto" class="btn btn-primary btn-sm" title="Buscar Producto" id="AbrirVtnBuscarProducto"><i class="icon-search icon-white"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="margin: 0px auto 5px auto">
                    <input type="text" name="cantidad" id="cantidad" placeholder="Cantidad" class="form-control" onkeypress="return soloNumeros(event)" maxlength="3" style="width: 110px" />
                    <input type="text" name="precio" id="precio" placeholder="Precio" class="form-control" onkeypress="return dosDecimales(event,this)" style="width: 110px" />  
                    <input type="text" name="importe" id="importe" placeholder="Importe" class="form-control" readonly="readonly" style="width: 110px" />
                    <button type="button" class="btn btn-primary btn-sm" title="Agregar al Detalle" id="addDetalleProducto"><i class="icon-hand-down icon-white"></i></button>
                </div> 
            </div> 
            </div>
            
        </div>
        
        
        
        <div class="row">
            <div class="col-md-12" style="margin: 5px auto;">
                <table class="table table-striped table-bordered table-hover table-condensed" id="tblDetalle">
                    <th>Tipo</th>
                    <th>Descripcion</th>
                    <th>Soc. / Alm.</th>
                    <th>Fecha / Cant</th>
                    <th>Precio</th>
                    <th>Importe (S/.)</th>
                    <th>Acciones</th>   
                </table>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12 text-right">
                SUBTOTAL (S/.)
                <input type="text" id="subtotal" name="subtotal" readonly="readonly" class="form-control"  style="width: 150px"/><br/>
                <input type="checkbox" id="chbx_igv" name="chbx_igv"/>
                IGV (%)
                <input type="text" id="igv" name="igv" readonly="readonly" class="form-control"  style="width: 150px"/><br/>
                TOTAL (S/.)
                <input type="text" id="total" name="total" readonly="readonly" class="form-control"  style="width: 150px"/>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12 text-center">
                <p>
                    <button type="button" class="btn btn-info" id="verCuotas" style="display:none;">Ver Cronograma</button>
                    <button type="button" class="btn btn-primary" id="save">Guardar</button>
                    <a href="<?php echo BASE_URL ?>venta" class="btn btn-danger">Cancelar</a>
                </p>
            </div>
        </div>
    </form>
    
    
    <!-- Modal -->
    <style>
        #modalSocio .modal-content,#modalProducto .modal-content,#modalMembresia .modal-content{
            width: 800px;
            left: -18%;
        }
        #modalHistorialSocio .modal-content{
            width: 850px;
            left: -20%;
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
    <div id="modalProducto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Lista de Productos</h3>
            <h4 id="title_almacen"></h4>
        </div>
        <div class="modal-body">
            <form id="VtnBuscarProducto">
                <div class="navbar-inner text-center">
                    
                    <div id="grillaProducto">
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
    <div id="modalCuotas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Cronograma de Pago</h3>             
            <h4>Fecha: <?php echo  $hoy;?> </h4>
        </div>
        <div class="modal-body">
            <form id="VtnCuotas">
                <div class="navbar-inner text-center">
                    <div id="grillaCuotas">
                        <div class="page-header" >
                            <img src="<?php echo BASE_URL ?>lib/img/loading.gif" />
                        </div>
                    </div>

                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button id="guardar_cuotas" name="guardar_cuotas" class="btn btn-success" data-dismiss="modal" aria-hidden="true" style="display:none;" >Guardar</button>
            <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Cerrar</button>
        </div>
        </div>
        </div>
    </div>
    <div id="modalHistorialSocio" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Historial del Socio</h3>             
        </div>
        <div class="modal-body">
            <div id="VtnSocioHistorial">
                <div class="page-header" >
                            <img src="<?php echo BASE_URL ?>lib/img/loading.gif" />
                        </div>
            </div>
        </div>
        <div class="modal-footer">
            <button id="guardar_cuotas" name="guardar_cuotas" class="btn btn-success" data-dismiss="modal" aria-hidden="true" style="display:none;" >Guardar</button>
            <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Cerrar</button>
        </div>
        </div>
        </div>
    </div>
