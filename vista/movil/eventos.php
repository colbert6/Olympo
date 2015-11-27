<div class='container-fluid'>
	<div class='row'>
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
                            </div>
                            <hr>
                <?php    } ?>
                <?php }else{
                    echo "<h1>No hay Eventos</h1>";
                } ?>
                
        </div>
	</div>
</div>