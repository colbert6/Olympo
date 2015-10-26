        
  
        
             
        </div><!-- row-->
   </div><!-- /.container -->

        
     
        <div class="container">

            <div align="center" id="footer" style="padding-top: 10px">
                    <div class="col-md-6">

                        <a href="https://www.facebook.com/OlympoFitness?fref=ts" target="_blank"><img alt="siguenos en facebook" height="40" 
                        src="<?php echo $_webParams['ruta_img']; ?>facebook.png" title="siguenos en facebook" width="40" /></a>
                        <a href="https://twitter.com/" target="_blank"><img alt="siguenos en Twitter" height="40" 
                        src="<?php echo $_webParams['ruta_img']; ?>twiter.png" title="siguenos en Twitter" width="40" /></a>

                    </div>
                    <div id="txtFooter">
                           <p>Copyright &copy; OLYMPO FITNNES 2014</p>
                    </div>
                </div>
        </div>

   <!-- Modal -->
                
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Iniciar Sesión</h4>
                        </div>

                            <div class="modal-body">
                                <form action="<?php echo BASE_URL ?>login" method="post" id="loginForm">
                                     <input type="hidden" value="1" name="enviar" />
                                  <div class="form-group has-feedback">
                                    <input type="text" class="form-control" required placeholder="Usuario" name="usuario">
                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                  </div>
                                  <div class="form-group has-feedback">
                                    <input type="password" class="form-control" required placeholder="Contraseña"  name="clave" >
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                      <button type="submit" class="btn btn-primary">Entrar</button>
                                  </div>
                                </form>  
                      </div>
                    </div>
                 </div>
            
    </body>
</html>
    

