$(document).ready(function(){
    $("#perfil").focus();
    $("#div_modulos").hide();
    $("#celda_aceptar").hide();
    $("#perfil").change(function(){
        $(document).find(':checkbox').attr('checked',false);
        if($(this).val()==0){
            $("#div_modulos").hide("slow");
            $("#celda_aceptar").hide();
        }else{
            $.post(url+'permisos/get_permisos','id_perfil_usuario='+$(this).val(),function(datos){
                for(var i=0;i<datos.length;i++){
                    $("#"+datos[i].ID_MODULO).attr('checked','checked');
                }
                $("#celda_aceptar").show();
            },'json');
            $("#div_modulos").slideDown("slow");
        }            
    });
    
    $("input:checkbox").click(function(){
        if(this.checked){
            $.post(url+'permisos/inserta_permiso','id_perfil_usuario='+$("#perfil").val()+'&id_modulo='+$(this).attr('id'))
        }else{
            $.post(url+'permisos/elimina_permiso','id_perfil_usuario='+$("#perfil").val()+'&id_modulo='+$(this).attr('id'))
        }
    });
});