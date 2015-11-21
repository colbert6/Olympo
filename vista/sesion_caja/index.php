<div class="navbar-inner">
<?php if (isset($this->e_caja) && count($this->e_caja)) { ?>
    
    <table id="table" class="display" cellspacing="0" width="100%">
        <input type='hidden' name='id_empleado' id='id_empleado' value='<?php echo $this->empleado ?>'/>
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
                <td><?php if($this->e_caja[$i]['ESTADO']==1){echo $this->e_caja[$i]['MONTO_CIERRE'];}else{echo "Sin Saldo";} //nombre ?></td> 
                <td><!-- icon-stop -->
                    <?php if($this->e_caja[$i]['ESTADO']==1){?>
                            <a href="javascript:void(0)" onclick="cerrarCaja('<?php echo BASE_URL?>sesion_caja/cerrar/<?php echo $this->e_caja[$i]['ID_CAJA']?>','<?php echo BASE_URL?>sesion_caja/reporte_movimientos/<?php echo $this->e_caja[$i]['ID_SESION_CAJA'] ?>')" class="btn btn-success btn-minier"><i class="icon-stop icon-white"></i>&nbsp;&nbsp;&nbsp;Cerrar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    <?php }else{?>
                            <a href="javascript:void(0)" onclick="apertura('<?php echo $this->e_caja[$i]['ID_CAJA']?>')" class="btn btn-success btn-minier"><i class="icon-play icon-white"></i>&nbsp;&nbsp;&nbsp;Aperturar</a>
                    <?php }?>
                    
                    <a href="javascript:void(0)" onclick="editar('<?php echo BASE_URL?>sesion_caja/historial/<?php echo $this->e_caja[$i]['ID_CAJA'] ?>')" class="btn btn-danger btn-minier"><i class="icon-th-list icon-white"></i>&nbsp;&nbsp;&nbsp;Historial</a>
                    <?php if($this->e_caja[$i]['ESTADO']==1){ ?>
                    <a href="javascript:void(0)" onclick="movimiento('<?php echo BASE_URL?>sesion_caja/reporte_movimientos/<?php echo $this->e_caja[$i]['ID_SESION_CAJA'] ?>')" class="btn btn-info btn-minier"><i class="icon-th-list icon-white"></i>&nbsp;&nbsp;&nbsp;Reporte</a>
                    <?php } ?>
                </td>
                <script type="text/javascript">
                    function movimiento(url){
                        window.open(url,'_blank');
                    }
                </script>
            </tr>
        <?php } ?>
        </tbody>
    </table>      
    <?php } else { ?>
    <p>NO HAY CAJAS CREADAS</p>
        <a class="btn btn-primary" href="<?php echo BASE_URL?>caja/nuevo" class="k-button">CREAR CAJA</a>
    <?php } ?>
    <style>
        #myModal .modal-content {
            width: 300px;
            margin: 0 auto;
        }
    </style>
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Apertura de Caja</h3>
        </div>
        <div class="modal-body">

                    <input readonly  type='hidden' name="id_caja" id="id_caja" >
                    <div class="form-group">
                    <label class="control-label ">Ingrese Monto de Apertura:</label>
                      <input onkeypress="return dosDecimales(event,this)"  name="monto_apertura" id="monto_apertura" class="form-control"  placeholder="Monto de Apertura" autofocus
                            value="">
                
                    </div> 
        </div>
        <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cerrar</button>
            <button class="btn btn-success" data-dismiss="modal" id='btnAperturar' aria-hidden="true">Aperturar</button>
        </div>
        </div>
        </div>
    </div>


        
