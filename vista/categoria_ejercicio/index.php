<div class="navbar-inner">
<?php if (isset($this->datos) && count($this->datos)) { ?>
    
    <table id="table" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>DESCRIPCION</th>
                <th>ESTADO</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
         <tbody>
            <?php for ($i = 1; $i < count($this->datos); $i++) { ?>
            <tr>
                <td><?php echo ($i);//id ?></td>
                <td><?php echo $this->datos[$i]['DESCRIPCION'];//nombre ?></td> 
                <td><?php if($this->datos[$i]['ESTADO']=='1'){
                    echo 'Activo';
                } else{
                    echo 'Inactivo';
                } ?></td>
                <td>
                    <a href="javascript:void(0)" onclick="editar('<?php echo BASE_URL?>categoria_ejercicio/editar/<?php echo $this->datos[$i]['ID_CATEGORIA_EJERCICIO'] ?>')" class="btn btn-success btn-minier"><i class="icon-pencil icon-white"></i></a>
                    <a href="javascript:void(0)" onclick="eliminar('<?php echo BASE_URL?>categoria_ejercicio/eliminar/<?php echo $this->datos[$i]['ID_CATEGORIA_EJERCICIO'] ?>')" class="btn btn-danger btn-minier"><i class="icon-remove icon-white"></i></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>  
    <div class="btn-group">
        <a class="btn btn-primary" href="categoria_ejercicio/nuevo" class="k-button">Nuevo</a>
    </div>      
    <?php } else { ?>
    <p>NO SE ENCONTRARON DATOS</p>
        <a class="btn btn-primary" href="<?php echo BASE_URL?>categoria_ejercicio/nuevo" class="k-button">Nuevo</a>
    <?php } ?>
        
