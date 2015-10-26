<div class="col-md-9">
    <?php if (isset($this->datos) && count($this->datos)){ ?>
                <div class="col-lg-12">
                    <h2 class="page-header">Categorias de Productos</h2>
                </div>

                <div class="row">
                    <?php for ($i = 0; $i < count($this->datos); $i++) {?>
                            <div class="col-md-3 col-sm-6">
                                <div class="thumbnail">
                                   <img src="<?php echo $_webParams['ruta_img']; ?>web/5.jpg" alt="">
                                   <div class="text-center">
                                       <h4>
                                           <a href="<?php echo BASE_URL."web/productos/".$this->datos[$i]['descripcion'];//."/". $this->datos[$i]['id_categoria_producto'];?>"><?php echo $this->datos[$i]['descripcion']; ?></a>
                                       </h4>
                                       <p>Para afianzarnos con nuestros clientes</p>
                                       <div class="ratings">
                                           <p class="text-center"><a href="<?php echo BASE_URL."web/productos/".$this->datos[$i]['descripcion'];//."/". $this->datos[$i]['id_categoria_producto'];?>" class="btn btn-success">Ver Productos</a></p>
                                       </div>
                                   </div>
                               </div>
                            </div>
                   <?php } ?>
                    </div> 
                 

     <?php }else{ ?>
            <div class="col-lg-12">
                <h4>No Hay Categoria de Productos</h4>
            </div>
    
      <?php }  ?>
    
</div>