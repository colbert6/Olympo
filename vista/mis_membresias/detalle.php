<div class="navbar-inner">
    
    <div class="col-md-1"></div>
    <div class="col-md-10" style="color:#000">

       <legend><i>SOCIO</i></legend>
      
       <h4>NOMBRE &nbsp; &nbsp;&nbsp; : &nbsp;<?php echo $this->det_matricula[0]['NOMBRE'];?></h4>
       <h4>APELLIDO &nbsp;&nbsp; : &nbsp;<?php echo $this->det_matricula[0]['APELLIDO_PATERNO']." ".$this->det_matricula[0]['APELLIDO_MATERNO'];?></h4>
       <h4>DNI &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : &nbsp;<?php echo $this->det_matricula[0]['DNI'];?></h4>
       <br>
       <legend><i>MEMBRESIA</i></legend>
       <h4>NOMBRE &nbsp; &nbsp;&nbsp; : &nbsp;<?php echo $this->det_matricula[0]['DESCRIPCION'];?></h4>
       <h4>VIGENCIA &nbsp;&nbsp; : &nbsp;<?php echo $this->det_matricula[0]['DURACION']." ".$this->det_matricula[0]['VIGENCIA'];?></h4>
       <h4>INICIO &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: &nbsp;<?php echo $this->det_matricula[0]['FECHA_INICIO'];?></h4>
       <h4>FIN &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;: &nbsp;<?php echo $this->det_matricula[0]['FECHA_FIN'];?></h4>
       <h4>PRECIO &nbsp; &nbsp; &nbsp;&nbsp;: &nbsp;<?php echo $this->det_matricula[0]['COSTO'];?></h4>
       <br>
       <legend><i>SERVICIOS</i></legend>
       <?php if (isset ($this->serv_x_matricula) && count($this->serv_x_matricula)){?>
       			<table class='table table-striped table-bordered table-hover sortable'>
       				<thead>
       					<tr>
       						<th class='text-center'>#</th>
       						<th class='text-center'>SERVICIO</th>
       						<th class='text-center'>DESCRIPCION</th>
       					</tr>
       				</thead>
       				<tbody>
       				<?php for ($j=0; $j < count($this->serv_x_matricula); $j++){?>
            				<tr>
       							<td class='text-center'><?php echo ($j+1);?></td>
       							<td class='text-center'><?php echo $this->serv_x_matricula[$j]["SERVICIO"];?></td>
       							<td class='text-center'><?php echo $this->serv_x_matricula[$j]["DESCRIPCION"];?></td>
       						</tr>
                    <?php }?>
       				</tbody>
       			</table>

       <?php }else{
       			echo "<h3>NO HAY SERVICIOS</h3>";
       }?>
        
        
    </div>