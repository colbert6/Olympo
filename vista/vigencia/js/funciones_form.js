$(function() {    
      
    $( "#save" ).click(function(){
        bval = true;   
        bval = bval && $("#descripcion").required();
        bval = bval && $("#dias").required();
        
        if (bval) 
        {
            $("#frm").submit();
        }
        return false;
    }); 
});