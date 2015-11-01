<link href="<?php echo $_params['ruta_css']; ?>jquery-ui.custom.css" rel="stylesheet" />
<script src="<?php echo $_params['ruta_js']; ?>bootbox.min.js"></script>
<div class="navbar-inner">
   
    <form method="post" action="<?php if (isset($this->action)) echo $this->action ?>" id="frm" class="form-horizontal" >
        <input type="hidden" name="guardar" id="guardar" value="1"/>
        <input type="hidden" readonly="readonly" name="codigo" id="codigo"
               value="<?php if (isset($this->datos[0]['ID_COMPRA'])) echo $this->datos[0]['ID_COMPRA'] ?>"/>
            
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-4 control-label" > Nro. Doc.:</label>
                    <div class="col-md-6">
                        <input name="nrodoc" id="nrodoc" class="form-control"  onkeypress="return serieComprobante(event)" 
                               placeholder="Numero Documento" autofocus maxlength="20"  >
                    </div>
                </div>
            </div>
            <div class="col-md-6 ">
                <div class="form-group">
                    <label class="col-md-7 control-label" > Fecha:</label>
                    <div class="col-md-5">
                        <input name="fechacompra" id="fechacompra" class="form-control"  placeholder="Fecha" readonly="readonly" >
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 ">
                <div class="form-group">
                <label class="col-md-4 control-label" >Proveedor:</label>
                    <div >
                        <input type="hidden" name="id_proveedor" id="id_proveedor"/>
                        <input type="text" name="proveedor" id="proveedor" readonly="readonly" placeholder="Proveedor" data-toggle="modal" data-target="#modalProveedor" class="form-control"  style="width: 50%;margin-left: 13px;" />
                        <button data-toggle="modal" data-target="#modalProveedor" type="button" class="btn btn-primary btn-sm" title="Buscar Proveedor" id="AbrirVtnBuscarProveedor"><i class="icon-search icon-white"></i></button>
                        <button style="margin-right: 10px" data-toggle="modal" data-target="#modalNuevoProveedor" type="button" class="btn btn-primary btn-sm" title="Insertar Proveedor"><i class="icon-plus icon-white"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ">
                <div class="form-group">
                <label class="col-md-2 control-label" >Ruc:</label>
                    <div class="col-md-8 ">
                    <input type="text" name="ruc_prov" id="ruc_prov" readonly="readonly" placeholder="Ruc"  class="form-control"/>
                    </div>
                </div>
            </div>
            
            
        </div>
        
        <div class="row" style=" background: ">
            <div class="col-md-6 ">
                <div class="form-group">
                    <label class="col-md-5 control-label" >Destino:</label>
                    <div class="col-md-7">
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
            <div class="col-md-3 ">
                <div class="form-group">
                <label class="col-md-7 control-label" >Tipo Pago:</label>
                    <div class="col-md-5">
                    <select id="id_tipopago" name="id_tipopago" class="input-medium">
                        <option value="0"></option>
                        <option value="1">Contado</option>
                        <option value="2">Credito</option>
                    </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="celda_credito" style="display:none ">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="col-md-4 control-label" > Cuotas:</label>
                    <div class="col-md-8">
                        <input name="cuotas" id="cuotas" class="form-control"  placeholder="Cuotas" onkeypress="return soloNumeros(event)"
                               maxlength="2"  >
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="col-md-4 control-label" >Intervalo:</label>
                    <div class="col-md-8">
                        <input name="intervalo" id="intervalo" class="form-control"  placeholder="Intervalo" onkeypress="return soloNumeros(event)"
                               maxlength="3"  >
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label class=" col-md-4 control-label" >Producto:</label>
                    <div class="col-md-8">
            <input type="hidden" name="id_producto" id="id_producto"/>
            <input type="hidden" name="id_almacen" id="id_almacen"/>
            <input type="hidden" name="almacen" id="almacen"/>
            <input type="hidden" name="stockactual" id="stockactual"/>
            <input type="text" name="producto" id="producto" readonly="readonly" placeholder="Seleccione Producto" class="form-control" data-toggle="modal" data-target="#modalInsumo"  style="width: 170px"/>
            <button type="button" data-toggle="modal" data-target="#modalInsumo" class="btn btn-primary btn-sm" title="Buscar Insumo" id="AbrirVtnBuscarInsumo"><i class="icon-search icon-white"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
            <input type="text" name="cantidad" id="cantidad" placeholder="Cantidad" class="form-control" onkeypress="return soloNumeros(event)" maxlength="3" style="width: 110px" />
            <input type="text" name="precio" id="precio" placeholder="PUxUM" class="form-control" onkeypress="return dosDecimales(event,this)" style="width: 110px" />  
            <input type="text" name="importe" id="importe" placeholder="Importe" class="form-control" readonly="readonly" style="width: 110px" />
            <button type="button" class="btn btn-primary btn-sm" title="Agregar al Detalle" id="addDetalle"><i class="icon-hand-down icon-white"></i></button>
            </div> 
        </div>
        <div class="row">
            <div class="col-md-12" >
                <table class="table table-bordered" id="tblDetalle" style="margin-right: 10px;margin-top: 10px;">
                    <th>Producto</th>
                    <th>Almacen</th>
                    <th>Cantidad</th>
                    <th>PU (S/.)</th>
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
                    <button type="button" class="btn btn-primary" id="save">Guardar</button>
                    <a href="<?php echo BASE_URL ?>compra" class="btn btn-danger">Cancelar</a>
                </p>
            </div>
        </div>
    </form>
    <div id="modalInsumo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Lista de Productos</h3><h3 id="title_almacen"></h3>
        </div>
        <div class="modal-body">
            <form id="VtnBuscarInsumo">
                <div class="navbar-inner text-center">
                    <div id="grillaInsumo">
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
    <!-- Modal -->
    <style>
        #modalProveedor .modal-content,#modalInsumo .modal-content {
            width: 800px;
            left: -18%;
        }
    </style>
    <div id="modalProveedor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Lista de Proveedores</h3>
        </div>
        <div class="modal-body">
            <form id="VtnBuscarProveedor">
                <div class="navbar-inner text-center">
                    
                    <div id="grillaProveedor">
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
    
    <div id="modalNuevoProveedor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Registrar Proveedor</h3>
        </div>
        <div class="modal-body">
            <form method="post" action="" id="frm">
                <input type="hidden" name="guardar" id="guardar" value="1"/>
                <table align="center" cellpadding="5">
                    <tr>
                        <td><label>Razon Social:</label></td>
                        <td><input type="text" name="razonsocialprov" id="razonsocialprov" /></td>
                    </tr>
                    <tr>
                        <td><label>Representante:</label></td>
                        <td><input type="text" name="nombreprov" id="nombreprov" onkeypress="return soloLetras(event)" /></td>
                    </tr>
                    <tr>
                        <td><label>RUC:</label></td>
                        <td><input type="text" name="rucprov" id="rucprov" maxlength="11" onkeypress="return soloNumeros(event)"/></td>
                    </tr>
                    <tr>
                        <td><label>Direccion:</label></td>
                        <td><input type="text" name="direccionprov" id="direccionprov" /></td>
                    </tr>
                    <tr>
                        <td><label>Telefono:</label></td>
                        <td><input type="text" name="telefmovilprov" id="telefmovilprov" onkeypress="return numeroTelefonico(event)"/></td>
                    </tr>
                    <tr>
                        <td><label>Email:</label></td>
                        <td><input type="email" name="emailprov" id="emailprov" /></td>
                    </tr>
                    <tr>
                        <td><label>Ciudad:</label></td>
                        <td><input type="text" name="ciudadprov" id="ciudadprov" /></td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="reg_proveedor">Registrar Proveedor</button>
            <button class="btn btn-info" data-dismiss="modal" aria-hidden="true">Cancelar</button>
        </div>
        </div>
        </div>
    </div>
    