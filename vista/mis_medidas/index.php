<div class="navbar-inner">
<?php if (isset($this->datos) && count($this->datos)) { ?>
<div class="navbar-inner text-center">
   
    <table name="table" id="table" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th class='text-center'>ID</th>
            <th class='text-center'>FECHA DEL TRIAJE</th>
            <th class='text-center'>ACCIONES</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($this->datos); $i++) { ?>
            <tr>
                <td><?php echo $i+1 ?></td>
                <td><?php echo $this->datos[$i]['FECHA'] ?></td>
                <td>
                    <a href="#myModal" role="button" data-toggle="modal" onclick="ver('<?php echo $this->datos[$i]['ID_SOCIO'] ?>','<?php echo $this->datos[$i]['FECHA'] ?>')" class="btn btn-warning btn-minier"><i class="icon-eye-open icon-white"></i></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

    <?php } else { ?>
<div class="navbar-inner">
        <p>NO SE ENCONTRARON DATOS</p>

</div>
    <?php } ?>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="titulo">MEDIDAS ANTROPOMORFICAS</h3>
        </div>
        <div class="modal-body text-justify">
            <div id="cuerpo_modal">
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Cerrar</button>
        </div>
        </div>
        </div>
    </div>