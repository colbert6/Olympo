
<script type="text/javascript"  src="<?php echo BASE_URL."vista/movil/js/funcion.js"?>"></script>
<div class="container-fluid">
    
    <div class="row">
        <ol class="breadcrumb" >
            <li><a href="<?php echo BASE_URL."movil/sistema_movil/sistema/"; ?>">Inicio</a></li>
            <li class="active">Eventos</li>
        </ol>
        <div class="col-xs-12">
                <?php if (isset($this->evento) && count($this->evento)){?>
                <?php    for($i = 0; $i < count($this->evento); $i++){ ?>
                <?php 
                        $fecha = explode("-",$this->evento[$i]['FECHA_INICIO']);
                        $hora = new DateTime($this->evento[$i]["HORA_EVENTO"]);
                        $mes=" ";
                        switch ($fecha[1]) {
                           case 01:
                               $mes="ENE";
                               break;
                           case 02:
                               $mes="FEB";
                               break;
                           case 03:
                               $mes="MAR";
                               break;
                           case 04:
                               $mes="ABR";
                               break;
                           case 05:
                               $mes="MAY";
                               break;
                           case 06:
                               $mes="JUN";
                               break;
                           case 07:
                               $mes="JUL";
                               break;
                           case 08:
                               $mes="AGO";
                               break;
                           case 09:
                               $mes="SET";
                               break;
                           case 10:
                               $mes="OCT";
                               break;
                           case 11:
                               $mes="NOV";
                               break;
                           case 12:
                               $mes="DIC";
                               break;
                       }
                ?>
                            <div class="media">
                                <div class="pull-left">
                                    <button type="button" class="lista_eventos" style="margin: 0px 14px 0px 0px; border-radius: 5px 5px 5px 5px;"><?php echo $fecha[2]?></br><?php echo $mes?></button>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"><strong><u><?php echo $this->evento[$i]["NOMBRE"];?></u></strong></h4>
                                    <small><strong>Lugar&nbsp;&nbsp;:</strong>&nbsp;<?php echo $this->evento[$i]["LUGAR"];?></small><br>
                                    <small><strong>Hora&nbsp;&nbsp;&nbsp;&nbsp;:</strong>&nbsp;<?php echo date_format($hora, 'g:i A');?></small>
                      
                                </div>
                  				
                    <?php $participar = false; $id=0;?>
                    <?php for ($j=0; $j < count($this->event_part); $j++) { ?>
                    <?php   if($this->evento[$i]['ID_EVENTO']==$this->event_part[$j]["ID_EVENTO"]){
                                $participar=true;
                                $id = $this->event_part[$j]["ID_SOCIO_X_EVENTO"];
                            }
                    ?>
                    <?php }?>

                    <div class="pull-right">
                        <?php if($participar){?>
                        <a id='btn_pa<?php echo ($i+1);?>' idsocioevento='<?php echo $id;?>' estado='0' href="javascript:void(0)" onclick="participar('<?php echo ($i+1);?>','<?php echo $this->evento[$i]['ID_EVENTO'] ?>','<?php echo session::get('id_socio') ?>','<?php echo BASE_URL; ?>')" class="btn btn-success btn-minier">
                        	<div id='accion<?php echo ($i+1)?>'>
                        		<span class='glyphicon glyphicon-remove'></span>&nbsp;NO ASISTIR
                        	</div>
                        	</a>          
                    <?php }else{?>
                        <a id='btn_pa<?php echo ($i+1);?>' idsocioevento='<?php echo $id;?>' estado='1' href="javascript:void(0)" onclick="participar('<?php echo ($i+1);?>','<?php echo $this->evento[$i]['ID_EVENTO'] ?>','<?php echo session::get('id_socio') ?>','<?php echo BASE_URL; ?>')" class="btn btn-success btn-minier">
                        		<div id='accion<?php echo ($i+1)?>'>
                        			<span class='glyphicon glyphicon-ok'></span>&nbsp;ASISTIR
                        		</div>
                        	</a> 
                    <?php }?>
                    </div>
                            </div>

                            <hr>
                <?php    } ?>
                <?php }else{
                    echo "<h1>No hay Eventos</h1>";
                } ?>
                
        </div>
       
 
    </div>
</div>
