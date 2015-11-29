$(document).ready(function() {   
    
    var nueva_fecha = new Date();
    var month =  parseInt(nueva_fecha.getMonth());
    var day = parseInt(nueva_fecha.getDate())-1;
    var year = parseInt(nueva_fecha.getFullYear());
    $( "#fecha_nacimiento" ).datepicker({
        changeYear: true,
        changeMonth: true,
        dateFormat: 'yy-mm-dd'}); 
    $('#fecha_nacimiento').datepicker('option', 'maxDate', new Date(year, month, day)); //Ejemplo

    $( "#save" ).click(function(){


        bval = true;
        bval = bval && $("#id_categoria_empleado").required();
        bval = bval && $("#estado_civil").required();
        bval = bval && $("#nombre").required();
        bval = bval && $("#apellido_paterno").required();
        bval = bval && $("#apellido_materno").required();
        bval = bval && $("#dni").required();
        bval = bval && $("#email").email();
        bval = bval && $("#sexo").required();
        bval = bval && $("#direccion").required();
        bval = bval && $("#fecha_nacimiento").required();
        
        
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
                        bootbox.confirm("El DNI ya se encuentra registrado. ", function(result) {
                                if (result) {
                                    $("#dni").focus();
                                }else{
                                    $("#dni").focus();
                                }
                        });
                    }
                    
                }
            },'json');
        }else if($(this).val().length<8){
            bootbox.confirm("DNI invalido,por ser menor de 8 digitos.  ", function(result) {
                    if (result) {
                        $("#dni").focus();
                    }else{
                        $("#dni").focus();
                    }
            });
        }
    });
    
 
});