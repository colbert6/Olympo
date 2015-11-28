<div class='container-fluid'>
	<div class='row' >
		<ol class="breadcrumb" >
            <li><a href="<?php echo $_movilParams['menu'][0]['enlace']?>">Inicio</a></li>
            <li class="active">Login</li>
        </ol>
		 <div style="width:80%;margin:0 auto;margin-top:30px;" > 
		<div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">INICIAR SESION</div>
                    </div>     
                    
                    <div style="padding-top:30px" class="panel-body" >
                        <form id="loginform" class="form-horizontal" role="form" action='controlador/login_controlador.php' method='POST'>
                            
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="nick" value="" placeholder="Usuario" required>                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="password" placeholder="Contraseña" required>
                                    </div>

                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls text-center">
                                      <button id="btn-login" type='submit' class="btn btn-success">Login</button>
                                    
                                    </div>
                                </div>
                            </form>     
                        </div>                     
                    </div>
                </div>
	</div>
</div>