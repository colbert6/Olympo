<div class="navbar-inner">
<?php if (isset($this->datos) && count($this->datos)) { ?>
    
    <table id="table" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ITEM</th>
                <th>MEMBRESIA</th>
                <th>SOCIO</th>
                <th>F. REGISTRO</th>
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
                <td><?php echo $this->datos[$i]['DESCRIPCION']." (".$this->datos[$i]['DURACION']." ".$this->datos[$i]['VIGENCIA'].") ";//nombre ?></td> 
                <td><?php echo $this->datos[$i]['NOMBRE']." ".$this->datos[$i]['APELLIDO_PATERNO']; ?></td>
                <td><?php echo $this->datos[$i]['FECHA_REGISTRO'];//id ?></td>
                <td><?php echo $this->datos[$i]['FECHA_INICIO'];//id ?></td>
                <td><?php echo $this->datos[$i]['FECHA_FIN'];//id ?></td>
                <td><?php if($this->datos[$i]['ESTADO_PAGO']=='1'){
                    echo 'Activo';
                } else{
                    echo 'Inactivo';
                } ?></td>
                <td><?php if($this->datos[$i]['ESTADO_PAGO']=='0'){?>
                    <a href="javascript:void(0)" onclick="eliminar('<?php echo BASE_URL?>matricula/eliminar/<?php echo $this->datos[$i]['ID_MATRICULA'] ?>')" class="btn btn-danger btn-minier"><i class="icon-remove icon-white"></i></a>
                    <a href="javascript:void(0)" onclick="editar('<?php echo BASE_URL?>venta/nuevo_membresia/<?php echo $this->datos[$i]['ID_MATRICULA'] ?>')" class="btn btn-success btn-minier"><i class="icon-shopping-cart icon-white"></i></a>
                    <?php }?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>  
    <div class="btn-group">
        <a class="btn btn-primary" href="matricula/nuevo" class="k-button">Nuevo</a>
    </div>      
    <?php } else { ?>
    <p>NO SE ENCONTRARON DATOS</p>
        <a class="btn btn-primary" href="<?php echo BASE_URL?>matricula/nuevo" class="k-button">Nuevo</a>
    <?php } ?>
        
