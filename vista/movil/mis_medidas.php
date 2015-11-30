<div class="container-fluid">
    
    <div class="row">
        <ol class="breadcrumb" >
            <li><a href="<?php echo BASE_URL."movil/sistema_movil/sistema/"; ?>">Inicio</a></li>
            <li class="active">Mis Medidas</li>
        </ol>
        <legend class='text-center'>Ultimo Triaje Realizado</legend>
        <table class="table table-striped table-bordered table-hover sortable">
            <thead>
                <tr >
                    <th>CONCEPTO TRIAJE</th>
                    <th>VALOR</th>
                </tr>

            </thead>
            <tbody>
                <?php for ($i=0; $i < count($this->concepto_triaje); $i++) { ?>
                    <tr>
                        <th><?php echo $this->concepto_triaje[$i]["DESCRIPCION"]?></th>
                        <td>
                            <?php for ($j=0; $j < count($this->utriaje) ; $j++) { 
                                     if($this->concepto_triaje[$i]['ID_CONCEPTO_TRIAJE'] == $this->utriaje[$j]['ID_CONCEPTO_TRIAJE']){
                                        echo  $this->utriaje[$j]["VALOR"]." ".$this->utriaje[$j]["UNIDAD_MEDIDA"];
                                     }else{
                                        echo "";
                                     }
                            }?>
                        </td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
        
 
    </div>
</div>