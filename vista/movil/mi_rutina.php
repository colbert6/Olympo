<div class="container-fluid">
    
    <div class="row">
        <ol class="breadcrumb" >
            <li><a href="<?php echo BASE_URL."movil/sistema_movil/sistema/"; ?>">Inicio</a></li>
            <li class="active">Mi Rutina</li>
        </ol>
        <?php $dias = array('LUNES','MARTES','MIERCOLES','JUEVES','VIERNES','SABADO');?>
        <?php for ($i=0; $i < count($dias) ; $i++) { ?>
            <div class="col-xs-12 text-center">
                <div class="panel panel-default">
                    <div class="panel-heading"  >
                        <h4 style='font-family: fantasy;font-size: 18px;' ><?php echo $dias[$i]?></h4>
                    </div>
                    
                    <div class="panel-body">
                    <?php if (isset ($this->rutina) && count($this->rutina)){?>
                    <?php     for ($j=0; $j < count($this->rutina); $j++){?>
                    <?php          if($this->rutina[$j]["DIA"]==$dias[$i]){?>
                    <?php               if (isset ($this->categoria_ejercicio) && count($this->categoria_ejercicio)){?>
                    <?php                   for ($k=0; $k < count($this->categoria_ejercicio); $k++) {?>
                    <?php                       if($this->rutina[$j]["ID_CATEGORIA_EJERCICIO"]==$this->categoria_ejercicio[$k]["ID_CATEGORIA_EJERCICIO"]){?>
                                                    <li><?php echo $this->categoria_ejercicio[$k]["DESCRIPCION"]?></li>
                    <?php                       }?>
                    <?php                   }?>
                    <?php               }?>
                    <?php          }?>
                    <?php     }?>

                    <?php }?>
                    </div>
                </div>
            </div>
        <?php } ?>
 
    </div>
</div>