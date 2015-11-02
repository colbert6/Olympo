<div class="navbar-inner">
<?php if (isset($this->datos) && count($this->datos)) { ?>
<div class="navbar-inner text-center">
   
    <table name="table" id="table" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
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
                
                <td><?php 
                    $date = new DateTime($this->datos[$i]['FECHA']);
                    echo $date->format('d-m-Y');
                ?></td>
                <td><?php echo $this->datos[$i]['TIPO_MOVIMIENTO'] ?></td>
                <td><?php echo $this->datos[$i]['CONCEPTO_MOVIMIENTO'] ?></td>
                <td><?php echo $this->datos[$i]['DESCRIPCION'] ?></td>
                <td><?php echo $this->datos[$i]['MONTO'] ?></td>
                <td>
                    <a href="javascript:void(0)" onclick="editar('<?php echo BASE_URL?>concepto_triaje/editar/<?php echo $this->datos[$i]['ID_CONCEPTO_TRIAJE'] ?>')" class="btn btn-success btn-minier"><i class="icon-eye-open icon-white"></i></a>
                    <a href="javascript:void(0)" onclick="eliminar('<?php echo BASE_URL?>concepto_triaje/eliminar/<?php echo $this->datos[$i]['ID_CONCEPTO_TRIAJE'] ?>')" class="btn btn-danger btn-minier"><i class="icon-repeat icon-white"></i></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<div class="navbar-inner">
    <a href="<?php echo BASE_URL?>movimiento/nuevo" class="btn btn-primary">Nuevo</a>
</div>
    <?php } else { ?>
<div class="navbar-inner">
        <p>NO SE ENCONTRARON DATOS</p>
<a href="<?php echo BASE_URL?>movimiento/nuevo" class="btn btn-primary">Nuevo</a>
</div>
    <?php } ?>