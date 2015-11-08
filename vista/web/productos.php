<div class="col-md-9">
    <?php if (!$this->informacion) { //saber si se ha pedido informacion de algun servicio?> 
    
            
        <?php if (isset($this->datos_producto) && count($this->datos_producto)){ ?>
                     
                    <div class="row">
                    <?php for ($i = 0; $i < count($this->datos_producto); $i++) {?>
                         <div class="col-sm-4 col-lg-4 col-md-4">
                                 <div class="thumbnail">
                                     <div class="hover-bg img-thumbnail">
                                         <div class="hover-text">
                                             <a> <h4 >Productos</h4>
                                             <h5><?php if(isset ($this->datos_producto[$i]['DESCRIPCION']))echo $this->datos_producto[$i]['DESCRIPCION']?></h5>
                                             <div class="clearfix"></div>
                                             </a>
                                         </div>    
                                         <img src="<?php echo $_webParams['ruta_img_pro']; ?><?php if(isset ($this->datos_producto[$i]['IMAGEN']))echo $this->datos_producto[$i]['IMAGEN']?>" alt=""> 
                                         <div class="caption">
                                           <h4><a href="#"><?php if(isset ($this->datos_producto[$i]['TITULO']))echo $this->datos_producto[$i]['TITULO']?></a></h4>  
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
    
        <?php }else{ ?> 
                
    
                 <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-12">
                                
                                <ol class="breadcrumb">

                                     <li><a href="<?php echo BASE_URL."web/productos/";?>">Productos</a>
                                    </li>
                                    <li class="active"><?php if(isset($this->categoria)) echo $this->categoria; ?></li>

                                </ol>
                            </div>

                        </div>

                    </div>
        <?php if (isset($this->datos) && count($this->datos)){?>
        <div class="row">
            
                      <?php          for ($i = 0; $i < count($this->datos); $i++) { ?>
            
            <div class="col-md-3 img-portfolio">
                <div class="thumbnail">
                <a href="#">
                    <img class="img-responsive img-hover" src="http://placehold.it/700x400" alt="">
                </a>
                <h4 class="text-center">
                    <a href="#"><?php echo $this->datos[$i]['nombre']; ?></a>
                </h4>
                <p class="text-center"> <strong>Precio:</strong><?php echo " ".$this->datos[$i]['precio']; ?></p>
                <p class="text-center"><strong>Stock:</strong><?php echo " ".$this->datos[$i]['stock']; ?></p>
                <div class="ratings">
                        <p class="text-center"><a href="<?php echo BASE_URL."web/productos/".$this->datos[$i]['descripcion']."/". $this->datos[$i]['id_categoria_producto'];?>" class="btn btn-warning">Ver Detalles</a></p>
                </div>
                </div>
            </div>
                <?php } ?>
           
             
        </div>
     <?php } else {?>
              <div class="col-lg-12">
                         <h4>No Hay Productos en esta Categoria</h4>
                    </div>
        <?php }?>

        
            <?php }?> 
</div>      