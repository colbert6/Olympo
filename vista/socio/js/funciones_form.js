$(function() {    
    $( "#save" ).click(function(){
        bval = true;   
        bval = bval && $("#descripcion").required();
        
        if (bval) 
        {
            $("#frm").submit();
        }
        return false;
    }); 
    $('#region').change(function(){
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
    });
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