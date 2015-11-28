<div class="container-fluid">
    
    <div class="row">
        <ol class="breadcrumb" >
            <li><a href="<?php echo $_movilParams['menu'][0]['enlace']?>">Inicio</a></li>
            <li class="active">Nosotros</li>
        </ol>
        <div class="col-xs-12">
            <legend><img class="img-responsive" src="<?php echo $_movilParams['ruta_img']."logo_menu.png"; ?>" alt=""></legend>
        </div>

        <div class="col-xs-12" >            
            <p class="text-justify" ><?php if(isset ($this->datos[0]['HISTORIA']))echo $this->datos[0]['HISTORIA']?></p>
        </div>
        <div class="col-xs-12 nosotros_column"> 
            <h4 class="text-center"><strong><u>VISION</u></strong></h4>           
            <p class="text-justify" ><?php if(isset ($this->datos[0]['VISION']))echo $this->datos[0]['VISION']?></p>
            <h4 class="text-center"><strong><u>MISION</u></strong></h4>
            <p class="text-justify" ><?php if(isset ($this->datos[0]['MISION']))echo $this->datos[0]['MISION']?></p>
        </div>
    </div>
</div>


