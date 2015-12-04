<div class="navbar-inner">
<?php if (isset($this->datos) && count($this->datos)) { ?>
    
    <table id="table" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ITEM</th>
                <th>NOMBRE</th>
                <th>LUGAR</th> 
                <th>FECHA</th>  
                <th>HORA</th> 
                <th>ACCIONES</th>
            </tr>
        </thead>
         <tbody>
            <?php for ($i = 0; $i < count($this->datos); $i++) { ?>
            <?php $hora = new DateTime($this->datos[$i]["HORA_EVENTO"]); ?>
            <tr>
                <td><?php echo ($i+1);//id ?></td>
                <td><?php echo $this->datos[$i]['NOMBRE'];//nombre ?></td>  
                 <td><?php echo $this->datos[$i]['LUGAR'];//nombre ?></td> 
                 <td><?php echo $this->datos[$i]['FECHA_INICIO'];//nombre ?></td>
                <td><?php echo date_format($hora, 'g:i A');//nombre ?></td>
                <td>
                    <?php $participar = false; $id=0;?>
                    <?php for ($j=0; $j < count($this->event_part); $j++) { ?>
                    <?php   if($this->datos[$i]['ID_EVENTO']==$this->event_part[$j]["ID_EVENTO"]){
                                $participar=true;
                                $id = $this->event_part[$j]["ID_SOCIO_X_EVENTO"];
                            }
                    ?>
                    <?php }?>
                    <?php if($participar){?>
                        <a id='btn_pa<?php echo ($i+1);?>' idsocioevento='<?php echo $id;?>' estado='0' href="javascript:void(0)" onclick="participar('<?php echo ($i+1)?>','<?php echo $this->datos[$i]['ID_EVENTO'] ?>','<?php echo session::get('id_socio') ?>')" class="btn btn-warning btn-minier">
                                <div id='accion<?php echo ($i+1)?>'>
                                <span class='glyphicon glyphicon-remove'></span>&nbsp;NO ASISTIR
                            </div>

                        </a>          
                    <?php }else{?>
                        <a id='btn_pa<?php echo ($i+1);?>' idsocioevento='<?php echo $id;?>' estado='1' href="javascript:void(0)" onclick="participar('<?php echo ($i+1)?>','<?php echo $this->datos[$i]['ID_EVENTO'] ?>','<?php echo session::get('id_socio') ?>')" class="btn btn-warning btn-minier">
                                <div id='accion<?php echo ($i+1)?>'>
                                    <span class='glyphicon glyphicon-ok'></span>&nbsp;ASISTIR
                                </div>
                        </a> 
                    <?php }?>

                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>       
    <?php } else { ?>
    <p>NO SE ENCONTRARON DATOS</p>
    <?php } ?>
        