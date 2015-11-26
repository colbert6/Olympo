<div class="navbar-inner ">

<table id="table" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Nro Cuota</th>
        <th>Fecha de Pago</th>
        <th>Monto de Cuota</th>
        <th>Monto Pagado</th>
        <th>Estado</th>
    </tr>
    </thead>
    <tbody>
    <?php for($i=0;$i<count($this->datos);$i++){ ?>
    <tr>
        <td><?php echo $this->datos[$i]['NUM_CUOTA']?></td>
        <td><?php echo $this->datos[$i]['FECHA']?></td>
        <td><?php echo $this->datos[$i]['MONTO_CUOTA']?></td>
        <td><?php echo $this->datos[$i]['MONTO_PAGADO']?></td>
        <td>
            <?php 
            if($this->datos[$i]['MONTO_CUOTA'] ==$this->datos[$i]['MONTO_PAGADO']){
                echo 'cancelado';
            }else{
                if(new DateTime($this->datos[$i]['FECHA'],new DateTimeZone('America/Lima'))>new DateTime(date("M d Y"),new DateTimeZone('America/Lima')) && $this->datos[$i]['MONTO_CUOTA'] > $this->datos[$i]['MONTO_PAGADO']){
//                if(strtotime(str_replace('/', '-', $this->datos[$i]['FECHA']))>strtotime('now') && $this->datos[$i]['MONTO_CUOTA'] > $this->datos[$i]['MONTO_PAGADO']){
                    echo 'normal';
                }else{
                    echo 'vencido';
                }
            }
            ?>
        </td>
    </tr>
    </tbody>
    <?php } ?>
</table>

<p>
    <a href="<?php echo BASE_URL?>cronograma_pago" class="btn btn-primary">Volver</a></p>
<br/>
