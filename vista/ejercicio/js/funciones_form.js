$(function() {    
      
    $( "#save" ).click(function(){
        bval = true;   
        bval = bval && $("#id_servicio").required();
        bval = bval && $("#id_categoria_ejercicio").required();
        bval = bval && $("#descripcion").required();
        
        
        
        if (bval) 
        {
            $("#frm").submit();
        }
        return false;
    }); 
});