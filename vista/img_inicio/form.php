
<div class="navbar-inner">
<form method="post" action="<?php if(isset ($this->action))echo $this->action ?>" id="frm" enctype="multipart/form-data">
    <input type="hidden" name="guardar" id="guardar" value="1"/>
    <input type="hidden" name="id_imagen_inicio" id="id_imagen_inicio"
            value="<?php if(isset ($this->datos[0]['ID_IMAGEN_INICIO']))echo $this->datos[0]['ID_IMAGEN_INICIO'] ?>"/>
    <table align="center" cellpadding="10">
        <tr>
            <td><label>Titulo</label></td>
            <td>
                <input type="text" id="titulo" name="titulo" class="form-control" style="width: 300px"
                value="<?php if(isset ($this->datos[0]['TITULO']))echo $this->datos[0]['TITULO']?>"/>
            </td>
        </tr>

        
            
                <input type="hidden" id="url" name="url" class="form-control" style="width: 300px"
                value="<?php if(isset ($this->datos[0]['URL']))echo $this->datos[0]['URL']?>"/>
            
        

        <tr>             
                 <td><label  >Descripcion:</label></td>
                    <td>
                        <textarea  name="descripcion" id="descripcion" class="form-control" rows="6">
                            <?php if(isset ($this->datos[0]['DESCRIPCION']))echo $this->datos[0]['DESCRIPCION']?>
                        </textarea>
                    </td>
        </tr>
        
        <tr>
            <?php if(isset ($this->datos[0]['IMAGEN']) && $this->datos[0]['IMAGEN']!=''){?>
            <td><label>Imagen Subida</label></td>
            <td>
            <div id="imagen_subida" style="text-align: center">
                <img width="150px" height="100px" src="<?php echo BASE_URL ?>lib/img/web/<?php echo strtolower($this->datos[0]['IMAGEN']) ?>" />
                <br><br>
                <a href="javascript:void" onclick="cambiar_imagen()" class="btn btn-info">Cambiar de Imagen</a>
                <input type="hidden" value="123" id="imagen" />
                <input type="hidden" value="<?php echo $this->datos[0]['IMAGEN']?>" id="imagen_existe" name="imagen_existe" />
                <input type="hidden" value="0" id="modificar_imagen" name="modificar_imagen" />
            </div>
            </td>
            <?php }else{?>
            <td><label>Cargar Imagen</label></td>
            <td>
                <input id="archivo" name="archivo" type="file" style="display: none" />
                <div class="input-append">
                    <input id="imagen" class="form-control" type="text" disabled style="display: inline-block; width: 85%"/>
                    <a class="btn btn-info" onclick="$('input[id=archivo]').click();"><i class="icon-search"></i></a>
                </div>
            </td>
            <?php }?>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <p><button type="submit" class="btn btn-primary" id="save">Guardar</button>
                <a href="<?php echo BASE_URL ?>img_inicio" class="btn btn-info">Cancelar</a></p>
            </td>
        </tr>
    </table>
</form>
<div id="script">
<script>
$('input[id=archivo]').change(function(){
    $('#imagen').val($(this).val());
})
</script>
</div>