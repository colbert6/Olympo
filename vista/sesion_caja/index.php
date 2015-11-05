<div class="navbar-inner">
<?php if (isset($this->e_caja) && count($this->e_caja)) { ?>
    
    <table id="table" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>SALDO ACTUAL</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
         <tbody>
            <?php for ($i = 0; $i < count($this->e_caja); $i++) { ?>
            <tr>
                <td><?php echo ($i+1);//id ?></td>
                <td><?php echo $this->e_caja[$i]['NOMBRE'];//nombre ?></td> 
                <td><?php if($this->e_caja[$i]['MONTO_CIERRE'] == ''){echo "0.00";}else{echo $this->e_caja[$i]['MONTO_CIERRE'];} //nombre ?></td> 
                <td><!-- icon-stop -->
                    <?php if($this->e_caja[$i]['ESTADO']==1){?>
                            <a href="javascript:void(0)" onclick="aperturar('<?php echo BASE_URL?>sesion_caja/cerrar/?>')" class="btn btn-success btn-minier"><i class="icon-stop icon-white"></i>&nbsp;&nbsp;&nbsp;Cerrar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    <?php }else{?>
                            <a href="javascript:void(0)" onclick="aperturar('<?php echo BASE_URL?>sesion_caja/?>')" class="btn btn-success btn-minier"><i class="icon-play icon-white"></i>&nbsp;&nbsp;&nbsp;Aperturar</a>
                    <?php }?>
                    
                    <a href="javascript:void(0)" onclick="aperturar('<?php echo BASE_URL?>sesion_caja/historial/<?php echo $this->e_caja[$i]['ID_CAJA'] ?>')" class="btn btn-danger btn-minier"><i class="icon-th-list icon-white"></i>&nbsp;&nbsp;&nbsp;Historial</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>      
    <?php } else { ?>
    <p>NO HAY CAJAS CREADAS</p>
        <a class="btn btn-primary" href="<?php echo BASE_URL?>caja/nuevo" class="k-button">CREAR CAJA</a>
    <?php } ?>
        
