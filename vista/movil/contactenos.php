<div class='container-fluid'>
	<div class='row'>
		<h3 class="text-left text-center" style="font-family: 'Lobster, cursive';font-size: 26px;    font-weight: 500;
	            line-height: 1.1;    margin: 0.67em 0;animation-name: zoomIn;
	            color: #0C9CF2;">
	        <span class="glyphicon glyphicon-list-alt"></span> 
	        Contactenos
	    </h3>

		<form id="formu" action="<?php echo BASE_URL ?>movil/contactenos" method="post">
		 <!-- formulario -->
		 
                            <fieldset>
                              <input type="hidden" name="guardar" id="guardar" value="1"/>
                                <div class="col-xs-12 form-group">
                                    <label for="nombre" class="control-label">Nombres:<span>*</span></label>
                                    <input type="text" onKeyPress="return soloLetras(event);" id="nombre" class="form-control input-sm" name="nombre" placeholder="nombre" required>
                                </div>
                                <div class="col-xs-12 form-group">
                                    <label for="telefono" class="control-label">Teléfono:</label>
                                    <input type="tel" onkeypress="return soloNumeros(event)" id="telefono" class="form-control input-sm" name="telefono" placeholder="Telefono" required>
                                </div>
                                <div class="col-xs-12 form-group">
                                    <label for="email" class="control-label">Correo electrónico:<span>*</span></label>
                                    <input type="email" id="email" class="form-control input-sm" placeholder="email@hotmail.com" name="email" required>
                                </div>
                                <input type="hidden" name="pagina" value="Situación">
                                <div class="col-xs-12 form-group">
                                    <label class="control-label">Asunto:<span>*</span></label>
                                    <textarea name="mensaje" class="form-control input-sm" rows="7" cols="32" maxlength="300" placeholder="Escriba su mensaje..." required></textarea>
                                </div>
                                <div class="col-xs-6 form-group">
                                    <input type="submit" name="Enviar" class="btn btn-info btn-sm">
                                    <input type="reset" name="Borrar" class="btn btn-danger btn-sm">
                                </div>
                                <div class="col-xs-6 form-group">
                                    * Campos obligatorios.</a><br>
                                </div>
                            </fieldset>
                        </form> <!-- Fin formulario -->

          
	</div>
	<div class='row'>
		<h3 class="text-left text-center" style="font-family: 'Lobster, cursive';font-size: 26px;    font-weight: 500;
                                          line-height: 1.1;    margin: 0.67em 0;animation-name: zoomIn;
                                          color: #0C9CF2;">
                                                <span class="glyphicon glyphicon glyphicon-user"></span> 
                                                Mapa de situación
                                  </h3>

       <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7928.577112153539!2d-
                                     76.3594834!3d-6.4850947!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91ba0c07765eff75%3A
                                     0xdb6f16d92c725847!2sJiron+San+Martin+422%2C+Tarapoto%2C+Per%C3%BA!5e0!3m2!1ses!
                                     2s!4v1443068297596" width="100%" height="300px" frameborder="0" scrolling="no" ></iframe>

       <p>
       	<img src="<?php echo $_movilParams['ruta_img_web']; ?>olympo.png" alt=""> &nbsp;&nbsp;
       	<?php if(isset ($this->datos[0]['RAZON_SOCIAL']))echo $this->datos[0]['RAZON_SOCIAL']?>
       </P>                              
       
     
      <p>
      	<i class="glyphicon glyphicon-map-marker"></i>&nbsp;&nbsp;
     	<?php if(isset ($this->datos[0]['DIRECCION']))echo $this->datos[0]['DIRECCION']?>
     </p>
      <p>
      	<i class="glyphicon glyphicon-earphone"></i>&nbsp;&nbsp;
      <?php if(isset ($this->datos[0]['TELEFONO']))echo $this->datos[0]['TELEFONO']?>&nbsp;&nbsp;
      <?php if(isset ($this->datos[0]['CELULAR']))echo $this->datos[0]['CELULAR']?>
      </p>
     


	</div>
</div>