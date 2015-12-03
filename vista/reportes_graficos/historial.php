c<?php
$chart = new Highchart();

$chart->chart->type = "spline";
$chart->title->text = utf8_decode("HISTORIAL DEL SOCIO");
$chart->subtitle->text = utf8_decode("Registro de cuotas pagadas");

$chart->xAxis->type= 'datetime';
$chart->xAxis->labels->overflow= 'justify';

$chart->yAxis->title->text = "CALIFICACION";
$chart->yAxis->minorGridLineWidth = 0;
$chart->yAxis->gridLineWidth = 0;
$chart->yAxis->alternateGridColor = null;

$chart->yAxis->plotBands=array(array( 'from'=>0,
                                'to'=>10,
                                'color'=>'rgba(68, 170, 213, 0.1)',
                                'label'=> array( 'text'=>'Light air','style'=>array( 'color'=>'#606060' ) )),
                               array( 'from'=>10,
                                'to'=>15,
                                'color'=>'rgba(0, 0, 0, 0)',
                                'label'=> array( 'text'=>'Light air','style'=>array( 'color'=>'#606060' ) )),
                               array( 'from'=>15,
                                'to'=>20,
                                'color'=>'rgba(68, 170, 213, 0.1)',
                                'label'=> array( 'text'=>'Light air','style'=>array( 'color'=>'#606060' ) )));

$chart->yAxis->tooltip->valueSuffix=' m/s';


$chart->chart->renderTo = "container";
for ($i = 0; $i < count($this->datos); $i++) {
    $chart->xAxis->categories [] =  $this->datos[$i]['FECHA_VENC'];
}

$chart->yAxis->min = 0;
$chart->yAxis->max = 20;

$chart->legend->layout = "vertical";
$chart->legend->backgroundColor = "#FFFFFF";
$chart->legend->align = "left";
$chart->legend->verticalAlign = "top";
$chart->legend->x = 100;
$chart->legend->y = 40;
$chart->legend->floating = 1;
$chart->legend->shadow = 1;

$chart->tooltip->formatter = new HighchartJsExpr("function() {
    return '' +'Calificacion: '+this.y  +'';}");

$chart->plotOptions->line->pointPadding = 0.2;
$chart->plotOptions->line->borderWidth = 0;



for ($i = 0; $i < count($this->datos); $i++) {
    $maximo_dia_retraso=100;
    $maxima_calificacion=20;
        
    if((int) $this->datos[$i]['RETRASO']<100){
        $retraso=(int)$this->datos[$i]['RETRASO'];

        $perdidad=(float)($maxima_calificacion/$maximo_dia_retraso);
        
        $calificacion[]= (float)number_format((((-$perdidad)*$retraso)+$maxima_calificacion), 2, '.', '');
    }else{
        $calificacion[] = (float) 0;
    }
    
}
$chart->series[]=array('name' => "",'data'=>$calificacion);
$chart->series->navigation->menuItemStyle->fontSize='10px';


?>


  <head>
    <title>Ventas</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php
        
      /*foreach ($chart->getScripts() as $script) {
         echo '<script type="text/javascript" src="' . $script . '"></script>';
      }*/
        echo '<script type="text/javascript" src="/Olympo/lib/js/highcharts.js"></script>';
    ?>
  </head>
  <body>
    <div id="container"></div>
    
    <script type="text/javascript">
    <?php
      echo $chart->render("chart1");
    ?>
    </script>
    <?php
    
         
      
    ?>
    
  </body>

