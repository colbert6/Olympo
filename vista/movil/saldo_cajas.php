<div class="container-fluid">
    <div class="row">
        <ol class="breadcrumb" >
            <li><a href="<?php echo BASE_URL."movil/sistema_movil/sistema/"; ?>">Inicio</a></li>
            <li class="active">Saldos Caja</li>
        </ol>
        <?php if(isset($this->e_caja) && count($this->e_caja)){?>
        <table class="table table-striped table-bordered table-hover sortable">
            <thead>
                <tr class='danger'>
                    <th class='text-center'>#</th>
                    <th class='text-center'>CAJA</th>
                    <th class='text-center'>SALDO(S/.)</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i=0; $i < count($this->e_caja) ; $i++) {?>
                 <tr >
                    <td class='text-center'><?php echo ($i+1) ?></td>
                    <td class='text-center'><?php echo $this->e_caja[$i]['NOMBRE'];?></td>
                    <td class='text-center'><?php if($this->e_caja[$i]['ESTADO']==1){echo $this->e_caja[$i]['MONTO_CIERRE'];}else{echo "Caja Cerrada";} ?></td>
                    
                </tr>
                <?php }?>
            </tbody>
        </table>
    <?php }else{
        echo "<h3>NO HAY CAJAS</h3>";
    }?>
    </div>
</div>