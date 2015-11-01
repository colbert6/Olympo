$(document).ready(function() {   
    $( "#fecha_nacimiento" ).datepicker({changeMonth: true,changeYear: true,dateFormat: 'yy-mm-dd',yearRange: '-100:+0'}); 
    $( "#save" ).click(function(){
        bval = true;   
        bval = bval && $("#nombre").required();
        bval = bval && $("#apellido_paterno").required();
        bval = bval && $("#apellido_materno").required();
        bval = bval && $("#id_tipo_socio").required();
        bval = bval && $("#dni").required();
        bval = bval && $("#region").required();
        bval = bval && $("#provincia").required();
        bval = bval && $("#id_ubigeo").required();
        bval = bval && $("#direccion").required();
        bval = bval && $("#sexo").required();
        bval = bval && $("#estado_civil").required();
        bval = bval && $("#telefono").required();
        bval = bval && $("#celular").required();
        bval = bval && $("#fecha_nacimiento").required();
        
        
        if (bval) 
        {
            $("#frm").submit();
        }
        return false;
    }); 

    $("#dni").blur(function(){
        if($(this).val()!='' && $(this).val().length==8){
            $.post(url+'socio/buscador','dni='+$("#dni").val(),function(datos){
                if(datos.length>0 ){
                    if($("#id_socio").val()==datos[0].ID_SOCIO){   
                        
                    }else{
                        alert("El DNI ya se encuentra Registrado");
                        $("#dni").focus();
                    }
                    
                }
            },'json');
        }
    });
    $('#region').change(function(){
        $("#provincia").html('<option>Selecciona...</option>');
        $("#distrito").html('<option>Selecciona...</option>');

        $.get(url+'socio/get_provincias',{codigo_region:$('#region').val()},function(response){
            console.log(response);
            for (var i = 0; i < response.length; i++) {
                $("#provincia").append(new Option(response[i].DESCRIPCION,response[i].CODIGO_PROVINCIA));
            }
        },'json');
    });
    $('#provincia').change(function(){
        $("#id_ubigeo").html('<option>Selecciona...</option>');
        $.get(url+'socio/get_ciudades',{codigo_region:$('#region option:selected').val(),codigo_provincia:$('#provincia option:selected').val()},function(datos){
            for (var i = 0; i < datos.length; i++) {
                $("#id_ubigeo").append(new Option(datos[i].DESCRIPCION,datos[i].IDUBIGEO));
            };
        },'json');
    });



    
});