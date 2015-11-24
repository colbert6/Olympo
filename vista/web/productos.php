<div class="col-md-12">
    <?php if (!$this->informacion) { //saber si se ha pedido informacion de algun servicio?> 
    
            
        <?php if (isset($this->datos_producto) && count($this->datos_producto)){ ?>
                     
                    <div class="col-md-12">
                    <?php for ($i = 0; $i < count($this->datos_producto); $i++) {?>
                         <div class="col-md-3 col-sm-6">
                <div class="thumbnail" style='-webkit-box-shadow: 2px 2px 5px #999;-moz-box-shadow: 2px 2px 5px #999;filter: shadow(color=#999999, direction=135, strength=2);'>
                    <img  src="<?php echo $_webParams['ruta_img_pro'].$this->datos_producto[$i]["IMAGEN"];?>" alt="">
                    <div class="caption">
                        <h3 class='text-center'><strong><?php echo $this->datos_producto[$i]["TITULO"] ?></strong></h3>
                        <p class='text-center'><?php echo $this->datos_producto[$i]["DESCRIPCION"] ?></p>
                        <p class='text-center'>
                            <!--a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More Info</a-->
                        </p>
                    </div>
                </div>
            </div>


                   <?php } ?>
                    </div> 
                 

                <?php }else{ ?>
                     <div class="col-lg-12">
                         <h4>No Hay  Productos</h4>
                     </div>
    
                 <?php }  ?>
    
        <?php }?>
</div>      