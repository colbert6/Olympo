<div class="navbar-inner">
     <script>
      $(function() {
        $( "#fecha_inicio" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
        $( "#fecha_fin" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
      });
  </script>
    <div class="col-md-2"></div>
    <div class="col-md-7" style="color:#000">
    <form class="form-horizontal" role="form" id="frm" method="post" action="<?php echo $this->action; ?>">
        <input name="guardar" id="guardar" type="hidden" value="1">
        
        <?php if(isset ($this->datos[0]['ID_EVENTO'])) {?>  
        <div class="form-group">
            <label class="control-label col-sm-6" >Item:</label>
            <div class="col-sm-6">
                <input name="id_evento" id="id_evento" class="form-control"  readonly="readonly"
                   value="<?php echo $this->datos[0]['ID_EVENTO'];?>">
            </div>
        </div>  
        <?php } ?>  
        
        <div class="form-group">
            <label class="control-label col-sm-6" >Cat. Evento:</label>
            <div class="col-sm-6">
                <select class="form-control" name='id_categoria_evento' id='id_categoria_evento'>
                    <option value='' >-Seleccione-</option>
                    <?php for($i=0;$i<count($this->categoria_evento);$i++){ //Aca va la lista de los modulos padres ?> 
                    <?php if( $this->datos[0]['ID_CATEGORIA_EVENTO']==$this->categoria_evento[$i]['ID_CATEGORIA_EVENTO']){?>
                         <option selected value="<?php echo $this->categoria_evento[$i]['ID_CATEGORIA_EVENTO'];?>"><?php echo $this->categoria_evento[$i]['DESCRIPCION']?></option>
                    <?php }else{?>
                         <option value="<?php echo $this->categoria_evento[$i]['ID_CATEGORIA_EVENTO'];?>"><?php echo $this->categoria_evento[$i]['DESCRIPCION']?></option>
                    <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
            
        <div class="form-group">
            <label class="control-label col-sm-6" >Nombre:</label>
            <div class="col-sm-6">
                <input name="nombre" id="nombre" class="form-control"  placeholder="Nombre" autofocus
                maxlength="50"  value="<?php if(isset ($this->datos[0]['NOMBRE']))echo $this->datos[0]['NOMBRE']?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-6" >Descripcion:</label>
            <div class="col-sm-6">
                <textarea name="descripcion" id="descripcion" class="form-control"  placeholder="Descripcion" autofocus
                maxlength="100" ><?php if(isset ($this->datos[0]['DESCRIPCION']))echo $this->datos[0]['DESCRIPCION']?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-6" >F. Inicio:</label>
            <div class="col-sm-6">
                <input readonly name="fecha_inicio" id="fecha_inicio" class="form-control"  placeholder="Fecha Inicio" autofocus
                  value="<?php if(isset ($this->datos[0]['FECHA_INICIO']))echo $this->datos[0]['FECHA_INICIO']?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-6" >F. Fin:</label>
            <div class="col-sm-6">
                <input readonly name="fecha_fin" id="fecha_fin" class="form-control"  placeholder="Fecha Fin" autofocus
                  value="<?php if(isset ($this->datos[0]['FECHA_FIN']))echo $this->datos[0]['FECHA_FIN']?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-6" >Lugar:</label>
            <div class="col-sm-6">
                <input name="lugar" id="lugar" class="form-control"  placeholder="Lugar" autofocus
                maxlength="50"  value="<?php if(isset ($this->datos[0]['LUGAR']))echo $this->datos[0]['LUGAR']?>">
            </div>
        </div>
       
        <div class="form-group" style="margin-top: 8%"> 
            <div class="col-sm-offset-3 col-sm-8">
            <button type="button" class="btn btn-primary" id="save"> Guardar</button>
                <a style="margin-left: 8%" href="<?php echo BASE_URL?>evento"  class="btn btn-danger">Cancelar</a>
            </div>
        </div>

    </form>
    </div>