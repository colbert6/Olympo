<?php if (isset($this->datos) && count($this->datos)) { ?>
<div class="navbar-inner text-center"
    <div id="grilla">
    <table id="table" class="display">
        <thead>
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>APELLIDOS</th>
            <th>USUARIO</th>
            <th>PERFIL</th>
            <th>ACCIONES</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($this->datos); $i++) { ?>
            <tr>
                <td><?php echo $i+1 ?></td>
                <td><?php echo $this->datos[$i]['NOMBRE'] ?></td>
                <td><?php echo $this->datos[$i]['APELLIDO_PATERNO']." ".$this->datos[$i]['APELLIDO_MATERNO'] ?></td>
                <td><?php echo $this->datos[$i]['USUARIO'] ?></td>
                <td><?php echo $this->datos[$i]['PERFILUSUARIO'] ?></td>
                <td>
                    <a href="#myModal" role="button" data-toggle="modal" onclick="ver('<?php echo $this->datos[$i]['ID_EMPLEADO'] ?>')" class="btn btn-warning btn-minier"><i class="icon-eye-open icon-white"></i></a>
                    <a href="javascript:void(0)" onclick="editar('<?php echo BASE_URL?>empleado/editar/<?php echo $this->datos[$i]['ID_EMPLEADO'] ?>')" class="btn btn-success btn-minier"><i class="icon-pencil icon-white"></i></a>
                    <a href="javascript:void(0)" onclick="eliminar('<?php echo BASE_URL?>empleado/eliminar/<?php echo $this->datos[$i]['ID_EMPLEADO'] ?>')" class="btn btn-danger btn-minier"><i class="icon-remove icon-white"></i></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="btn-group">
    <a href="<?php echo BASE_URL?>empleado/nuevo" class="btn btn-primary">Nuevo</a>
    </div>
    </div>
    <?php } else { ?>
      <div class="btn-group">
        <p>NO SE ENCONTRARON DATOS</p>
        <a href="<?php echo BASE_URL?>empleado/nuevo" class="btn btn-primary">Nuevo</a>
      </div>
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