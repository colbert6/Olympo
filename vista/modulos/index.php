
<?php if (isset($this->datos) && count($this->datos)) { ?>
<div class="navbar-inner text-center">
   
    <table id="table" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Item</th>
            <th>Nombre</th>
            <th>Icono</th>
            <th>Url</th>
            <th>Modulo Padre</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($this->datos); $i++) { ?>
            <tr>
                <td><?php echo $i+1 ?></td>
                <td><?php echo $this->datos[$i]['NOMBRE'] ?></td>
                <td><?php echo $this->datos[$i]['ICONO'] ?></td>
                <td><?php echo $this->datos[$i]['URL'] ?></td>
                <td><?php echo $this->datos[$i]['MODULO_PADRE'] ?></td>
                <td>
                    <a href="javascript:void(0)" onclick="editar('<?php echo BASE_URL?>modulos/editar/<?php echo $this->datos[$i]['ID_MODULO'] ?>')" class="btn btn-success btn-minier"><i class="icon-pencil icon-white"></i></a>
                    <a href="javascript:void(0)" onclick="eliminar('<?php echo BASE_URL?>modulos/eliminar/<?php echo $this->datos[$i]['ID_MODULO'] ?>')" class="btn btn-danger btn-minier"><i class="icon-remove icon-white"></i></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<div class="navbar-inner">
    <a href="<?php echo BASE_URL?>modulos/nuevo" class="btn btn-primary">Nuevo</a>
</div>
    <?php } else { ?>
<div class="navbar-inner">
        <p>No hay modulos</p>
<a href="<?php echo BASE_URL?>modulos/nuevo" class="btn btn-primary">Nuevo</a>
</div>
    <?php } ?>