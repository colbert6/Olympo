

<div class="col-md-12">
    
        <?php if (isset($this->datos_servicio) && count($this->datos_servicio)) {?>
                                
            
        <div class="col-md-12">
        
        <?php if (!$this->informacion) { //saber si se ha pedido informacion de algun servicio?> 
                       
                 
        <?php  for ($i = 0; $i < count($this->datos_servicio); $i++) { ?>

        <div class="col-md-4">
            
                                 <div class="">
                                     <div class="" >

                                         <div class="text-center " >
                                             <div class="sombra" > 
                                              <div class="text-justify" >
                                                <img class="img-circle img-thumbnail text-cente sombra-img" src="<?php echo $_webParams['ruta_img_ser']; ?><?php if(isset ($this->datos_servicio[$i]['IMAGEN']))echo $this->datos_servicio[$i]['IMAGEN']?>" alt="">
                                                <h4 class="text-center sombra-titulo">
                                           <?php if(isset ($this->datos_servicio[$i]['TITULO']))echo $this->datos_servicio[$i]['TITULO']?></h4>
                                             <h5 class="descripcion"><?php if(isset ($this->datos_servicio[$i]['DESCRIPCION']))echo $this->datos_servicio[$i]['DESCRIPCION']?></h5>
                                             <div class="clearfix"></div>
                                             </div>
                                             </div>
                                         </div>    
                                          
                                         
                                     </div>
                                 </div>
            </div>
               
               <!-- <div class="row well well-sm"  style="margin-top:10px; ">
                        <div class="col-sm-4 col-lg-3 col-md-4">
                            <img class="img-thumbnail"src="<?php echo $_webParams['ruta_img_ser']; ?><?php if(isset ($this->datos_servicio[$i]['IMAGEN']))echo $this->datos_servicio[$i]['IMAGEN']?>"  alt="">
                        </div>
                    <div class="col-md-8">
                        <div class="row text-center">
                            <h3 style="font-family: 'Lobster, cursive';font-size: 25px;    font-weight: 500;
                                    margin: 0.67em 0;animation-name: zoomIn;
                                color: #0C9CF2;"><?php if(isset ($this->datos_servicio[$i]['TITULO']))echo $this->datos_servicio[$i]['TITULO']?>
                            </h3>
                        </div>
                        <div class="row">
                                <p class="text-justify" style="margin-left:80px;">
                                <?php if(isset ($this->datos_servicio[$i]['DESCRIPCION']))echo $this->datos_servicio[$i]['DESCRIPCION']?>
                                </p>
                        </div>
                    </div>

                </div>-->


         <?php /*?>        
                <div class="row">
                    <div class="row carousel-holder">
                        
                    
                        
                        <div id="<?php echo "carousel-".$this->datos_servicio[$i]['nombre']; ?>" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                            <?php for ($j = 0; $j < count($this->img_servicio); $j++): ?>
                                
                           
                            <li data-target="<?php echo "#carousel-".$this->datos_servicio[$i]['nombre']; ?>" data-slide-to="<?php echo $j ?>" class=" <?php  if($j==0) echo "active"; ?>"></li>    
                            
                            <?php endfor;     ?>
                            
                            </ol>
                           
                            <div class="carousel-inner">
                            <?php for ($j = 0; $j < count($this->img_servicio); $j++) { ?>
                            <?php  if($this->datos_servicio[$i]['id_servicio']==$this->img_servicio[$j]['id_servicio']) { ?>
                            <?php  if($j==0){ echo "<div class='item active'>"; }
                                   else {echo "<div class='item'>";} ?>
                                
                                            <img class="slide-image" src="<?php echo $_webParams['ruta_img']."servicio/".$this->img_servicio[$j]['direccion']; ?>" alt="">
                                        </div>   
                            <?php   } //verificar ?>     
                            <?php }  //    ?> 
                                
                            </div>
                            <div class="carousel-caption">
                                <a class="link-servicios" href="<?php echo BASE_URL.'web/servicios/'.$this->datos_servicio[$i]['nombre']; ?>" ><?php echo $this->datos_servicio[$i]['nombre']; ?></a>
                            </div>
                               
                            <a class="left carousel-control" href="<?php echo "#carousel-".$this->datos_servicio[$i]['nombre']; ?>" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="<?php echo "#carousel-".$this->datos_servicio[$i]['nombre']; ?>" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                            
                        </div>   
                    </div>
                </div>
          <?php */ ?> 
          
        <?php }  //lista de Servicios   ?>
        <?php }else { //saber si se ha pedido informacion de algun servicio
                $flag_servicio_informacion=false;
                for ($i = 0; $i < count($this->datos_servicio); $i++) {
                    if($this->informacion==$this->datos_servicio[$i]['nombre']){ 
                        $i=$i;
                        $flag_servicio_informacion=true;
                        break;
                    }
                    
                }    
                if($flag_servicio_informacion){ ?>
                 <!--<div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-12">
                                <ol class="breadcrumb">

                                    <li><a href="<?php echo BASE_URL."web/servicios/";?>">Servicios</a>
                                    </li>
                                    <li class="active"><?php if(isset($this->datos_servicio[$i]['nombre'])){ echo $this->datos_servicio[$i]['nombre'];} ?></li>

                                </ol>
                            </div>

                        </div>

                    </div>    -->   
                        
                
               
        <?php   }else{
                    echo "<h1>No existe el servicio solicitado</h1>";
            
                }    
                
                } //acaba el else if(!$this->informacion) ?>
            
                
                        
                 
        <?php } else echo "<h1>No hay Servicios Disponibles</h1>"; ?>
     
        </div>
  
     </div>