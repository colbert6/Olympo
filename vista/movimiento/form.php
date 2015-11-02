<link href="<?php echo $_params['ruta_css']; ?>jquery-ui.custom.css" rel="stylesheet" />
<script src="<?php echo $_params['ruta_js']; ?>bootbox.min.js"></script>
<?php $hoy=  date("Y")."-".date("m")."-".date("d");?>
<div class="navbar-inner">
   
    <form method="post" action="<?php if (isset($this->action)) echo $this->action ?>" id="frm" class="form-horizontal" >
        <input type="hidden" name="guardar" id="guardar" value="1"/>
         
         <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
            <div class="col-md-4 ">
                <div class="form-group">
                    <label class="col-md-3 control-label" > Fecha:</label>
                    <div class="col-md-8">
                        <input name="fecha" id="fecha" class="form-control"  readonly="readonly" value='<?php echo $hoy; ?>'>
                    </div>
                </div>
            </div>
        </div>
        
        

        <div class="row">
            <div class="col-md-4">
                    <strong>ACTOR:</strong>
                    <input type="hidden" name="id_actor" id="id_actor"/>
                    <input type="hidden" name="tipo_actor" id="tipo_actor"/>
                    <input type="hidden" name="nro_doc" id="nro_doc"/>
                    <input type="text" name="razon_social" id="razon_social" readonly="readonly" placeholder="  " class="form-control" style="width: 170px"/>
                    <button type="button" data-toggle="modal" data-target="#modalActor" class="btn btn-primary btn-sm" title="Buscar Actor" id="buscarActor"><i class="icon-search icon-white"></i></button>
            </div>
            <div class="col-md-4" >
                <strong>TIPO MOVIMIENTO:</strong>
                <!--select id="id_tipo_movimiento" name="id_tipo_movimiento" class="input-medium" >
                        <option value="0">Seleccione...</option>
                        
                </select-->
                <input type="text"  name="tipo_movimiento" id="tipo_movimiento" readonly="readonly" placeholder="  " class="form-control" style="width: 140px"/>
            </div> 

            <div class="col-md-4">
                <strong> MONTO:</strong>
                <input type="text" name="importe" id="importe" placeholder="Importe" class="form-control"  style="width: 125px" />
                <button type="button" class="btn btn-primary btn-sm"  id="amortizar">Amortizar</button>
            </div> 
        </div>
        <br>
        <div id='acciones'>
            <legend>Lista de Ventas</legend>
        </div>
        <div id='cronograma'>
            <!--legend>Cronograma de Pago</legend-->
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
    
</div>

<style>
        #modalActor .modal-content {
            width: 800px;
            left: -18%;
        }
    </style>


<div id="modalActor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Lista de Clientes y/o Proveedores</h3>
        </div>
        <div class="modal-body">
            <form id="form-Actor">
                <div class="navbar-inner text-center">

                    <div id="grillaActor">
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