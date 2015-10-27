$(function() {    
      
    $( "#save" ).click(function(){
        bval = true;   
        bval = bval && $("#marca").required();
        bval = bval && $("#categoria_producto").required();
        bval = bval && $("#nombre").required();
        bval = bval && $("#precio").required();
        bval = bval && $("#stock_min").required();
        bval = bval && $("#stock_max").required();
        
        if (bval) 
        {
            $("#frm").submit();
        }
        return false;
    }); 
});