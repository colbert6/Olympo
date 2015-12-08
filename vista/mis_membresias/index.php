<div class="navbar-inner">
<?php if (isset($this->matricula) && count($this->matricula)) { ?>
    
    <table id="table" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class='text-center'>ITEM</th>
                <th class='text-center'>MEMBRESIA</th>
                <th class='text-center'>DURACION</th>
                <th class='text-center'>FECHA INICIO</th>
                <th class='text-center'>FECHA FIN</th>
                <th class='text-center'>ACCION</th>
            </tr>
        </thead>
         <tbody>
            <?php for ($i = 0; $i < count($this->matricula); $i++) { ?>
            <tr>
                <td class='text-center'><?php echo ($i+1);//id ?></td>
                <td class='text-center'><?php echo $this->matricula[$i]['TIPO_MEMBRESIA'];//nombre ?></td> 
                <td class='text-center'><?php echo $this->matricula[$i]['DURACION'];//nombre ?></td> 
                <td class='text-center'><?php echo $this->matricula[$i]['FECHA_INICIO'];//nombre ?></td> 
                <td class='text-center'><?php echo $this->matricula[$i]['FECHA_FIN'];//nombre ?></td> 
                
                <td class='text-center'>
                    <a href="javascript:void(0)" onclick="editar('<?php echo BASE_URL?>mis_membresias/detalle/<?php echo $this->matricula[$i]['ID_MATRICULA'] ?>')" class="btn btn-success btn-minier"><i class="icon-eye-open icon-white"></i></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>   
    <?php } else { ?>
    <p>NO SE ENCONTRARON DATOS</p>

    <?php } ?>
        
