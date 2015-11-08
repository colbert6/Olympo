<div class="navbar-inner">
<?php if (isset($this->datos) && count($this->datos)) { ?>   
    <table name="table" id="table" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>ITEM</th>
            <th>DESCRIPCION</th>
            <th>VIGENCIA</th>
            <th>NRO. SERVICIOS</th>
            <th>PRECIO</th>
            <th>ACCIONES</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($this->datos); $i++) { ?>
            <tr>
                <td><?php echo $i+1 ?></td>
                <td><?php echo $this->datos[$i]['DESCRIPCION']; ?></td>
                <td><?php echo $this->datos[$i]['DURACION']." ".$this->datos[$i]['VIGENCIA']; ?></td>
                <td><?php echo $this->datos[$i]['NUMERO_SERVICIOS']; ?></td>
                <td><?php echo $this->datos[$i]['PRECIO']; ?></td>
                <td>
                    <a href="javascript:void(0)" onclick="editar('<?php echo BASE_URL?>membresia/editar/<?php echo $this->datos[$i]['ID_TIPO_MEMBRESIA'] ?>')" class="btn btn-success btn-minier"><i class="icon-pencil icon-white"></i></a>
                    <a href="javascript:void(0)" onclick="eliminar('<?php echo BASE_URL?>membresia/eliminar/<?php echo $this->datos[$i]['ID_TIPO_MEMBRESIA'] ?>')" class="btn btn-danger btn-minier"><i class="icon-remove icon-white"></i></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<div class="navbar-inner">
    <a href="<?php echo BASE_URL?>membresia/nuevo" class="btn btn-primary">Nuevo</a>
</div>
    <?php } else { ?>
<div class="navbar-inner">
        <p>NO SE ENCONTRARON DATOS</p>
<a href="<?php echo BASE_URL?>membresia/nuevo" class="btn btn-primary">Nuevo</a>
</div>
    <?php } ?>