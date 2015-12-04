<div class="sb-slidebar sb-left">
    <nav>
        <ul class="sb-menu">
            <li><img src="<?php echo $_movilParams['ruta_img']; ?>logo_menu.png" alt="Slidebars" width="170"></li>
            
            <?php if (session::get('autenticado')) {?>
            <?php if (session::get('tipo_actor')=='e' && session::get('idperfil')=='1'){?>
            <!--EMPLEADO ADMIN-->
                <li class="sb-close"  ><a style='<?php echo $seleccion; ?>' href="<?php echo BASE_URL."movil/sistema_movil/sistema/"; ?>">INICIO</a></li>
                <li class="sb-close"  ><a style='<?php echo $seleccion; ?>' href="<?php echo BASE_URL."movil/sistema_movil/saldo_cajas/"; ?>">SALDOS CAJA</a></li>
            <?php }else if (session::get('tipo_actor')=='s' && session::get('idperfil')=='2'){ ?>              
            <!--SOCIO-->
                <li class="sb-close"  ><a style='<?php echo $seleccion; ?>' href="<?php echo BASE_URL."movil/sistema_movil/sistema/"; ?>">INICIO</a></li>
                <li class="sb-close"  ><a style='<?php echo $seleccion; ?>' href="<?php echo BASE_URL."movil/sistema_movil/reglamento/"; ?>">REGLAMENTO</a></li>
                <li class="sb-close"  ><a style='<?php echo $seleccion; ?>' href="<?php echo BASE_URL."movil/sistema_movil/mis_membresias/"; ?>">MIS MEMBRESIAS</a></li>
                <li class="sb-close"  ><a style='<?php echo $seleccion; ?>' href="<?php echo BASE_URL."movil/sistema_movil/mi_rutina/"; ?>">MI RUTINA</a></li>
                <li class="sb-close"  ><a style='<?php echo $seleccion; ?>' href="<?php echo BASE_URL."movil/sistema_movil/mis_medidas/"; ?>">MIS MEDIDAS</a></li>
                <li class="sb-close"  ><a style='<?php echo $seleccion; ?>' href="<?php echo BASE_URL."movil/sistema_movil/mis_eventos/"; ?>">MIS EVENTOS</a></li>
            <?php }else{?> 
            <!--CUALQUIER OTRO EMPLEADO-->

            <?php }?>   
            <li class="sb-close"  ><a style='<?php echo $seleccion; ?>' href="<?php echo BASE_URL ?>login/cerrar"; ?><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;CERRAR SESION</a></li>
            <?php }else{?>
            <?php if(isset($_movilParams["menu"])){?>
            <?php for ($i=0; $i < count($_movilParams["menu"]) ; $i++) { ?>
            <?php if($_movilParams['menu'][$i]['id'] ==$item ){ $seleccion="color:orange;";}else{$seleccion="";}?>
                        <li class="sb-close"  ><a style='<?php echo $seleccion; ?>' href="<?php echo $_movilParams["menu"][$i]["enlace"]; ?>"><?php echo $_movilParams["menu"][$i]["titulo"]; ?></a></li>
            <?php }?>
            <?php }?>
            <li class="sb-close"  ><a style='<?php echo $seleccion; ?>' href="<?php echo BASE_URL."movil/login/"; ?>">INICIAR SESION</a></li>   

            <?php }?>


        </ul>

    </nav>
</div><!-- /.sb-left -->

<div id="sb-site">