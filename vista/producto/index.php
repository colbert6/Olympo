
<?php if (isset($this->datos) && count($this->datos)) { ?>
    
    <table id="table" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ITEM</th>
                <th>NOMBRE</th>
                <th>MARCA</th>
                <th>CAT PRODUCTO</th>
                <th>PRESENTACION</th>
                <th>PRECIO</th>
                <th>STOCK MIN</th>
                <th>STOCK MAX</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
         <tbody>
            <?php for ($i = 0; $i < count($this->datos); $i++) { ?>
            <tr>
                <td><?php echo ($i+1);//id ?></td>
                <td><?php echo $this->datos[$i]['NOMBRE'];//nombre ?></td>
                <td><?php echo $this->datos[$i]['DESCRIPCION_MAR'];//nombre ?></td>
                <td><?php echo $this->datos[$i]['DESCRIPCION_CAPR'];//nombre ?></td>
                <td><?php echo $this->datos[$i]['PRESENTACION'];//nombre ?></td>
                <td><?php echo $this->datos[$i]['PRECIO'];//nombre ?></td>
                <td><?php echo $this->datos[$i]['STOCK_MIN'];//nombre ?></td>
                <td><?php echo $this->datos[$i]['STOCK_MAX'];//nombre ?></td>
                <td>
                    <a href="javascript:void(0)" onclick="editar('<?php echo BASE_URL?>producto/editar/<?php echo $this->datos[$i]['ID_PRODUCTO'] ?>')" class="btn btn-success btn-minier"><i class="icon-pencil icon-white"></i></a>
                    <a href="javascript:void(0)" onclick="eliminar('<?php echo BASE_URL?>producto/eliminar/<?php echo $this->datos[$i]['ID_PRODUCTO'] ?>')" class="btn btn-danger btn-minier"><i class="icon-remove icon-white"></i></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>  
    <div class="btn-group">
        <a class="btn btn-primary" href="producto/nuevo" class="k-button">Nuevo</a>
    </div>      
    <?php } else { ?>
    <p>NO SE ENCONTRARON DATOS</p>
        <a class="btn btn-primary" href="<?php echo BASE_URL?>producto/nuevo" class="k-button">Nuevo</a>
    <?php } ?>
        
