<div class="container-fluid">
    
    <div class="row">
        <ol class="breadcrumb" >
            <li><a href="<?php echo BASE_URL."movil/sistema_movil/sistema/"; ?>">Inicio</a></li>
            <li class="active">Mis Membresias</li>
        </ol>
        
        <?php if (isset($this->matricula) && count($this->matricula)) { ?>
    
    <table class="table">
        <thead>
            <tr>
                <th class='text-center'>#</th>
                <th class='text-center'>MEMBRESIA</th>
                <th class='text-center'>DURACION</th>
                <th class='text-center'>ACCION</th>
            </tr>
        </thead>
         <tbody>
            <?php for ($i = 0; $i < count($this->matricula); $i++) { ?>
            <tr>
                <td class='text-center'><?php echo ($i+1);//id ?></td>
                <td class='text-center'><?php echo $this->matricula[$i]['TIPO_MEMBRESIA'];//nombre ?></td> 
                <td class='text-center'><?php echo $this->matricula[$i]['DURACION'];//nombre ?></td> 
                
                <td class='text-center'>
                    <a href="<?php echo BASE_URL?>movil/sistema_movil/det_memb/<?php echo $this->matricula[$i]['ID_MATRICULA'] ?>" class="btn btn-success btn-minier"><span class="glyphicon glyphicon-plus"></span></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>   
    <?php } else { ?>
    <p>NO SE ENCONTRARON DATOS</p>

    <?php } ?>
    </div>
</div>