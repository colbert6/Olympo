$(function() {    
      
    $( "#save" ).click(function(){
        bval = true;   
        bval = bval && $("#id_ambiente").required();
        bval = bval && $("#nombre").required();
        bval = bval && $("#descripcion").required();
        
        if (bval) 
        {
            $("#frm").submit();
        }
        return false;
    }); 
});