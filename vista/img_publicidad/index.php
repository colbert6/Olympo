<div class="navbar-inner">
<?php if (isset($this->datos) && count($this->datos)) { ?>
<div class="navbar-inner text-center">
    
    <table id="table" class="display">
        <thead>
        <tr>
            <th>ITEM</th>
            <th>NOMBRE</th>
            <th>ESTADO</th>
            <th>ACCIONES</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($this->datos); $i++) { ?>
            <tr>
                <td><?php echo $i+1 ?></td>
                <td><?php echo $this->datos[$i]['NOMBRE'] ?></td>
                <td><?php if($this->datos[$i]['ESTADO']=='1'){
                    echo 'Activo';
                } else{
                    echo 'Inactivo';
                } ?></td>
                <td>
                    <a href="#myModal" role="button" data-toggle="modal" title=" VER IMAGEN" onclick="ver('<?php echo $this->datos[$i]['ID_IMG_PUBLICIDAD'] ?>')" class="btn btn-warning btn-minier"><i class="icon-eye-open icon-white"></i></a>
                    <a href="javascript:void(0)" title=" EDITAR" onclick="editar('<?php echo BASE_URL?>img_publicidad/editar/<?php echo $this->datos[$i]['ID_IMG_PUBLICIDAD'] ?>')" class="btn btn-success btn-minier"><i class="icon-pencil icon-white"></i></a>
                    <a href="javascript:void(0)" title=" ELIMINAR" onclick="eliminar('<?php echo BASE_URL?>img_publicidad/eliminar/<?php echo $this->datos[$i]['ID_IMG_PUBLICIDAD'] ?>')" class="btn btn-danger btn-minier"><i class="icon-remove icon-white"></i></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    </div>
    
    <div class="navbar-inner">
    <a href="<?php echo BASE_URL?>img_publicidad/nuevo" class="btn btn-primary">Nuevo</a>
    </div>
    <?php } else { ?>
      <div class="navbar-inner">
        <p>NO SE ENCONTRARON DATOS</p>
        <a href="<?php echo BASE_URL?>img_publicidad/nuevo" class="btn btn-primary">Nuevo</a>
      </div>
<?php } ?>
    <style>
        #myModal .modal-content {
            width: 900px;
            left: -18%;
        }
    </style>
    
    <!-- Modal -->
    <div id="myModal"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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