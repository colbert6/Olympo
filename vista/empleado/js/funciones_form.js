$(document).ready(function() {   
    $( "#fecha_nacimiento" ).datepicker({changeMonth: true,changeYear: true,dateFormat: 'yy-mm-dd',yearRange: '-100:+0'}); 
    $( "#save" ).click(function(){
        bval = true;
        bval = bval && $("#id_categoria_empleado").required();   
        bval = bval && $("#nombre").required();
        bval = bval && $("#apellido_paterno").required();
        bval = bval && $("#apellido_materno").required();
        bval = bval && $("#dni").required();
        bval = bval && $("#email").required();
        bval = bval && $("#direccion").required();
        bval = bval && $("#sexo").required();
        bval = bval && $("#estado_civil").required();
        bval = bval && $("#fecha_nacimiento").required();
        bval = bval && $("#usuario").required();
        bval = bval && $("#clave").required();
        bval = bval && $("#id_perfil_usuario").required();
        
        if (bval) 
        {
            $("#frm").submit();
        }
        return false;
    }); 

    $("#dni").blur(function(){
        if($(this).val()!='' && $(this).val().length==8){
            $.post(url+'empleado/buscador','dni='+$("#dni").val(),function(datos){
                if(datos.length>0 ){
                    if($("#id_empleado").val()==datos[0].ID_EMPLEADO){   
                        
                    }else{
                        alert("El DNI ya se encuentra Registrado");
                        $("#dni").focus();
                    }
                    
                }
            },'json');
        }else if($(this).val().length<8){
            alert("El DNI tiene 8 numeros");
                        $("#dni").focus();
        }
    });
    /*$('#region').change(function(){
        $('#provincia,#distrito').empty();

        $.getJSON(url+'socio/get_provincias',{codigo_region:$('#region').val()},function(datos){
            for (var i = 0; i < 4; i++) {
                $("#provincia").append(new Option(datos[i].DESCRIPCION,datos[i].CODIGO_PROVINCIA));
            };
            alert( $('#region').val());
        });
    });
    $('#provincia').change(function(){
        $('#distrito').empty();
        $.getJSON(url+'socio/get_ciudades',{codigo_region:$('#region option:selected').val(),codigo_provincia:$('#provincia option:selected').val()},function(datos){
            for (var i = 0; i < datos.length; i++) {
                $("#distrito").append(new Option(datos[i].DESCRIPCION,datos[i].IDUBIGEO));
            };
        });
    });*/
    /*$("#region").change(function(){
        if(!$("#region").val()){
            $("#provincia").html('<option>Cargando...</option>');
            $("#distrito").html('<option>Cargando...</option>');
        }else{
            $("#provincia").html('<option>Cargando...</option>');
            $("#distrito").html('<option>Cargando...</option>');
            $.post(url+'socio/get_provincias','codigo_region='+$("#region").val(),function(datos){
            $("#provincia").html('<option>Seleccione..</option>');
            $("#distrito").html('<option>Seleccione..</option>');
                for(var i=0;i<datos.length;i++){
                    $("#provincia").append('<option value="'+ datos[i].CODIGO_PROVINCIA + '">' + datos[i].DESCRIPCION+ '</option>');
                }
            },'json');
        }
    });
    $("#provincia").change(function(){
        if(!$("#provincia").val()){
            $("#distrito").html('<option>Cargando...</option>');
        }else{
            alert($("#provincia").val()+" "+$("#region").val());
            $("#distrito").html('<option>Cargando...</option>');
            $.post(url+'socio/get_ciudades',{cod_re:$("#region").val(),cod_pr:$("#provincia").val()},function(datos){
            $("#distrito").html('<option>Seleccione..</option>');
                for(var i=0;i<datos.length;i++){
                    $("#distrito").append('<option value="'+ datos[i].IDUBIGEO + '">' + datos[i].DESCRIPCION+ '</option>');
                }
            },'json');
        }
    });*/



    
});