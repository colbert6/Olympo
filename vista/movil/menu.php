<div class="sb-slidebar sb-left">
    <nav>
        <ul class="sb-menu">
            <li><img src="<?php echo $_movilParams['ruta_img']; ?>logo_menu.png" alt="Slidebars" width="170"></li>
            <?php if(isset($_movilParams["menu"])){?>
            <?php for ($i=0; $i < count($_movilParams["menu"]) ; $i++) { ?>
            <?php if($_movilParams['menu'][$i]['id'] ==$item ){ $seleccion="color:orange;";}else{$seleccion="";}?>
                        <li class="sb-close"  ><a style='<?php echo $seleccion; ?>' href="<?php echo $_movilParams["menu"][$i]["enlace"]; ?>"><?php echo $_movilParams["menu"][$i]["titulo"]; ?></a></li>
            <?php }?>
            <?php }?>
                          
        </ul>
    </nav>
</div><!-- /.sb-left -->

<div id="sb-site">