$(function() {    
      
    $( "#save" ).click(function(){
        bval = true;   
        bval = bval && $("#descripcion").required();
        bval = bval && $("#numero_servicios").required();
        
        if (bval) 
        {
            $("#frm").submit();
        }
        return false;
    }); 
});