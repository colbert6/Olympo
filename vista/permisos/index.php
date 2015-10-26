<script> url = <?php echo BASE_URL ?></script>

<div class="navbar-inner text-center">
<table align="center">
    <tr>
        <td><label>Perfil:</label></td>
        <td>
            <select required name="perfil" id="perfil">
                <option value="0">Seleccione...</option>
                <?php for($i=0;$i<count($this->datos_perfiles);$i++){ ?>
                    <option value="<?php echo $this->datos_perfiles[$i]['ID_PERFIL_USUARIO'] ?>"><?php echo $this->datos_perfiles[$i]['DESCRIPCION'] ?></option>
                <?php } ?>
            </select>
        </td>
        <td id="celda_aceptar">
            <a href="<?php echo BASE_URL?>permisos" class="btn btn-primary">Aceptar</a>
        </td>
    </tr>
</table>
 


<div id="div_modulos" align="left">
    <ul id='modulos'>
    <?php
        for($i=0;$i<count($this->datos_modulos);$i++){
            $idmodulo=$this->datos_modulos[$i]['ID_MODULO'];
            $idmodulo_padre=$this->datos_modulos[$i]['ID_PADRE'];
            $modulo=$this->datos_modulos[$i]['NOMBRE'];
            if($idmodulo_padre==0){
                echo "<li>".$modulo."<ul>";
                for($j=0;$j<count($this->datos_modulos);$j++){
                    if($this->datos_modulos[$j]['ID_PADRE']==$idmodulo){
                        $id=$this->datos_modulos[$j]['ID_MODULO'];
                        $descripcion=$this->datos_modulos[$j]['NOMBRE'];
                        echo "<li><label class='checkbox'><input type='checkbox' name='$id' id='$id'/>".$descripcion."</label></li>";
                    }
                }                
                echo "</ul></li>";
            }
        }
    ?>
    </ul>
</div>

