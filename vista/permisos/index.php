<script> url = <?php echo BASE_URL ?></script>


<div >
    <div class="row" align="center">
        <div class="col-md-3">
        <label label class="control-label col-sm-3" for="apellido_paterno">Perfil:</label>
        </div>
        <div class="col-md-3">
                <select required name="perfil" id="perfil">
                    <option value="0">Seleccione...</option>
                    <?php for($i=0;$i<count($this->datos_perfiles);$i++){ ?>
                        <option value="<?php echo $this->datos_perfiles[$i]['ID_PERFIL_USUARIO'] ?>"><?php echo $this->datos_perfiles[$i]['DESCRIPCION'] ?></option>
                    <?php } ?>
                </select>
        </div>
        <div class="col-md-3">
            <div id="celda_aceptar">
                <a href="<?php echo BASE_URL?>permisos" class="btn btn-success">Aceptar</a>
            </div>
        </div>
    
    </div>
 


<div class="row" id="div_modulos" >
    <div class='col-md-11' id='modulos'>
    <?php
        for($i=0;$i<count($this->datos_modulos);$i++){
            $idmodulo=$this->datos_modulos[$i]['ID_MODULO'];
            $idmodulo_padre=$this->datos_modulos[$i]['ID_PADRE'];
            $modulo=$this->datos_modulos[$i]['NOMBRE'];
            
            if($idmodulo_padre==0){
                echo '</br>';
                echo "<div class='row' ><h3 class='nombre_modulo'>".$modulo."</h3><ul class='list-inline'>";
                for($j=0;$j<count($this->datos_modulos);$j++){
                    if($this->datos_modulos[$j]['ID_PADRE']==$idmodulo){
                        $id=$this->datos_modulos[$j]['ID_MODULO'];
                        $descripcion=$this->datos_modulos[$j]['NOMBRE'];
                        echo "<li><label class='checkbox'><input type='checkbox' name='$id' id='$id'/>".$descripcion."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></li>";
                    }
                }                
                echo "</ul></div>";
            }
            
            
        }
    ?>
    </div>
</div>

