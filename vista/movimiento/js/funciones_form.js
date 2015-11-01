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
});