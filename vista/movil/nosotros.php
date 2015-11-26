<div class="container-fluid">
    <h3 class='text-center'><strong> BIENVENIDOS</strong></h3><hr>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <img class="img-responsive" src="<?php echo $_movilParams['ruta_img_web']; ?>img_nosotros.png" alt="">
        </div>
        <div class="col-xs-12 col-sm-6">            
            <p class="text-justify" ><?php if(isset ($this->datos[0]['HISTORIA']))echo $this->datos[0]['HISTORIA']?></p>
        </div>
        <div class="col-xs-12 col-sm-6 nosotros_column"> 
            <h4 class="text-center"><strong><u>VISION</u></strong></h4>           
            <p class="text-justify" ><?php if(isset ($this->datos[0]['VISION']))echo $this->datos[0]['VISION']?></p>
            <h4 class="text-center"><strong><u>MISION</u></strong></h4>
            <p class="text-justify" ><?php if(isset ($this->datos[0]['MISION']))echo $this->datos[0]['MISION']?></p>
        </div>
    </div>
</div>
