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
                        <img class='img-responsive' src="<?php echo $_movilParams['ruta_img']."web/".$this->publicidad[$i]['IMAGEN'];  ?>" alt="">
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
                        <div class="panel-body ">
                            <h4><?php echo $this->inicio[$i]['TITULO'];?></h4>
                            <a href="#" class="btn btn-warning">Ver Mas</a>
                        </div>
                    </div>
                </div>

            <?php } ?> 
        <?php } ?> 
        <!--div class="col-xs-6 col-sm-6">
            <div class="panel panel-default text-center">
                <div class="panel-heading">
                    <span class="fa-stack fa-3x">
                          <i class="fa fa-circle fa-stack-2x text-primary"></i>
                          <i class="fa fa-car fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="panel-body">
                    <h4>Service Two</h4>
                    <a href="#" class="btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6">
            <div class="panel panel-default text-center">
                <div class="panel-heading">
                    <span class="fa-stack fa-3x">
                          <i class="fa fa-circle fa-stack-2x text-primary"></i>
                          <i class="fa fa-support fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="panel-body ">
                    <h4>Service Three</h4>
                    <a href="#" class="btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6">
            <div class="panel panel-default text-center">
                <div class="panel-heading">
                    <span class="fa-stack fa-3x">
                          <i class="fa fa-circle fa-stack-2x text-primary"></i>
                          <i class="fa fa-database fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="panel-body">
                    <h4>Service Four</h4>
                    <a href="#" class="btn btn-primary">Learn More</a>
                </div>
            </div>
        </div-->
    </div>

</div>