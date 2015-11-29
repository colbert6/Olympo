<div class="navbar-inner">
<?php    $hoy=  date("Y")."-".date("m")."-".date("d");?>
<?php if (isset($this->datos) && count($this->datos)) { ?>
<div class="navbar-inner text-center">
    
    <table id="table" class="display">
        <thead>

        <tr>
            <th>ITEM</th>
            <th>NOMBRE</th>
            <th>CORREO</th>
            <th>ESTADO</th>
         <!--   <th>FECHA </th>-->
            <th>ACCIONES</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($this->datos); $i++) { ?>
            <tr>
                <td><?php echo $i+1 ?></td>
                <td><?php echo $this->datos[$i]['NOMBRE'] ?></td>
                <td><?php echo $this->datos[$i]['CORREO'] ?></td>
                <td><?php 
                            if($this->datos[$i]['ESTADO'] == 0) {  ?>
                                <a ><i class="icon-comment icon-black"></i></a>
                    <?php   } else{   ?>
                                <a ><i class="icon-check icon-black"></i></a>
                  <?php     } ?>
                </td>
                
                <td>
                    <a href="#myModal" role="button" data-toggle="modal" title=" VER IMAGEN" onclick="ver('<?php echo $this->datos[$i]['ID_CONTACTO'] ?>')" class="btn btn-warning btn-minier"><i class="icon-eye-open icon-white"></i></a>
                    <a href="javascript:void(0)" title=" ELIMINAR" onclick="eliminar('<?php echo BASE_URL?>contacto/eliminar/<?php echo $this->datos[$i]['ID_CONTACTO'] ?>')" class="btn btn-danger btn-minier"><i class="icon-remove icon-white"></i></a>
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
    
    <!-- Modal -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 style='font-size: 2em' id="myModalLabel"></h3>
        </div>
        <div class="modal-body text-justify">
            <div id="bodymodal">
                <div class="text-center">
                    <img src="<?php echo BASE_URL ?>lib/img/loading.gif" />
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button id="ok" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Ok</button>
        </div>
        </div>
        </div>
    </div>