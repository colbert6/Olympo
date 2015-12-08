<script src="<?php echo $_params['ruta_js']; ?>bootbox.min.js"></script>
<div class="navbar-inner">
<?php if (isset($this->datos) && count($this->datos)) { ?>
<div class="navbar-inner text-center">
   
    <table name="table" id="table3" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>ITEM</th>
            <th>FECHA</th>
            <th>TIPO MOVIMIENTO</th>
            <th>CONCEPTO MOVIMIENTO</th>
            <th>DESCRIPCION</th>
            <th>MONTO(S/.)</th>
            <th>ACCIONES</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($this->datos); $i++) { ?>
            <tr>
                <td><?php echo $i+1 ?></td>
                <td><?php 
                    $date = new DateTime($this->datos[$i]['FECHA']);
                    echo $date->format('d-m-Y');
                ?></td>
                <td><?php echo $this->datos[$i]['TIPO_MOVIMIENTO'] ?></td>
                <td><?php echo $this->datos[$i]['CONCEPTO_MOVIMIENTO'] ?></td>
                <td><?php echo $this->datos[$i]['DESCRIPCION'] ?></td>
                <td><?php echo $this->datos[$i]['MONTO'] ?></td>
                <td>
                    <a href="javascript:void(0)" onclick="bootbox.alert('ID : <?php echo " ".$this->datos[$i]['ID_MOVIMIENTO'];?>')" class="btn btn-success btn-minier"><i class="icon-key icon-white"></i></a>
                    <a href="javascript:void(0)" onclick="ValidaExtorno('<?php echo $this->datos[$i]['ID_MOVIMIENTO'] ?>')" class="btn btn-danger btn-minier"><i class="icon-repeat icon-white"></i></a>
                </td>

            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<div class="navbar-inner">
    <a href="<?php echo BASE_URL?>movimiento/nuevo" class="btn btn-warning">Compras y Ventas</a>
    <a href="<?php echo BASE_URL?>movimiento/otros_movimientos" class="btn btn-success">Otros Movimientos</a>
</div>
    <?php } else { ?>
<div class="navbar-inner">
        <p>NO SE ENCONTRARON DATOS</p>
    <a href="<?php echo BASE_URL?>movimiento/nuevo" class="btn btn-warning">Compras y Ventas</a>
    <a href="<?php echo BASE_URL?>movimiento/otros_movimientos" class="btn btn-success">Otros Movimientos</a>
</div>
    <?php } ?>

    <style>
        #validaAdministrador .modal-content {
            width: 300px;
            margin: 0 auto;
        }
    </style>
    <div id="validaAdministrador" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Extornar Movimiento</h3>
            <small>Usuario y Contraseña de Administrador</small>
        </div>
        <div class="modal-body">

                    <input readonly  type='hidden' name="id_movimiento" id="id_movimiento" >
                    <div id='alerta'>
                    </div>
                    <div class="form-group">
                      <input name="user" id="user" class="form-control" type='text' autofocus placeholder="Usuario" value="">
                    </div> 
                    <div class="form-group">
                      <input  name="pass" id="pass" class="form-control"  type='password' placeholder="Contraseña" value="">
                    </div> 
        </div>
        <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cerrar</button>
            <button class="btn btn-success" data-dismiss="modal" id='extornar' aria-hidden="true">Extornar</button>
        </div>
        </div>
        </div>
    </div>