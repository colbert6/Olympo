</div>
    <div class="col-md-9">
        <div class="row carousel-holder">
            <div class="col-md-12">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="item active">
                            <img class="slide-image"  src="<?php echo $_webParams['ruta_img']; ?>img.jpg" alt="">
                        </div>
                        <div class="item">
                            <img class="slide-image " src="<?php echo $_webParams['ruta_img']; ?>3.jpg" alt="">
                        </div>
                        <div class="item">
                            <img class="slide-image " src="<?php echo $_webParams['ruta_img']; ?>2.png" alt="">
                        </div>
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-sm-4 col-lg-4 col-md-4">
            <div class="thumbnail">
                <div class="hover-bg img-thumbnail">
                    <div class="hover-text">
                        <a href="<?php echo BASE_URL.'productos' ; ?>"> <h4 >Productos</h4>
                        <h5>Ofrecemos productos pensado en sus objetivos, cardio,
                            tonificacion,etc. ademas de asesoria por expertos </h5>
                        <div class="clearfix"></div>
                        <i class="fa fa-plus"></i></a>
                    </div>    
                    <img src="<?php echo $_webParams['ruta_img']; ?>5.jpg" alt=""> 
                    <div class="caption">
                      <h4><a href="#">Productos</a></h4>  
                    </div>
                </div>
            </div>
        </div>
                        
        <div class="col-sm-4 col-lg-4 col-md-4">
            <div class="thumbnail">
               <div class="hover-bg img-thumbnail">
                <div class="hover-text">
                       <a href="<?php echo BASE_URL.'nosotros' ; ?>"> <h4>Quienes Somos</h4>
                        <h5><p class="text-center">
                                La familia <strong>Olimpo Ginevra & Company Fitness</strong> 
                                te da la bienvenida a nuestra página web y al mismo tiempo te 
                                invita a formar parte de nuestra gran familia.. </h5>
                        <div class="clearfix"></div>
                        <i class="fa fa-plus"></i></a>
                </div>    
                <img src="<?php echo $_webParams['ruta_img']; ?>9.jpg" alt=""> 
                <div class="caption">
                  <h4><a href="#">Quienes Somos</a></h4>  
                </div>
               </div>
            </div>
        </div>

        <div class="col-sm-4 col-lg-4 col-md-4">
            <div class="thumbnail">
               <div class="hover-bg img-thumbnail">
                <div class="hover-text">
                       <a href="<?php echo BASE_URL.'servicios' ; ?>"> <h4>Servicio</h4>
                        <h5>Ofrecemos servicios pensado en sus objetivos, cardio,
                            tonificacion,etc. ademas de asesoria por expertos </h5>
                        <div class="clearfix"></div>
                        <i class="fa fa-plus"></i></a>
                </div>    
                <img src="<?php echo $_webParams['ruta_img']; ?>image.jpg" alt=""> 
                <div class="caption">
                  <h4><a href="#">Servicios</a></h4>  
                </div>
               </div>
            </div>
        </div>
 
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12" >
                 
                <ul class="nav nav-tabs" >
                    <li class="active"><a data-toggle="tab" href="#bienvenida">BIENVENIDA</a></li>
                </ul>

                <div class="tab-content">
                    <div id="bienvenida" class="tab-pane fade in active">
                        <br>
                            <div class="media">
                                <a class="pull-left" href="#">
                                  <img class="img-thumbnail " src="<?php echo $_webParams['ruta_img']; ?>bienvenida.jpg" alt="">
                                </a>
                                <div class="media-body">
                                    <p class="text-justify">
                                        La familia <strong>Olimpo Ginevra & Company Fitness</strong> te da la bienvenida a nuestra página web 
                                        y al mismo tiempo te invita a formar parte de nuestra gran familia en donde te ayudaremos a cumplir 
                                        tus metas y objetivos para mejorar tu estilo de vida de forma sana haciendo lo que más nos gusta,
                                        <strong> ¡DEPORTE!</strong>.
                                    </p>
                                    <p class="text-justify">
                                        <strong>¡No lo pienses más!</strong> y únete a la familia <strong>Olimpo Ginevra & Company Fitness </strong>.
                                    </p>
                                    <p>
                                        <a type="button" class="btn btn-default btn-lg" href="<?php echo BASE_URL.'web/contactenos' ; ?>">
                                            <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Contactenos
                                        </a>
                                    </p>
                                </div>
                            </div>
                       <br>                                 
                    </div>
                </div>
            </div>
        </div>
    </div>

            
          
