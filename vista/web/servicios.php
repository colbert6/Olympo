

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