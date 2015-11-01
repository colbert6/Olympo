$(function() {    
      
    $( "#save" ).click(function(){
        bval = true;   
        bval = bval && $("#descripcion").required();
        bval = bval && $("#duracion").required();
        bval = bval && $("#numero_servicios").required();
        bval = bval && $("#precio").required();
        
        if (bval) 
        {
            $("#frm").submit();
        }
        return false;
    }); 
});