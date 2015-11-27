<div class="navbar-inner">
<?php if (isset($this->datos) && count($this->datos)) { ?>
    
    <table id="table" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ITEM</th>
                <th>MOVIMIENTO</th>
                <th>ALMACEN</th>
                <th>PRODUCTO</th>
                <th>FECHA</th>
                <th>CANTIDAD</th>
            </tr>
        </thead>
         <tbody>
            <?php for ($i = 0; $i < count($this->datos); $i++) { ?>
            <tr>
                <td><?php echo ($i+1);//id ?></td>
                <td><?php echo $this->datos[$i]['MOVIMIENTO'];//nombre ?></td> 
                <td><?php echo $this->datos[$i]['ALMACEN'];?></td> 
                <td><?php echo $this->datos[$i]['PRODUCTO'];//nombre ?></td> 
                <td><?php echo $this->datos[$i]['FECHA'];//nombre ?></td> 
                <td><?php echo $this->datos[$i]['CANTIDAD'];//nombre ?></td> 
                         </tr>
        <?php } ?>
        </tbody>
    </table>  
    <div class="btn-group">
        <a class="btn btn-primary" href="almacen/index" class="k-button">Regresar</a>
    </div>      
    <?php } else { ?>
    <p>NO SE ENCONTRARON DATOS</p>
        <a class="btn btn-primary" href="<?php echo BASE_URL?>almacen/index" class="k-button">Regresar</a>
    <?php } ?>
        
