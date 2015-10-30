<div class="navbar-inner">
<?php if (isset($this->datos) && count($this->datos)) { ?>
    
    <table id="table" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ITEM</th>
                <th>NRO COMPROBANTE</th>
                <th>PROVEEDOR</th>
                <th>FECHA COMPRA</th>
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
                if($this->datos[$i]['ID_COMPRA'] == $this->datos[$j]['ID_COMPRA']){
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
        if($var == 1){ ?>
             <tr class="warning" style="background: greenyellow;">
        <?php }
        if($var == 2){ ?>
            <tr class="error" >
        <?php }?> 
                <?php $total= (int)(($this->datos[$i]['MONTO']*(1+$this->datos[$i]['IGV']) )*100)?>
                <?php $total= $total/100?>
                <td><?php echo ($i+1);//id ?></td>
                <td><?php echo $this->datos[$i]['NUM_DOCUMENTO']; ?></td>
                <td><?php echo $this->datos[$i]['XPROVEEDOR']; ?></td>
                <td><?php echo $this->datos[$i]['FECHA'];?></td>
                <td><?php echo $total;?></td> 
                <td><?php echo $this->datos[$i]['XMONTO_PAGADO'];?></td> 
                <td><?php echo ($total-$this->datos[$i]['XMONTO_PAGADO']);?></td> 
                
                <td>
                    <a title="Cronograma" href="<?php echo BASE_URL ?>cronograma_pago/cronograma/<?php echo $this->datos[$i]['ID_COMPRA'].'/'.(($this->datos[$i]['IGV']+1)*$this->datos[$i]['MONTO'] - $this->datos[$i]['XMONTO_PAGADO'])?>" class="btn btn-info btn-minier"><i class="icon-list-alt icon-white"></i></a>
                    <a title="Amortizar" href="<?php echo BASE_URL ?>cronograma_pago/amortizar/<?php echo $this->datos[$i]['ID_COMPRA'].'/'.(($this->datos[$i]['IGV']+1)*$this->datos[$i]['MONTO'] - $this->datos[$i]['XMONTO_PAGADO'])?>" class="btn btn-success btn-minier"><i  class="icon-chevron-down icon-white"></i> </a>

                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>  
    <div class="btn-group">
        <a class="btn btn-primary" href="almacen/nuevo" class="k-button">Nuevo</a>
    </div>      
    <?php } else { ?>
    <p>NO SE ENCONTRARON DATOS</p>
        <a class="btn btn-primary" href="<?php echo BASE_URL?>almacen/nuevo" class="k-button">Nuevo</a>
    <?php } ?>
        
