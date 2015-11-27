<div class="container-fluid">
        
    <div class="row">

        <div class="col-md-12">
            <?php if (isset($this->publicidad) && count($this->publicidad)){?>
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                <?php for($i = 0; $i < count($this->publicidad); $i++){ ?>
                <?php if($i==0){ $clase = "class='active'";}else{$clase = "";}?>
                    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i;?>" <?php echo $clase;?>></li>
                <?php } ?>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                <?php for($i = 0; $i < count($this->publicidad); $i++){ ?>
                <?php if($i==0){ $clase = "class='item active'";}else{$clase = "class='item'";}?>
                    <div <?php echo $clase; ?> >
                        <img class='img-responsive' src="<?php echo $_movilParams['ruta_img_web'].$this->publicidad[$i]['IMAGEN'];  ?>" alt="">
                    </div>
                <?php } ?>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
    <!-- /.row -->

    
    <!-- Service Panels -->
    <!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->
    <div class="row">
        <div class="col-lg-12">
            <hr>
        </div>
        <?php if (isset($this->inicio) && count($this->inicio)){ ?>
            <?php for($i = 0; $i < count($this->inicio); $i++){?> 
                <div class="col-xs-6 col-sm-6 " >
                    <div class="panel panel-default text-center">
                        <div class="hover-text">
                            <img class='img-responsive' src="<?php echo $_movilParams['ruta_img_web'].$this->inicio[$i]['IMAGEN'];  ?>" alt="">
                        </div>
                        <div class="panel-body">
                            <h4 style='font-family: fantasy'><?php echo $this->inicio[$i]['TITULO'];?></h4>
                            <a href="<?php if(isset ($this->inicio[$i]['URL']))echo BASE_URL."movil/".$this->inicio[$i]['URL'] ; ?>" class="btn btn-warning">Ver Mas</a>
                        </div>
                    </div>
                </div>

            <?php } ?>
                    <div class="col-xs-6 col-sm-6 " >
                        <div class="panel panel-default text-center">
                            <div class="hover-text text-center">
                                <img class='img-responsive' src="<?php echo $_movilParams['ruta_img_web']."eventos.png"  ?>" alt="">
                            </div>
                            <div class="panel-body">
                                <h4 style='font-family: fantasy'><?php echo "Eventos Importantes";?></h4>
                                <a href="<?php if(isset ($_movilParams['menu'][4]['enlace']))echo $_movilParams['menu'][4]['enlace'] ; ?>" class="btn btn-warning">Ver Mas</a>
                            </div>
                        </div>
                    </div>
            
        <?php } ?> 

    
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
                                  <img class="" src="<?php echo $_movilParams['ruta_img_web']; ?>bienvenida.jpg" alt="">
                                </a>

                                <div class="media-body">
                                    <p class="text-justify">
                                        <br>
                                        La familia <strong>Olimpo Ginevra & Company Fitness</strong> te da la bienvenida a nuestra página web 
                                        y al mismo tiempo te invita a formar parte de nuestra gran familia en donde te ayudaremos a cumplir 
                                        tus metas y objetivos para mejorar tu estilo de vida de forma sana haciendo lo que más nos gusta,
                                        <strong> ¡DEPORTE!</strong>.
                                    </p>
                                    <p class="text-justify">
                                        <strong>¡No lo pienses más!</strong> y únete a la familia <strong>Olimpo Ginevra & Company Fitness </strong>.
                                    </p>
                                    <p class='text-center'>
                                        <a type="button" class="btn btn-warning btn-lg" href="<?php echo BASE_URL.'movil/contactenos' ; ?>">
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

        <div class='row'>
            <div class="fb-page" data-href="https://www.facebook.com/OlympoFitness?ref=ts&amp;fref=ts"
                         data-small-header="false" data-adapt-container-width="true" data-hide-cover="false"
                        data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore">
                           <blockquote cite="https://www.facebook.com/OlympoFitness?ref=ts&amp;fref=ts">
                               <a href="https://www.facebook.com/OlympoFitness?ref=ts&amp;fref=ts">Olympo Fitness</a>
                           </blockquote></div>
                   </div>
        </div>

</div>