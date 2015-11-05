<div class="navbar-inner">
<?php if (isset($this->e_caja) && count($this->e_caja)) { ?>
    
    <table id="table" class="table" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>EMPLEADO</th>
                <th>APERTURA</th>
                <th>SALDO APERTURA</th>
                <th>CIERRE</th>
                <th>SALDO CIERRE</th>
                <th>ESTADO</th>
            </tr>
        </thead>
         <tbody>
            <?php for ($i = 0; $i < count($this->e_caja); $i++) { ?>
            <?php if($this->e_caja[$i]['ESTADO'] == 1){ $clase = "success";}else{$clase = "default";}?>
            <tr class='<?php echo $clase;?>'>
                <td><?php echo $this->e_caja[$i]['NOMBRE_COMPLETO']; ?></td>
                <td><?php echo $this->e_caja[$i]['FECHA_ENTRADA'];?></td> 
                <td><?php echo $this->e_caja[$i]['MONTO_INICIO'];?></td> 
                <td><?php if($this->e_caja[$i]['ESTADO'] == 1){echo "Caja aun no Cerrada";}else{echo $this->e_caja[$i]['FECHA_SALIDA'];}?></td> 
                <td><?php if($this->e_caja[$i]['ESTADO'] == 1){echo "Caja aun no Cerrada";}else{echo $this->e_caja[$i]['MONTO_CIERRE'];}?></td> 
                <td><!-- icon-stop -->
                    <?php if($this->e_caja[$i]['ESTADO']==1){
                            echo "APERTURADO";    
                          }else{
                            echo "CERRADO";
                          }?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <a class="btn btn-warning" href="<?php echo BASE_URL?>sesion_caja/" class="k-button">Volver</a>      
    <?php } else { ?>
    <p>NO SE INICIO SESION DE ESTA CAJA</p>
    <a class="btn btn-warning" href="<?php echo BASE_URL?>sesion_caja/" class="k-button">Volver</a>      
    <?php } ?>
        
