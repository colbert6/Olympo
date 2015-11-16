<div class="navbar-inner">
    
    <div class="col-md-3"></div>
    <div class="col-md-5" style="color:#000">
    <form role="form" id="frm" method="post" action="<?php echo $this->action; ?>">
        <input name="guardar" id="guardar" type="hidden" value="1">

        <div class="form-group">
            <label class="control-label" >Tipo Movimiento</label>
                <select class="form-control" name='id_tipo_movimiento' id='id_tipo_movimiento'>
                    <option value='' ></option>
                    <?php for($i=0;$i<count($this->tipo_movimiento);$i++){ //Aca va la lista de los modulos padres ?> 
                         <option value="<?php echo $this->tipo_movimiento[$i]['ID_TIPO_MOVIMIENTO'];?>"><?php echo $this->tipo_movimiento[$i]['DESCRIPCION']?></option>
                    <?php } ?>
                </select>
        </div>
        <div class="form-group">
            <label class="control-label" >Concepto Movimiento:</label>
           
                <select class="form-control" name='id_concepto_movimiento' id='id_concepto_movimiento'>
                    <option value='' ></option>
                </select>
   
        </div>
        <div class="form-group">
            <label class="control-label" >Forma de Pago:</label>
           
                <select class="form-control" name='id_forma_pago' id='id_forma_pago'>
                    <option value=''></option>
                    <!--option value='1'>Efectivo</option>
                    <option value='2'>Tarjeta</option-->
                </select>
   
        </div>
        <div class="form-group">
            <label class="control-label" >Descripcion:</label>
          
            <textarea name="descripcion" id="descripcion" class="form-control"  rows="4" ></textarea>
     
        </div>
       <div class="form-group">
            <label class="control-label" >Monto:</label>
            <input name="monto" id="monto" onkeypress="return dosDecimales(event,this)" class="form-control"  placeholder="Monto" />
        <div class="form-group" style="margin-top: 8%"> 
            
            <button type="button" class="btn btn-primary" id="save"> Guardar</button>
                <a style='margin-left:8%' href="<?php echo BASE_URL?>ejercicio"  class="btn btn-danger">Cancelar</a>
            
        </div>

    </form>
    </div>