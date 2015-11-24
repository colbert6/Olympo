<?php
$chart = new Highchart();
$chart->chart->renderTo = "container";
$chart->chart->type = "column";
$chart->title->text = utf8_decode("Servicios Más Vendidos de Olympo Finess");

$chart->xAxis->categories = array($this->datos[0]['NOMBRE'],$this->datos[1]['NOMBRE'],
        $this->datos[2]['NOMBRE'],$this->datos[3]['NOMBRE'],$this->datos[4]['NOMBRE']);

$chart->yAxis->min = 0;
$chart->yAxis->title->text = "Cantidad de Servicios";
$chart->legend->layout = "vertical";
$chart->legend->backgroundColor = "#FFFFFF";
$chart->legend->align = "left";
$chart->legend->verticalAlign = "top";
$chart->legend->x = 100;
$chart->legend->y = 70;
$chart->legend->floating = 1;
$chart->legend->shadow = 1;

$chart->tooltip->formatter = new HighchartJsExpr("function() {
    return '' + this.x +' '+ this.y +' Servicios';}");

$chart->plotOptions->column->pointPadding = 0.2;
$chart->plotOptions->column->borderWidth = 0;

$chart->series[] = array('name' => "Servicios mas solicitados",
                         'data' => array((float)$this->datos[0]['CANTIDAD'],(float)$this->datos[1]['CANTIDAD'], 
                             (float)$this->datos[2]['CANTIDAD'], (float)$this->datos[3]['CANTIDAD'], 
                             (float)$this->datos[4]['CANTIDAD']));

?>

<html>
  <head>
    <title>Ventas</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php
      foreach ($chart->getScripts() as $script) {
         echo '<script type="text/javascript" src="' . $script . '"></script>';
      }
    ?>
  </head>
  <body>
    <div id="container"></div>
    <script type="text/javascript">
    <?php
      echo $chart->render("chart1");
    ?>
    </script>
  </body>
</html>
