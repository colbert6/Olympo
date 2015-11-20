<section  class="row" style="border-radius: 5px;margin: 1% auto 2% auto;">
               
    <div class="row" >
        
        <div class="col-md-8 " style="padding-right: 10px;">
            
            <h3 class="col-lg-offset-1">    
                <strong> BIENVENIDOS</strong>
            </h3>
                <hr>
            <div class="media-right media-left">
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img style="width: 200px; height: 200px;" class="media-object" src="<?php echo $_webParams['ruta_img']; ?>img_nosotros.png" alt="...">
                        </a>
                    </div>
                    <div class="media-body">
                        <p class="text-justify">
                        <?php if(isset ($this->datos[0]['HISTORIA']))echo $this->datos[0]['HISTORIA']?>
                        </p>
                    </div>
                </div>
                    
            </div>

        </div>
        
        <div class="col-md-3 nostros_colum" >
            <h4 class="text-center"><strong>VISION</strong></h4>
                <p class="text-justify">
                    <?php if(isset ($this->datos[0]['VISION']))echo $this->datos[0]['VISION']?>
                </p>                
            <hr>  
            
            <h4 class="text-center"><strong>MISION</strong></h4>
                <p class="text-justify">
                    <?php if(isset ($this->datos[0]['MISION']))echo $this->datos[0]['MISION']?>
                </p>
        </div>
               
    </div><!--/.row-->

        