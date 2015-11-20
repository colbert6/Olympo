$(document).ready(function() {    
      
    $( "#save" ).click(function(){
        bval = true;   
        bval = bval && $("#id_proveedor").required();
        bval = bval && $("#razon_social").required();
        bval = bval && $("#ruc").required();
        bval = bval && $("#id_ubigeo").required();
        
        if (bval) 
        {
            $("#frm").submit();
        }
        return false;
    }); 
    $("#ruc").blur(function(){
        
        if($(this).val()!='' && $(this).val().length==11){
            $.post(url+'proveedor/buscador','ruc='+$("#ruc").val(),function(datos){
                if(datos.length>0 ){
                    if($("#id_proveedor").val()==datos[0].ID_PROVEEDOR){   
                        
                    }else{
                        alert("El RUC ya se encuentra Registrado");
                        $("#ruc").focus();
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