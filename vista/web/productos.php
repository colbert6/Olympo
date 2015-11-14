<div class="col-md-12">
    <?php if (!$this->informacion) { //saber si se ha pedido informacion de algun servicio?> 
    
            
        <?php if (isset($this->datos_producto) && count($this->datos_producto)){ ?>
                     
                    <div class="col-md-12">
                    <?php for ($i = 0; $i < count($this->datos_producto); $i++) {?>
                         <div class="col-md-4">
            
                                 <div class="">
                                     <div class="" >

                                         <div class="text-center " >
                                             <div class="sombra" > 
                                              <div class="text-justify" >
                                                <img class="img-circle img-thumbnail text-cente sombra-img" src="<?php echo $_webParams['ruta_img_pro']; ?><?php if(isset ($this->datos_producto[$i]['IMAGEN']))echo $this->datos_producto[$i]['IMAGEN']?>" alt="">
                                                <h4 class="text-center sombra-titulo">
                                           <?php if(isset ($this->datos_producto[$i]['TITULO']))echo $this->datos_producto[$i]['TITULO']?></h4>
                                             <h5 class="descripcion"><?php if(isset ($this->datos_producto[$i]['DESCRIPCION']))echo $this->datos_producto[$i]['DESCRIPCION']?></h5>
                                             <div class="clearfix"></div>
                                             </div>
                                             </div>
                                         </div>    
                                          
                                         
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