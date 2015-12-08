<?php
$chart = new Highchart();

$chart->chart->type = "spline";
$chart->title->text = utf8_decode("HISTORIAL DEL SOCIO");
$chart->subtitle->text = utf8_decode("Registro de cuotas pagadas");

$chart->xAxis->type= 'datetime';
$chart->xAxis->labels->overflow= 'justify';

$chart->yAxis->title->text = "CALIFICACION";
$chart->yAxis->minorGridLineWidth = 0;
$chart->yAxis->gridLineWidth = 1;
$chart->yAxis->alternateGridColor = null;

$chart->yAxis->plotBands=array(array( 'from'=>15,
                                'to'=>20,
                                'color'=>'rgba(68, 170, 213, 0.1)',
                                'label'=> array( 'text'=>'(0-9) Dias de Retraso','style'=>array( 'color'=>'#606060' ) )),
                               array( 'from'=>15,
                                'to'=>10,
                                'color'=>'rgba(240, 255, 99, 0.1)',
                                'label'=> array( 'text'=>'(10-24) Dias de Retraso','style'=>array( 'color'=>'#606060' ) )),
                               array( 'from'=>10,
                                'to'=>5,
                                'color'=>'rgba(255, 201, 99, 0.1)',
                                'label'=> array( 'text'=>'(25 a 40) Dias de Retraso','style'=>array( 'color'=>'#606060' ) )),
                               array( 'from'=>5,
                                'to'=>0,
                                'color'=>'rgba(255, 99, 99, 0.1)',
                                'label'=> array( 'text'=>'(40 a +) Dias de Retraso','style'=>array( 'color'=>'#606060' ),'align'=>'top' )));


$chart->tooltip->crosshairs=true;
$chart->tooltip->shared=true;

$chart->chart->renderTo = "container";
for ($i = 0; $i < count($this->datos); $i++) {
    $chart->xAxis->categories [] =  $this->datos[$i]['FECHA_VENC'];
}

$chart->yAxis->min = 0;
$chart->yAxis->max = 25;

$chart->legend->layout = "vertical";
$chart->legend->backgroundColor = "#FFFFFF";
$chart->legend->align = "left";
$chart->legend->verticalAlign = "top";
$chart->legend->x = 70;
$chart->legend->y = 10;
$chart->legend->floating = 1;
$chart->legend->shadow = 1;

$chart->tooltip->formatter = new HighchartJsExpr("function() {
    return '' +'Calificacion: '+this.y  +'';}");

$chart->plotOptions->spline->pointPadding = 10;
$chart->plotOptions->spline->borderWidth = 20;
$chart->plotOptions->spline->lineWidth = 2;
$chart->plotOptions->spline->marker->radius = 4;
$chart->plotOptions->spline->marker->lineColor = '#666666';
$chart->plotOptions->spline->marker->lineWidth = 1;


for ($i = 0; $i < count($this->datos); $i++) {
    
    
 
    if((int) $this->datos[$i]['RETRASO']>=0 && (int) $this->datos[$i]['RETRASO']<=9){
        $maximo_dia_retraso=9;
        $maxima_calificacion=5;
        $retraso=(int)$this->datos[$i]['RETRASO'];        
        $perdidad=(float)number_format(($maxima_calificacion/$maximo_dia_retraso), 2, '.', '');
        $calificacion[]= (float)number_format((((-$perdidad)*$retraso)+$maxima_calificacion), 2, '.', '')+15;
        
    }else if((int) $this->datos[$i]['RETRASO']>=10 && (int) $this->datos[$i]['RETRASO']<=24){
        $maximo_dia_retraso=14;
        $maxima_calificacion=5;
        $retraso=(int)$this->datos[$i]['RETRASO']-14;
        $perdidad=(float)($maxima_calificacion/$maximo_dia_retraso);
        
        $calificacion[]= (float)number_format((((-$perdidad)*$retraso)+$maxima_calificacion), 2, '.', '')+10;
    }else if((int) $this->datos[$i]['RETRASO']>=25 && (int) $this->datos[$i]['RETRASO']<=40){
        $maximo_dia_retraso=15;
        $maxima_calificacion=5;
        $retraso=(int)$this->datos[$i]['RETRASO']-25;
        $perdidad=(float)($maxima_calificacion/$maximo_dia_retraso);
        
        $calificacion[]= (float)number_format((((-$perdidad)*$retraso)+$maxima_calificacion), 2, '.', '')+5;
    }else if((int) $this->datos[$i]['RETRASO']>=40){
        $retraso=(int)$this->datos[$i]['RETRASO']-40;
        $calificacion[]= (float)number_format((((-0.2)*$retraso)+5), 2, '.', '');
    }
    
}
$chart->series[]=array('name' => "Historial",'data'=>$calificacion);


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
    <div id="container" style="width: 800px; height: 400px;"></div>
    
    <script type="text/javascript">
    <?php
      echo $chart->render("chart1");
    ?>
    </script>
    <?php
    
         
      
    ?>
    
  </body>

