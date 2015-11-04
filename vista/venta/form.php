
<link href="<?php echo $_params['ruta_css']; ?>jquery-ui.custom.css" rel="stylesheet" />
<script src="<?php echo $_params['ruta_js']; ?>bootbox.min.js"></script>
<div class="navbar-inner">
    <form method="post" action="<?php if (isset($this->action)) echo $this->action ?>" id="frm" class="form-horizontal">
        <input type="hidden" name="guardar" id="guardar" value="1"/>
        <input type="hidden" readonly="readonly" name="codigo" id="codigo"
               value="<?php if (isset($this->datos[0]['ID_VENTA'])) echo $this->datos[0]['ID_VENTA'] ?>"/>
        
        <div class="row" style="border-bottom: solid 1px #D8D8D8;margin: 0px 0px 0px 0px;" >
            <div class="col-md-7">
                <div class="form-group" style="margin: 5px auto 5px auto" >
                    <label class="col-md-4 control-label" > Cliente:</label>
                    <div class="col-md-9">
                        <input type="hidden" name="aceptacredito" id="aceptacredito"/>
                    <input type="hidden" name="id_socio" id="id_socio"/>
                    <input type="text" name="socio" id="socio" readonly="readonly" data-toggle="modal" data-target="#modalSocio" class="form-control" style="width: 70%" />
                    <button data-toggle="modal" data-target="#modalSocio" type="button" class="btn btn-sm btn-primary" title="Buscar Cliente" id="AbrirVtnBuscarSocio"><i class="icon-search icon-white"></i></button>
                    <!--button style="margin-right: 5px" data-toggle="modal" data-target="#modalNuevoCliente" type="button" class="btn btn-primary btn-sm" title="Insertar Cliente"><i class="icon-plus icon-white"></i></button-->
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group" style="margin: 5px auto 5px auto" >
                    <label class="col-md-4 control-label" > Nro. Doc.:</label>
                    <div class="col-md-8">
                        <input name="nrodoc" id="nrodoc" class="form-control" readonly="readonly" onkeypress="return serieComprobante(event)" 
                           placeholder="Numero Documento" maxlength="20"  >
                    </div>
                </div>
            </div>
        </div>
       
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
            <div class="col-md-3" style="padding-right: 0px;">
                <div class="form-group" style="margin: 5px 0px 5px 0px;" >
                    <label class="col-md-4 control-label" style="width: 70px;padding-top: 0px;" > Tipo Pago:</label>
                    <div class="col-md-7" style="padding-right: 0px;">
                        <select id="id_tipopago" name="id_tipopago" class="form-control">
                            <option value="0"></option>
                            <option value="1">Contado</option>
                            <option value="2">Credito</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-5" style="padding-left: 0px;padding-right:0px;">
                <div id="celda_credito" style="float:left;display: none;" >
                    <div class="form-group"  style="float:left;margin: 5px 0px 5px 0px;">
                        <label class="col-md-4 control-label" style="width: 70px;"> Cuotas:</label>
                        <input name="cuotas" id="cuotas" class="form-control"  placeholder="Cuotas" onkeypress="return soloNumeros(event)"
                                style="width: 70px"  maxlength="2"  >
                    </div>
                    <div class="form-group"  style="float:left;margin: 5px 0px 5px 30px;">
                        <label class="col-md-4 control-label" style="width: 70px;margin-right: 10px;padding-top: 0px;"> Intervalo Dias:</label>
                        <input name="intervalo" id="intervalo" class="form-control"  placeholder="Intervalo" onkeypress="return soloNumeros(event)"
                                style="width: 90px"  maxlength="3"  >
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin: 0px 0px 0px 0px;" >
            <div class="col-md-6">
                <div class="form-group" style="margin: 5px 0px 5px 0px;" >
                    <label class="col-md-4 control-label" style="width: 90px;"> Vender:</label>
                    <div class="col-md-7">
                        <select id="sel_venta" name="sel_venta" class="form-control">
                            <option value="0"></option>
                            <option value="1">Servicio</option>
                            <option value="2">Producto</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6 ">
                <div class="form-group" style="margin: 5px auto 5px auto">
                    <label class="col-md-7 control-label" > Fecha:</label>
                    <div class="col-md-5">
                        <input name="fechaventa" id="fechaventa" class="form-control"  placeholder="Fecha" readonly="readonly" value="<?php echo date('Y-m-d') ?>">
                    </div>
                </div>
            </div>
        </div>
        
        <div id="celda_producto" style="display:none;margin: 0px 0px 0px 0px;border-bottom: solid 1px #D8D8D8;" >
            <div class="row"  style="margin: 0px 0px 0px 0px;">
                <div class="col-md-4 " style="padding-right: 0px;">
                    <div class="form-group" style="margin: 5px 0px 0px auto" style="padding-right: 0px;">
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
            </div>
            <div class="row"  style="margin: 0px 0px 0px 0px;">    
                <div class="col-md-6">
                    <div class="form-group" style="margin: 5px auto 5px auto">
                        <label class=" col-md-4 control-label" >Producto:</label>
                        <div class="col-md-8">
                            <input type="hidden" name="id_producto" id="id_producto"/>
                            <input type="hidden" name="id_almacen" id="id_almacen"/>
                            <input type="hidden" name="almacen" id="almacen"/>
                            <input type="hidden" name="stockactual" id="stockactual"/>
                            <input type="text" name="producto" id="producto" readonly="readonly" placeholder="Seleccione Producto" class="form-control" data-toggle="modal" data-target="#modalProducto"  style="width: 170px"/>
                            <button type="button" data-toggle="modal" data-target="#modalProducto" class="btn btn-primary btn-sm" title="Buscar Producto" id="AbrirVtnBuscarProducto"><i class="icon-search icon-white"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="margin: 3px auto 5px auto">
                    <input type="text" name="cantidad" id="cantidad" placeholder="Cantidad" class="form-control" onkeypress="return soloNumeros(event)" maxlength="3" style="width: 110px" />
                    <input type="text" name="precio" id="precio" placeholder="Precio" class="form-control" onkeypress="return dosDecimales(event,this)" style="width: 110px" />  
                    <input type="text" name="importe" id="importe" placeholder="Importe" class="form-control" readonly="readonly" style="width: 110px" />
                    <button type="button" class="btn btn-primary btn-sm" title="Agregar al Detalle" id="addDetalleProducto"><i class="icon-hand-down icon-white"></i></button>
                </div> 
            </div> 
        </div>
        
        <div class="row" id="celda_matricula" style="display:none;margin: 0px 0px 0px 0px;border-bottom: solid 1px #D8D8D8;" >
            <div class="row"  style="margin: 0px 0px 0px 0px;">
                <div class="col-md-6">
                    <div class="form-group" style="margin: 5px auto 5px auto">
                        <label class=" col-md-4 control-label" >Membresia:</label>
                        <div class="col-md-8">
                            <input type="text" name="membresia" id="membresia" readonly="readonly" placeholder="Seleccione Membresia" class="form-control" data-toggle="modal" data-target="#modalMembresia"  style="width: 170px"/>
                            <button type="button" data-toggle="modal" data-target="#modalMembresia" class="btn btn-primary btn-sm" title="Buscar Membresia" id="AbrirVtnBuscarMembresia"><i class="icon-search icon-white"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" style="margin: 5px auto 5px auto">
                        <label class=" col-md-4 control-label" >Cliente:</label>
                        <div class="col-md-8">
                            <input type="text" name="membresia" id="membresia" readonly="readonly" placeholder="Seleccione Membresia" class="form-control" data-toggle="modal" data-target="#modalMembresia"  style="width: 170px"/>
                            <button type="button" data-toggle="modal" data-target="#modalMembresia" class="btn btn-primary btn-sm" title="Buscar Membresia" id="AbrirVtnBuscarMembresia"><i class="icon-search icon-white"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row"  style="margin: 0px 0px 0px 0px;">
                
                <div class="col-md-6">
                    <div class="form-group" style="margin: 5px auto 5px auto">
                        <label class=" col-md-4 control-label" >Fecha Inicio:</label>
                        <div class="col-md-8">
                            <input type="text" name="membresia" id="membresia"  placeholder="Seleccione Membresia" class="form-control" data-toggle="modal" data-target="#modalMembresia"  style="width: 170px"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12" style="margin: 5px auto;">
                <ul class="nav nav-tabs">
                  <li ><a data-toggle="tab" href="#tabServicios">Servicios</a></li>
                  <li class="active"><a data-toggle="tab" href="#tabProductos">Productos</a></li>
                </ul>

                <div class="tab-content" style="padding: 10px 10px 10px 10px;" >
                    <div id="tabServicios" class="tab-pane fade " >
                        <table class="table table-striped table-bordered table-hover table-condensed" id="tblDetalleMembresias">
                            <th>Servicio</th>
                            <th>Unid. Med.</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Importe (S/.)</th>
                            <th>Acciones</th>   
                        </table>
                    </div>
                    <div id="tabProductos" class="tab-pane fade in active">
                        <table class="table table-striped table-bordered table-hover table-condensed" id="tblDetalleProductos">
                            <th>Producto</th>
                            <th>Almacen</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Importe (S/.)</th>
                            <th>Acciones</th>   
                        </table>
                    </div>
                </div>
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
                    <button type="button" class="btn btn-primary" id="save">Guardar</button>
                    <a href="<?php echo BASE_URL ?>venta" class="btn btn-info">Cancelar</a>
                </p>
            </div>
        </div>
    </form>
    
    
    <!-- Modal -->
    <style>
        #modalSocio .modal-content,#modalProducto .modal-content,#modalNuevoCliente .modal-content{
            width: 800px;
            left: -18%;
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
                    <p>
                        <select class="list" id="filtroServicio">
                            <option value="0">Descripcion</option>
                            <option value="1">Tipo Servicio</option>
                        </select>
                        <input type="text" class="input-xlarge" id="buscarServicio">
                        <button type="button" class="btn btn-primary" id="btn_buscarServicio"><i class="icon-search icon-white"></i></button>
                    </p>
                    <div id="grillaServicio">
                        <div class="page-header">
                            <img src="<?php echo BASE_URL ?>lib/img/loading.gif" />
                        </div>
                    </div>
                    <div id="controls">
                        <div id="perpage">
                            <select onchange="sorter.size(this.value)">
                                <option value="5">5</option>
                                <option value="10" selected="selected">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <span>Entradas por Página</span>
                        </div>
                        <div id="navigation">
                            <img src="<?php echo BASE_URL ?>lib/img/first.gif" width="16" height="16" alt="Primera Página" onclick="sorter.move(-1,true)" />
                            <img src="<?php echo BASE_URL ?>lib/img/previous.gif" width="16" height="16" alt="Página Anterior" onclick="sorter.move(-1)" />
                            <img src="<?php echo BASE_URL ?>lib/img/next.gif" width="16" height="16" alt="Página Siguiente" onclick="sorter.move(1)" />
                            <img src="<?php echo BASE_URL ?>lib/img/last.gif" width="16" height="16" alt="Última Página" onclick="sorter.move(1,true)" />
                        </div>
                        <div id="text">Página <span id="currentpage"></span> de <span id="pagelimit"></span></div>
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
    
