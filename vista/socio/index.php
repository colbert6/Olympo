
<?php if (isset($this->datos) && count($this->datos)) { ?>
    
    <table id="table" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRES</th>
                <th>APELLIDO PATERNO</th>
                <th>APELLIDO MATERNO</th>
                <th>ALIAS</th>
                <th>DNI</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
         <tbody>
            <?php for ($i = 0; $i < count($this->datos); $i++) { ?>
            <tr>
                <td><?php echo ($i+1);//id ?></td>
                <td><?php echo $this->datos[$i]['NOMBRE']//nombre ?></td>    
                <td><?php echo $this->datos[$i]['APELLIDO_PATERNO'];?></td>
                <td><?php echo $this->datos[$i]['APELLIDO_MATERNO']//orden ?></td>
                <td><?php echo $this->datos[$i]['ALIASS']//orden ?></td>
                <td><?php echo $this->datos[$i]['DNI']//orden ?></td>
                
                <td>
                    <a href="javascript:void(0)" onclick="editar('<?php echo BASE_URL?>socio/vermas/<?php echo $this->datos[$i]['ID_SOCIO'] ?>')" class="btn btn-warning btn-minier"><i class="icon-eye-open icon-white"></i></a>
                    <a href="javascript:void(0)" onclick="editar('<?php echo BASE_URL?>socio/editar/<?php echo $this->datos[$i]['ID_SOCIO'] ?>')" class="btn btn-success btn-minier"><i class="icon-pencil icon-white"></i></a>
                    <a href="javascript:void(0)" onclick="eliminar('<?php echo BASE_URL?>socio/eliminar/<?php echo $this->datos[$i]['ID_SOCIO'] ?>')" class="btn btn-danger btn-minier"><i class="icon-remove icon-white"></i></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>  
    <div class="btn-group">
        <a class="btn btn-primary" href="socio/nuevo" class="k-button">Nuevo</a>
    </div>      
    <?php } else { ?>
    <p>NO SE ENCONTRARON DATOS</p>
        <a class="btn btn-primary" href="<?php echo BASE_URL?>socio/nuevo" class="k-button">Nuevo</a>
    <?php } ?>