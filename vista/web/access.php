<h2>Acceso Restringido</h2>

<p>&nbsp;</p>

<a href="<?php echo BASE_URL; ?>">Ir al Inicio</a> | 
<a href="javascript:history.back(1)">Volver a la p&aacute;gina anterior</a>

<?php if(!Sesion::get('autenticado')): ?>

| <a href="#" data-toggle="modal" data-target="#myModal">Iniciar Sesi&oacute;n</a>

<?php endif; ?>
<p>&nbsp;</p>
