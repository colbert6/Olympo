
<?php if (isset($this->datos) && count($this->datos)) { ?>
    
    <table id="table" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ITEM</th>
                <th>RAZON SOCIAL</th>
                <th>RUC</th>
                <th>TELEFONO</th>
                <th>EMAIL</th>
                <th>DIRECCION</th>
                <th>UBIGEO</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
         <tbody>
            <?php for ($i = 0; $i < count($this->datos); $i++) { ?>
            <tr>
                <td><?php echo ($i+1);//id ?></td>
                <td><?php echo $this->datos[$i]['RAZON_SOCIAL'];//nombre ?></td> 
                <td><?php echo $this->datos[$i]['RUC'];//nombre ?></td> 
                <td><?php echo $this->datos[$i]['TELEFONO'];//nombre ?></td>
                <td><?php echo $this->datos[$i]['EMAIL'];//nombre ?></td> 
                <td><?php echo $this->datos[$i]['DIRECCION'];//nombre ?></td> 
                <td><?php echo $this->datos[$i]['DESCRIPCION'];//nombre ?></td>
                <td>
                    <a href="javascript:void(0)" onclick="editar('<?php echo BASE_URL?>proveedor/editar/<?php echo $this->datos[$i]['ID_PROVEEDOR'] ?>')" class="btn btn-success btn-minier"><i class="icon-pencil icon-white"></i></a>
                    <a href="javascript:void(0)" onclick="eliminar('<?php echo BASE_URL?>proveedor/eliminar/<?php echo $this->datos[$i]['ID_PROVEEDOR'] ?>')" class="btn btn-danger btn-minier"><i class="icon-remove icon-white"></i></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>  
    <div class="btn-group">
        <a class="btn btn-primary" href="proveedor/nuevo" class="k-button">Nuevo</a>
    </div>      
    <?php } else { ?>
    <p>NO SE ENCONTRARON DATOS</p>
        <a class="btn btn-primary" href="<?php echo BASE_URL?>proveedor/nuevo" class="k-button">Nuevo</a>
    <?php } ?>
        
