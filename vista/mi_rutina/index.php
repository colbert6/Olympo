<div class="navbar-inner">
    
    <div class="col-md-1"></div>
    <div class="col-md-10" style="color:#000">
        <?php $dias = array('LUNES','MARTES','MIERCOLES','JUEVES','VIERNES','SABADO');?>
        <?php for ($i=0; $i < count($dias) ; $i++) { ?>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"  >
                        <h4 style='font-family: fantasy;font-size: 20px;' ><?php echo $dias[$i]?></h4>
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