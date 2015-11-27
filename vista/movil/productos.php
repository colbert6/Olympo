<div class='container-fluid'>
    <div class='row'>
        <ol class="breadcrumb" >
            <li><a href="<?php echo $_movilParams['menu'][0]['enlace']?>">Inicio</a></li>
            <li class="active">Productos</li>
        </ol>
        <?php if (isset($this->datos_producto) && count($this->datos_producto)){ ?>
        <?php for ($i = 0; $i < count($this->datos_producto); $i++) {?>
        <div class="col-xs-6 text-center">
            <div class="thumbnail">
                <img class="img-responsive" src="<?php echo $_movilParams['ruta_img_pro'].$this->datos_producto[$i]["IMAGEN"];?>" alt="">
                <div class="caption">
                    <h4><strong><?php echo $this->datos_producto[$i]["TITULO"] ?></strong>
                    </h4>
                    <p class='text-center'><?php echo $this->datos_producto[$i]["DESCRIPCION"] ?></p>
                    
                </div>
            </div>
        </div>
        <?php } ?>
        <?php }else{
            echo "<h4>No Hay Productos</h4>";
        }?>


        
    </div>
</div>