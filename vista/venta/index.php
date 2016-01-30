<div class="navbar-inner">
<?php if (isset($this->datos) && count($this->datos)) { ?>
    
    <table id="table" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ITEM</th>
                <th>FECHA</th>
                <th>CLIENTE</th>
                <th>COMPROBANTE</th>
                <th>NRO. DOC.</th>
                <th>TIPO PAGO</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < count($this->datos); $i++) { ?>
                <tr>
                    <?php //$total= round($this->datos[$i]['MONTO']*(1+$this->datos[$i]['IGV']), 2); ?>
                    <td><?php echo ($i+1) ?></td>
                    <td><?php echo $this->datos[$i]['FECHA'] ?></td>
                    <td><?php echo $this->datos[$i]['SOCIO'] ?></td>
                    <td><?php echo $this->datos[$i]['COMPROBANTE'] ?></td>
                    <td><?php echo $this->datos[$i]['NUM_DOCUMENTO'] ?></td>
                    <td><?php echo $this->datos[$i]['MODALIDAD_TRANSACCION'] ?></td>
                    <td>
                        <a href="#myModal" role="button" data-toggle="modal" onclick="ver('<?php echo $this->datos[$i]['ID_VENTA']; ?>')" class="btn btn-warning btn-minier"><i class="icon-eye-open icon-white"></i></a>
                        <?php if($this->datos[$i]['ESTADO_PAGO'] == 0) {  ?>
                        <a href="javascript:void(0)" onclick="eliminar('<?php echo BASE_URL ?>venta/eliminar/<?php echo $this->datos[$i]['ID_VENTA'] ?>')" class="btn btn-danger btn-minier"><i class="icon-remove icon-white"></i></a>
                        <?php } ?>
                        
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="btn-group">
        <a class="btn btn-primary" href="venta/nuevo" class="k-button">Nuevo</a>
    </div>

<?php } else { ?>
    
        <br/>
        <p>No hay Ventas</p>
        <a href="<?php echo BASE_URL ?>venta/nuevo" class="btn btn-primary">Nuevo</a>
    <?php } ?>
<!-- Modal -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel"></h3>
        </div>
        <div class="modal-body text-justify">
            <div id="bodymodal">
                <div class="text-center">
                    <img src="<?php echo BASE_URL ?>lib/img/loading.gif" />
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Ok</button>
        </div>
        </div>
        </div>
    </div>
