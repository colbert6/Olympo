<div class="container-fluid">
    
    <div class="row">
        <ol class="breadcrumb" >
            <li><a href="<?php echo BASE_URL."movil/sistema_movil/sistema/"; ?>">Inicio</a></li>
            <li><a href="<?php echo BASE_URL."movil/sistema_movil/mis_membresias/"; ?>">Mis Membresias</a></li>
            <li class="active">Detalle</li>
        </ol>
        
        <legend class='text-center'><i>SOCIO</i></legend>
      
       <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NOMBRE &nbsp; &nbsp;&nbsp; : &nbsp;<?php echo $this->det_matricula[0]['NOMBRE'];?></h5>
       <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;APELLIDO &nbsp;&nbsp; : &nbsp;<?php echo $this->det_matricula[0]['APELLIDO_PATERNO']." ".$this->det_matricula[0]['APELLIDO_MATERNO'];?></h5>
       <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DNI &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : &nbsp;<?php echo $this->det_matricula[0]['DNI'];?></h5>
       <br>
       <legend class='text-center'><i>MEMBRESIA</i></legend>
       <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NOMBRE &nbsp; &nbsp;&nbsp; : &nbsp;<?php echo $this->det_matricula[0]['DESCRIPCION'];?></h5>
       <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;VIGENCIA &nbsp;&nbsp; : &nbsp;<?php echo $this->det_matricula[0]['DURACION']." ".$this->det_matricula[0]['VIGENCIA'];?></h5>
       <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;INICIO &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: &nbsp;<?php echo $this->det_matricula[0]['FECHA_INICIO'];?></h5>
       <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FIN &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;: &nbsp;<?php echo $this->det_matricula[0]['FECHA_FIN'];?></h5>
       <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PRECIO &nbsp; &nbsp; &nbsp;&nbsp;: &nbsp;<?php echo $this->det_matricula[0]['COSTO'];?></h5>
       <br>
       <legend class='text-center'><i>SERVICIOS</i></legend>
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
</div>