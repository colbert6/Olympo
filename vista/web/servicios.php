

<div class="col-md-12">
    
        <?php if (isset($this->datos_servicio) && count($this->datos_servicio)) { ?>
                                
        <div class="col-md-12">
                 
        <?php  for ($i = 0; $i < count($this->datos_servicio); $i++) { ?>

        <div class="col-md-12" >
            <div class"row" >

        <?php if (isset($this->datos_servicio) && count($this->datos_servicio)){ ?>
            <?php for($i = 0; $i < count($this->datos_servicio); $i++){?> 
                <div class="col-sm-4" style="margin: 0px 0px 20px 100px;">
                    <div class="thumbnail">
                        <div class="hover-bg">
                            <div class="hover-text">
                              <a> <h4 ><?php if(isset ($this->datos_servicio[$i]['TITULO']))echo $this->datos_servicio[$i]['TITULO']?></h4>
                                <h5><?php if(isset ($this->datos_servicio[$i]['DESCRIPCION']))echo $this->datos_servicio[$i]['DESCRIPCION']?></h5>
                                  <div class="clearfix"></div>
                                  <i class=""></i>
                              </a>
                            </div>    
                            <img style="width: 315px; height: 125px;" src="<?php echo $_webParams['ruta_img_ser']; ?><?php if(isset ($this->datos_servicio[$i]['IMAGEN']))echo $this->datos_servicio[$i]['IMAGEN']?>" alt="" style="height: 90%;"> 
                            <div class="caption">
                                <h4 ><strong><?php if(isset ($this->datos_servicio[$i]['TITULO']))echo $this->datos_servicio[$i]['TITULO']?></strong></h4>  
                            </div>
                        </div>
                    </div>
               </div>

            <?php } ?> 
        <?php } ?>
                            
                                
                    </div>
            </div>
               
             
          
        <?php }  //lista de Servicios   

        } else {
            echo "<h1>No hay Servicios Disponibles</h1>"; 
        }
        ?>
     
        </div>

</div>