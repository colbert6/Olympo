<div class="navbar-inner">
  <?php $hoy=  date("Y")."-".date("m")."-".date("d");?>
    <div class="col-md-1"></div>
    <div class="col-md-9" style="color:#000">
    <form  role="form" id="frm" method="post" action="<?php echo $this->action; ?>">
        <input name="guardar" id="guardar" type="hidden" value="1">
        <input name="id_socio" id="id_socio" type="hidden" value="<?php echo $this->socio[0]["ID_SOCIO"];?>">
  
        <div class="row" >
            <div class="col-md-8">
                 <div class="form-group">

                        <label class="control-label" for="socio" >SOCIO:</label>
                          <input  name="socio" id="socio" class="form-control" readonly
                                value="<?php echo strtoupper($this->socio[0]['NOMBRE']." ".$this->socio[0]['APELLIDO_PATERNO']." ".$this->socio[0]['APELLIDO_MATERNO']); ?>">
                      </div>

            </div>
            <div class="col-md-4">
                 <div class="form-group">

                        <label class="control-label" >FECHA:</label>
                          <input  name="fecha" id="fecha" class="form-control" readonly
                                value="<?php if(isset($this->utriaje[0]["FECHA"])){ echo $this->utriaje[0]["FECHA"];}else{echo $hoy;} ?>">
                      </div>

            </div>
          
        </div>        

        <hr>
        <table class="table table-striped table-bordered table-hover sortable">
            <thead>
                <tr>
                    <th class='text-center'>#</th>
                    <th class='text-center'>Concepto Triaje</th>
                    <th class='text-center'>Valor</th>
                    <th class='text-center'>Medida</th>
                </tr>
            </thead>
            <tbody>
        <?php for ($i=0; $i < count($this->concepto_triaje); $i++) {?>      
                  <tr>
                      <td class='text-center'>
                        <?php echo ($i + 1)?>
                        <input name="id_triaje[]" id="id_triaje" type="hidden" value="<?php 
                        if(isset($this->utriaje)){ for ($j=0; $j<count($this->utriaje) ; $j++) { 
                          if($j==$i){ echo $this->utriaje[$j]['ID_TRIAJE']; break;
                          }else{echo "";}}
                        }else{echo "";}?>">
                      </td>
                      <td>
                        <input readonly name="id_concepto_triaje[]" id="id_concepto_triaje" type="hidden" value="<?php echo $this->concepto_triaje[$i]["ID_CONCEPTO_TRIAJE"];?>">
                        <label class="control-label" ><?php echo $this->concepto_triaje[$i]['DESCRIPCION']?>:</label>
                      </td>
                      <td width='100' >
                          <input onkeypress="return dosDecimales(event,this)" style="text-align:center" name="valor[]" id="valor" class="form-control" 
                        value="<?php 
                            if(isset($this->utriaje)){
                                for ($j=0; $j<count($this->utriaje) ; $j++) { 
                                  if($this->concepto_triaje[$i]['ID_CONCEPTO_TRIAJE'] == $this->utriaje[$j]['ID_CONCEPTO_TRIAJE']){
                                     echo $this->utriaje[$j]['VALOR'];
                                  }else{
                                     echo "";
                                  }
                                }
                            }else{
                              echo "";
                            }
                            
                        ?>">
                      </td>
                      <td  width='80'>
                          <!--input name="unidad_medida[]" id="unidad_medida" 
                            value="<?php 
                                if(isset($this->utriaje)){
                                  for ($j=0; $j<count($this->utriaje) ; $j++) { 
                                      if($this->concepto_triaje[$i]['ID_CONCEPTO_TRIAJE'] == $this->utriaje[$j]['ID_CONCEPTO_TRIAJE']){
                                         echo $this->utriaje[$j]['UNIDAD_MEDIDA'];
                                      }else{
                                         echo "";
                                      }
                                  }
                                }else{
                                  echo "";
                                }
                            ?>"-->
                            <?php $medida = array('m','cm',"kg");?>
                            <select name="unidad_medida[]" id="unidad_medida">
                                <option value="">Elije...</option>
                               <?php if(isset($this->utriaje)){ ?>
                               <?php    for ($j=0; $j<count($this->utriaje) ; $j++) {?>
                               <?php       if($this->concepto_triaje[$i]['ID_CONCEPTO_TRIAJE'] == $this->utriaje[$j]['ID_CONCEPTO_TRIAJE']){?>
                               <?php          for ($k=0; $k < count($medida); $k++){?>
                               <?php            if($this->utriaje[$j]['UNIDAD_MEDIDA'] == $medida[$k]){?>
                                                    <option selected value="<?php echo $medida[$k]; ?>"><?php echo $medida[$k]; ?></option>
                               <?php            }else{?>
                                                    <option value="<?php echo $medida[$k]; ?>"><?php echo $medida[$k]; ?></option>
                               <?php            }?>
                               <?php          }?>               
                               <?php       }?>
                               <?php    }?>
                               <?php }else{?>
                                        <option value="m">m</option>
                                        <option value="cm">cm</option>
                                        <option value="kg">kg</option>  
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