<div class="container-fluid">
    <div class="row">
        <ol class="breadcrumb text-center" >
            <li><a href="#">Bienvenido, <strong><?php echo session::get('perfil')." - "; ?><?php if(session::get('tipo_actor')=='e'){echo session::get('empleado');}else{echo session::get('socio');} ?></strong></a></li>
        </ol>
        <?php if(session::get('tipo_actor')=='e' && session::get('idperfil')=='1'){?>
            
                <div class='col-xs-6'>
                    <a href="<?php echo BASE_URL."movil/sistema_movil/saldo_cajas" ?>" class="btn btn-warning btn-circle"><i class="fa fa-money"></i>&nbsp;&nbsp;Saldo en Caja</a>
                </div>
                <div class='col-xs-6'>
                    <a href="<?php echo BASE_URL."movil/sistema_movil/extorno/" ?>" class="btn btn-warning btn-circle"><i class="fa fa-reply"></i>&nbsp;&nbsp;Extornar</a>
                </div>
            
                <div class='col-xs-12'>
                    <br><a href="#" class="btn btn-warning btn-circle"><i class="fa fa-pie-chart"></i>&nbsp;&nbsp;Reportes</a>
                </div>
                

            
        
        <?php }else if(session::get('tipo_actor')=='s' && session::get('idperfil')=='2'){ ?>
                <div class='col-xs-12'>
                    <a href="<?php echo BASE_URL."movil/sistema_movil/mis_membresias/" ?>" class="btn btn-warning btn-circle"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Mis Membresias</a>
                </div>
                <div class='col-xs-6'>
                    <br><a href="<?php echo BASE_URL."movil/sistema_movil/reglamento/" ?>" class="btn btn-warning btn-circle"><i class="fa fa-bars"></i>&nbsp;&nbsp;Reglamento</a>
                </div>
                <div class='col-xs-6'>
                    <br><a href="<?php echo BASE_URL."movil/sistema_movil/mi_rutina/" ?>" class="btn btn-warning btn-circle"><i class="fa fa-user"></i>&nbsp;&nbsp;Mi Rutina</a>
                </div>
                <div class='col-xs-6'>
                    <br><a href="<?php echo BASE_URL."movil/sistema_movil/mis_medidas/" ?>" class="btn btn-warning btn-circle"><i class="fa fa-child"></i>&nbsp;&nbsp;Mis Medidas</a>
                </div>
                <div class='col-xs-6'>
                    <br><a href="<?php echo BASE_URL."movil/sistema_movil/mis_eventos/" ?>" class="btn btn-warning btn-circle"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Eventos</a>
                </div>
        <?php }else {?>
                <h4>NO TIENE FUNCIONES PERMITIDAS</h4>
        <?php } ?>
        <style type="text/css">
            .btn-circle {
              width: 100%;
              padding: 12px;
              font-size: 16px;
              text-align: center;
              border-radius: 15px;
            }
            
        </style>

        
    </div>
</div>
