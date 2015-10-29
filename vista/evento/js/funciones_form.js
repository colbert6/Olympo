$(function() {    
    $( "#fecha_inicio" ).datepicker({changeMonth: true,changeYear: true,dateFormat: 'yy-mm-dd'});
    $( "#fecha_fin" ).datepicker({changeMonth: true,changeYear: true,dateFormat: 'yy-mm-dd'});
    $( "#save" ).click(function(){
        bval = true;   
        bval = bval && $("#id_categoria_evento").required();
        bval = bval && $("#nombre").required();
        bval = bval && $("#descripcion").required();
        bval = bval && $("#fecha_inicio").required();
        bval = bval && $("#fecha_fin").required();
        bval = bval && $("#lugar").required();
        
        if (bval) 
        {
            $("#frm").submit();
        }
        return false;
    }); 
});