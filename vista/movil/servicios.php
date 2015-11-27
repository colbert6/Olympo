<div class='container-fluid'>
	<div class="row">
        <ol class="breadcrumb" >
            <li><a href="<?php echo $_movilParams['menu'][0]['enlace']?>">Inicio</a></li>
            <li class="active">Servicios</li>
     	</ol>
        <?php if (isset($this->datos_servicio) && count($this->datos_servicio)){ ?>
            <?php for($i = 0; $i < count($this->datos_servicio); $i++){?> 
                <div class="col-xs-12 col-sm-6">
		            <div class="panel panel-default">
		                <div class="panel-heading" style='padding: 10px 5px;' >
		                    <h4 style='margin-top: 2px;margin-bottom: 2px;'><i class="fa fa-fw fa-check"></i><?php echo $this->datos_servicio[$i]["TITULO"]?></h4>
		                </div>
		                <img class='img-responsive' src="<?php echo $_movilParams['ruta_img_serv'].$this->datos_servicio[$i]["IMAGEN"];?>">
		                <div class="panel-body">
		                    <p class='text-center'><?php echo $this->datos_servicio[$i]["DESCRIPCION"]?></p>
		                </div>
		            </div>
		        </div>

            <?php } ?>
        <?php }else{
        	echo "<h4>No Hay Servicios</h4>";
        } ?> 
    </div>
</div>

	

    