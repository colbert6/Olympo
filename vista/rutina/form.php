<div class="navbar-inner">
  <?php $dias = array('LUNES','MARTES','MIERCOLES','JUEVES','VIERNES','SABADO');?>
    <div class="col-md-1"></div>
    <div class="col-md-9" style="color:#000">
    <form  role="form" id="frm" method="post" action="<?php echo $this->action; ?>">
        <input name="guardar" id="guardar" type="hidden" value="1">
        <input name="id_socio" id="id_socio" type="hidden" value="<?php echo $this->socio[0]["ID_SOCIO"];?>">
  
        <div class="row" >
            <div class="col-md-12">
                 <div class="form-group">

                        <label class="control-label" for="socio" >SOCIO:</label>
                          <input  name="socio" id="socio" class="form-control" readonly
                                value="<?php echo strtoupper($this->socio[0]['NOMBRE']." ".$this->socio[0]['APELLIDO_PATERNO']." ".$this->socio[0]['APELLIDO_MATERNO']); ?>">
                      </div>

            </div>
        </div>        

        <hr>
        <table class="table table-striped table-bordered table-hover sortable">
            <thead>
                <tr>
                    <th class='text-center'>#</th>
                    <th class='text-center'>Dia</th>
                    <th class='text-center'>Ejercicio</th>
                </tr>
            </thead>
            <tbody>
        <?php for ($i=0; $i < count($dias); $i++) {?>      
                  <tr>
                      <td class='text-center'>
                        <?php echo ($i + 1)?>
                        <input name="id_rutina[]" id="rutina" type="hidden" value="<?php 
                        if(isset($this->rutina)){ for ($l=0; $l<count($this->rutina) ; $l++) { 
                          if(strcmp($this->rutina[$l]["DIA"],$dias[$i]) == 0){ echo $this->rutina[$l]['ID_RUTINA']; break;
                          }else{echo "";}}
                        }else{echo "";}?>">
                      </td>
                      <td>
                        <input style="border:none;background:none " name="dia[]" id="dia" readonly value="<?php echo strtoupper($dias[$i]) ;?>">
                      </td>
                      <td  width='50'>
                            <a  data-toggle="modal" data-target="#modalEjercicio" href="javascript:void(0)" onclick="validaEjercicio('<?php echo $dias[$i] ?>')" class="btn btn-success"><i class="icon-list-alt icon-white"></i>&nbsp;&nbsp;&nbsp;Agregar Ejercicio &nbsp;</a>
                            

                      </td>
                  </tr>
                
        <?php }?>

        </tbody>
        </table>
        <div class="form-group" style="margin-top: 8%"> 
            <div class="col-sm-offset-3 col-sm-8">
            <a type="button" class="btn btn-primary" href="<?php echo BASE_URL?>socio">VOLVER</a>
                
            </div>
        </div>

    </form>
    </div>

<style type="text/css">
    #modalEjercicio .modal-content{
            width: 500px;
            left: 18%;
    }
</style>
<div id="modalEjercicio" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Asignar Categoria de Ejercicio</h3>
        </div>
        <div class="modal-body">
            <form id="btn-ejercicio">
                <div class="navbar-inner text-center">
                    <input type='hidden' name='dia' id='dia'>
                    <div id="grillaEjercicio">
                        <div class="page-header">
                            <img src="<?php echo BASE_URL ?>lib/img/loading.gif" />
                        </div>
                    </div>
                    
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Cerrar</button>
        </div>
        </div>
        </div>
    </div>