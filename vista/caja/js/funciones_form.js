$(function() {    
      
    $( "#save" ).click(function(){
        bval = true;   
        bval = bval && $("#nombre").required();
        
        if (bval) 
        {
            $("#frm").submit();
        }
        return false;
    }); 
});