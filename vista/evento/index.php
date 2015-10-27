
<?php if (isset($this->datos) && count($this->datos)) { ?>
    
    <table id="table" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ITEM</th>
                <th>NOMBRE</th>
                <th>LUGAR</th> 
                <th>F. INICIO</th>   
                <th>F. FIN</th> 
                  
                <th>ESTADO</th> 
                <th>ACCIONES</th>
            </tr>
        </thead>
         <tbody>
            <?php for ($i = 0; $i < count($this->datos); $i++) { ?>
            <tr>
                <td><?php echo ($i+1);//id ?></td>
                <td><?php echo $this->datos[$i]['NOMBRE'];//nombre ?></td>  
                 <td><?php echo $this->datos[$i]['LUGAR'];//nombre ?></td> 
                 <td><?php echo $this->datos[$i]['FECHA_INICIO'];//nombre ?></td>
                 <td><?php echo $this->datos[$i]['FECHA_FIN'];//nombre ?></td>
               
                <td><?php if($this->datos[$i]['ESTADO']=='1'){
                    echo 'Activo';
                } else{
                    echo 'Inactivo';
                } ?></td>
                
                <td>
                    <a href="javascript:void(0)" onclick="editar('<?php echo BASE_URL?>evento/vermas/<?php echo $this->datos[$i]['ID_EVENTO'] ?>')" class="btn btn-warning btn-minier"><i class="icon-eye-open icon-white"></i></a>
                    <a href="javascript:void(0)" onclick="editar('<?php echo BASE_URL?>evento/editar/<?php echo $this->datos[$i]['ID_EVENTO'] ?>')" class="btn btn-success btn-minier"><i class="icon-pencil icon-white"></i></a>
                    <a href="javascript:void(0)" onclick="eliminar('<?php echo BASE_URL?>evento/eliminar/<?php echo $this->datos[$i]['ID_EVENTO'] ?>')" class="btn btn-danger btn-minier"><i class="icon-remove icon-white"></i></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>  
    <div class="btn-group">
        <a class="btn btn-primary" href="evento/nuevo" class="k-button">Nuevo</a>
    </div>      
    <?php } else { ?>
    <p>NO SE ENCONTRARON DATOS</p>
        <a class="btn btn-primary" href="<?php echo BASE_URL?>evento/nuevo" class="k-button">Nuevo</a>
    <?php } ?>
        
