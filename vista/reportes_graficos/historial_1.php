c<?php
$chart = new Highchart();

$chart->chart->type = "spline";
$chart->title->text = utf8_decode("HISTORIAL DEL SOCIO");
$chart->subtitle->text = utf8_decode("Registro de cuotas pagadas");




$chart->chart->renderTo = "container";
$chart->xAxis->categories
xAxis: {
            type: 'datetime',
            labels: {
                overflow: 'justify'
            }
        },


for ($i = 0; $i < count($this->datos); $i++) {
    $chart->xAxis->categories [] =  $this->datos[$i]['FECHA_VENC'];
}

$chart->yAxis->min = 0;

$chart->yAxis->title->text = "Calificacion";
$chart->legend->layout = "vertical";
$chart->legend->backgroundColor = "#FFFFFF";
$chart->legend->align = "left";
$chart->legend->verticalAlign = "top";
$chart->legend->x = 100;
$chart->legend->y = 30;
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
$chart->series[]=array('name' => "Dinero s",'data'=>$calificacion);


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

