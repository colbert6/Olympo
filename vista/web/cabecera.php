<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>OlympoGym</title>
    
    <link rel="shortcut icon" href="<?php echo $_webParams['ruta_img']; ?>olympo.png" />
    
    <!--Archivo CSS-->
    <link href="<?php echo $_webParams['ruta_css']; ?>bootstrap.css" rel="stylesheet">
    <link href="<?php echo $_webParams['ruta_css']; ?>shop-homepage.css" rel="stylesheet">
    <link href="<?php echo $_webParams['ruta_css']; ?>font-awesome.min.css" rel="stylesheet">
    <!--Archivo JS-->
    <script src="<?php echo $_webParams['ruta_js']; ?>jquery.js"></script>
    <script src="<?php echo $_webParams['ruta_js']; ?>jquery.slimscroll.js"></script>
    <script src="<?php echo $_webParams['ruta_js']; ?>extras/slimscroll.js"></script>
    <script src="<?php echo $_webParams['ruta_js']; ?>extras/menu_pegajoso.js"></script>
    <script src="<?php echo $_webParams['ruta_js']; ?>fastclick.min.js"></script>
    <script src="<?php echo $_webParams['ruta_js']; ?>bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL?>lib/js/validaciones.js"></script>
    <!--Facebook-->
    <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.4";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    
    <?php if(isset($_webParams['js']) && count($_webParams['js'])){ ?>
        <?php for($i=0; $i < count($_webParams['js']); $i++){ ?>

                    <script src="<?php echo $_webParams['js'][$i] ?>" type="text/javascript"></script>

        <?php } ?>
    <?php } ?>

    <?php if(isset($_webParams['css']) && count($_webParams['css'])){ ?>
        <?php for($i=0; $i < count($_webParams['css']); $i++){ ?>

           <link href="<?php echo $_webParams['css'][$i] ?>" type="text/css" rel="stylesheet" media="screen" />

        <?php } ?>
    <?php } ?>
    

</head>

<body>
    <div class="container" >
        <img class="img-responsive" src="<?php echo $_webParams['ruta_img']; ?>cabecera.png" alt="">
        <!-- Navigation -->
        <nav class="navbar navbar-default" >
            <div   id='div_pegajoso' >
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header" >
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo BASE_URL.'web' ; ?>">OLYMPOGYM</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul  class="nav navbar-nav">
                        <?php if(isset($_webParams['menu'])): ?>
                        <?php for($i = 0; $i < count($_webParams['menu']); $i++): ?>
                        <?php if($_webParams['menu'][$i]['id'] ==$item ){ 
                                    $_item_style = 'menu_activo'; 
                              } else {
                                    $_item_style = '';
                              }
                        ?>

                        <li><a class="<?php echo $_item_style; ?>" href="<?php echo $_webParams['menu'][$i]['enlace']; ?>"><?php  echo $_webParams['menu'][$i]['titulo']; ?></a></li>

                        <?php endfor; ?>
                        <?php endif; ?>
                        
                    <?php if(Session::get('autenticado')){ ?>
                        <li><a class="" href="<?php echo BASE_URL ?>inicio">SISTEMA</a></li>
                    </ul>
                    
                        <ul class="nav navbar-nav navbar-right">
                           <li>
                               <a href="<?php echo BASE_URL ?>login/cerrar" data-toggle="modal" data-target="#myModal">
                                   <span class="glyphicon glyphicon-log-in"></span> LOGOUT </a>
                           </li>
                        </ul>
                    
                    <?php }else {?>
                    </ul>
                        <ul class="nav navbar-nav navbar-right">
                           <li>
                               <a href="#" data-toggle="modal" data-target="#myModal">
                                   <span class="glyphicon glyphicon-log-in"></span> LOGIN  </a>
                           </li>
                        </ul>
                    
                    <?php }?>
                    
                    
                </div>
                <!-- /.navbar-collapse -->
            </div>
        </nav>
    </div>
    
<div class="container" style="padding-left:1%; padding-right:1%;" >
    <div class="row">