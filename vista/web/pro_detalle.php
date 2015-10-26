<div class="col-md-9">
    <?php if (isset($this->datos) && count($this->datos)){?>
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-12">
                    <ol class="breadcrumb">

                         <li><a href="<?php echo BASE_URL."web/productos/";?>">Productos</a>
                        </li>
                        <li ><a href="<?php echo BASE_URL."web/productos/".$this->categoria;?>"><?php if(isset($this->categoria)) echo $this->categoria; ?></a></li>
                        <li class="active"><?php echo $this->datos[0]['nombre']; ?></li>

                    </ol>
                </div>
            </div>
        </div>
    
        <div class="row">

                <div class="col-md-11">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                                    <div class="item active">
                                        <img class="slide-image" src="<?php echo $_webParams['ruta_img']; ?>web/1.png" alt="">

                                    </div>
                                    <div class="item">
                                        <img class="slide-image" src="<?php echo $_webParams['ruta_img']; ?>web/2.png" alt="">
                                    </div>
                                    <div class="item">
                                        <img class="slide-image" src="<?php echo $_webParams['ruta_img']; ?>web/3.jpg" alt="">
                                    </div>
                                </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                </div>

             

            </div>
    <div class="row">
                    <div class="col-md-12" >
                        <div class="bs-callout bs-callout-info">
                            <h3 style="text-transform: uppercase;" ></h3>
                            <p>El servicio de cardio ayuda a las personas con padecias en enfermedades cardio vasculares,
                                ademas de mejorar la presion sanguinea</p>
                        </div>
                        <div class="bs-callout bs-callout-primary">
                            <h3>HORARIOS</h3>
                           <p>LUNES MARTES MIERCOLES JUEVES VIERNES SABADO 
                           <br>
                           8:00 AM a 7:00 PM</p>
                        </div>
                        <div class="bs-callout bs-callout-warning">
                            <h3>CONSEJOS</h3>
                            <ul>
                                <li>Consumir Alimentos bajos en grasa</li>
                                <li>Practicar deporte</li>
                                <li>No consumir Bebidas Alcoholicas</li>
                            </ul>
                        </div>
                        
                    </div>
                </div> 
    <?php }else{ ?>
            <div class="col-lg-12">
                <h4>El producto no Existe</h4>
            </div>
    <?php } ?>
</div>