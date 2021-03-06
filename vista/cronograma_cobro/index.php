<div class="navbar-inner">
<?php if (isset($this->datos) && count($this->datos)) { ?>
    
    <table id="table" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ITEM</th>
                <th>NRO COMPROBANTE</th>
                <th>CLIENTE</th>
                <th>FECHA VENTA</th>
                <th>TOTAL</th>
                <th>PAGADO</th>
                <th>RESTANTE</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < count($this->datos); $i++) { ?>
            <?php $var = 0; 
        if (isset($this->datos) && count($this->datos)){ 
            for ($j = 0; $j < count($this->datos); $j++) {
                if($this->datos[$i]['ID_VENTA'] == $this->datos[$j]['ID_VENTA']){
                    if($this->datos[$j]['MONTO'] ==$this->datos[$j]['XMONTO_PAGADO']){
                        $var = 1;
                    }else{
                        if(new DateTime($this->datos[$j]['FECHA'],new DateTimeZone('America/Lima'))>new DateTime(date("M d Y"),new DateTimeZone('America/Lima')) && $this->datos[$j]['MONTO'] > $this->datos[$j]['XMONTO_PAGADO']){
                            $var = 1;
                        }else{
                            $var = 2;
                            break;
                        }
                    }
                }
            }
        }
        
        ?> 
                <?php $total= round($this->datos[$i]['MONTO']*(1+$this->datos[$i]['IGV']), 2); ?>
                
                <td><?php echo ($i+1);//id ?></td>
                <td><?php echo $this->datos[$i]['NUM_DOCUMENTO']; ?></td>
                <td><?php echo $this->datos[$i]['XCLIENTE']; ?></td>
                <td><?php echo $this->datos[$i]['FECHA'];?></td>
                <td><?php echo $total;?></td> 
                <td><?php echo $this->datos[$i]['XMONTO_PAGADO'];?></td> 
                <td><?php echo ($total-$this->datos[$i]['XMONTO_PAGADO']);?></td> 
                
                <td>
                    <a title="Ver Cronograma" href="<?php echo BASE_URL ?>cronograma_cobro/cronograma/<?php echo $this->datos[$i]['ID_VENTA'].'/'.(($this->datos[$i]['IGV']+1)*$this->datos[$i]['MONTO'] - $this->datos[$i]['XMONTO_PAGADO'])?>" class="btn btn-info btn-minier"><i class="icon-list-alt icon-white"></i></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>      
    <?php } else { ?>
    <p>NO SE ENCONTRARON DATOS</p>
       
    <?php } ?>
        
