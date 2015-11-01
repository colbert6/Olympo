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
                  
                            <?php $medida = array('m','cm',"kg");?>
                            <select name="id_categoria_ejercicio[]" id="id_categoria_ejercicio">
                                <?php if(isset($this->rutina)){?>
                                
                                <?php   for ($j=0; $j<count($this->rutina) ; $j++) {?>
                                
                                <?php       if(strcmp($this->rutina[$j]["DIA"],$dias[$i]) == 0) {?>
                                    
                                <?php           for ($k=0; $k<count($this->categoria_ejercicio) ; $k++) {?>
                                                                
                                <?php               if(strcmp($this->categoria_ejercicio[$k]["ID_CATEGORIA_EJERCICIO"],$this->rutina[$j]["ID_CATEGORIA_EJERCICIO"]) == 0){?>       
                                                        <option selected value="<?php echo $this->categoria_ejercicio[$k]["ID_CATEGORIA_EJERCICIO"]; ?>"><?php echo $this->categoria_ejercicio[$k]["DESCRIPCION"]; ?></option>              
                                <?php               }else{?>
                                                        <option value="<?php echo $this->categoria_ejercicio[$k]["ID_CATEGORIA_EJERCICIO"]; ?>"><?php echo $this->categoria_ejercicio[$k]["DESCRIPCION"]; ?></option> 
                                <?php               }?>
                                <?php           }?>
                                <?php       }?>
                                <?php   }?>
                                <?php }else{?>
                                <?php   for ($j=0; $j<count($this->categoria_ejercicio) ; $j++) {?>
                                            <option value="<?php echo $this->categoria_ejercicio[$j]["ID_CATEGORIA_EJERCICIO"]; ?>"><?php echo $this->categoria_ejercicio[$j]["DESCRIPCION"]; ?></option>              
                                <?php   }?>
                                <?php }?>
                            </select>

                      </td>
                  </tr>
                
        <?php }?>

        </tbody>
        </table>
        <div class="form-group" style="margin-top: 8%"> 
            <div class="col-sm-offset-3 col-sm-8">
            <button type="button" class="btn btn-primary" id="save"> Guardar</button>
                <a style="margin-left: 8%" href="<?php echo BASE_URL?>socio"  class="btn btn-danger">Cancelar</a>
            </div>
        </div>

    </form>
    </div>