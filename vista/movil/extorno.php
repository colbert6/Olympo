<script type="text/javascript"  src="<?php echo BASE_URL."vista/movil/js/funcion.js"?>"></script>
<div class="container-fluid">
    
    <div class="row">
        <ol class="breadcrumb" >
            <li><a href="<?php echo BASE_URL."movil/sistema_movil/sistema/"; ?>">Inicio</a></li>
            <li class="active">Extorno</li>
        </ol>
        <form id="frm" class="form-horizontal" role="form" action='<?php echo $this->action;?>' method='POST'>

            <div  class="input-group" style='width:87%; margin:0 auto;'>
                        <span class="input-group-addon">ID: </span>
                        <input id="buscar_id" type="number" class="form-control" name="buscar_id" value="" placeholder="Digite ID" required>

            </div>
                                
                            
            <div style="margin-top:10px" class="form-group">
                <!-- Button -->

                <div class="col-sm-12 controls text-center">
                  <button type='button' id='save' onclick="return extraerDatos('<?php echo BASE_URL; ?>')" class="btn btn-success">Buscar</button>
                
                </div>
            </div>
        </form>  
        <div id='datos'  >
        </div>
    </div>
</div>