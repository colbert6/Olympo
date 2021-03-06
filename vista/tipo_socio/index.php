<div class="navbar-inner">
<?php if (isset($this->datos) && count($this->datos)) { ?>
<div class="navbar-inner text-center">
   
    <table name="table" id="table" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>DESCRIPCION</th>
            <th>ACCIONES</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($this->datos); $i++) { ?>
            <tr>
                <td><?php echo $i+1 ?></td>
                <td><?php echo $this->datos[$i]['DESCRIPCION'] ?></td>
                <td>
                    <a href="javascript:void(0)" onclick="editar('<?php echo BASE_URL?>tipo_socio/editar/<?php echo $this->datos[$i]['ID_TIPO_SOCIO'] ?>')" class="btn btn-success btn-minier"><i class="icon-pencil icon-white"></i></a>
                    <a href="javascript:void(0)" onclick="eliminar('<?php echo BASE_URL?>tipo_socio/eliminar/<?php echo $this->datos[$i]['ID_TIPO_SOCIO'] ?>')" class="btn btn-danger btn-minier"><i class="icon-remove icon-white"></i></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<div class="navbar-inner">
    <a href="<?php echo BASE_URL?>tipo_socio/nuevo" class="btn btn-primary">Nuevo</a>
</div>
    <?php } else { ?>
<div class="navbar-inner">
        <p>NO SE ENCONTRARON DATOS</p>
<a href="<?php echo BASE_URL?>tipo_socio/nuevo" class="btn btn-primary">Nuevo</a>
</div>
    <?php } ?>