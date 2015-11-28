<div class="navbar-inner ">
    
    <div class="form-group">
        <label class="control-label col-sm-1" >Total:</label>
        <div class="col-sm-2">
            <input name="descripcion" id="descripcion" class="form-control"  placeholder="Descripcion" readonly
            maxlength="30"  value="<?php echo $this->datos[0]['MONTO']?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-1 col-sm-offset-1" >Pagado:</label>
        <div class="col-sm-2">
            <input name="descripcion" id="descripcion" class="form-control"  placeholder="Descripcion" readonly
            maxlength="30"  value="<?php 
                $pagado=0;
                for($i=0;$i<count($this->datos);$i++){
                    $pagado=$pagado+$this->datos[$i]['MONTO_PAGADO'];
                }
                echo $pagado;
            
            
            ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-1 col-sm-offset-1" >Restante:</label>
        <div class="col-sm-2">
            <input name="descripcion" id="descripcion" class="form-control"  placeholder="Descripcion" readonly
            maxlength="30"  value="<?php echo ($this->datos[0]['MONTO']-$pagado)?>">
        </div>
    </div>
    <br><br><hr>
    

<table id="table" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Nro Cuota</th>
        <th>Fecha de Cobro</th>
        <th>Monto de Cuota</th>
        <th>Monto Pagado</th>
        <th>Estado</th>
    </tr>
    </thead>
    <tbody>
    <?php for($i=0;$i<count($this->datos);$i++){ ?>
    <tr>
        <td><?php echo $this->datos[$i]['NUM_CUOTA']?></td>
        <td><?php echo $this->datos[$i]['FECHA']?></td>
        <td><?php echo $this->datos[$i]['MONTO_CUOTA']?></td>
        <td><?php echo $this->datos[$i]['MONTO_PAGADO']?></td>
        <td>
            <?php 
            if($this->datos[$i]['MONTO_CUOTA'] ==$this->datos[$i]['MONTO_PAGADO']){
                echo 'cancelado';
            }else{
                if(new DateTime($this->datos[$i]['FECHA'],new DateTimeZone('America/Lima'))>=new DateTime(date("M d Y"),new DateTimeZone('America/Lima')) && $this->datos[$i]['MONTO_CUOTA'] > $this->datos[$i]['MONTO_PAGADO']){
//                if(strtotime(str_replace('/', '-', $this->datos[$i]['FECHA']))>strtotime('now') && $this->datos[$i]['MONTO_CUOTA'] > $this->datos[$i]['MONTO_PAGADO']){
                    echo 'vigente';
                }else{
                    echo 'vencido';
                }
            }
            ?>
        </td>
    </tr>
    </tbody>
    <?php } ?>
</table>

<p>
    <a href="<?php echo BASE_URL?>cronograma_cobro" class="btn btn-primary">Volver</a></p>
<br/>
<hr>