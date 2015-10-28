$(function() {    
      
    $( "#save" ).click(function(){
        bval = true;   
        bval = bval && $("#id_marca").required();
        bval = bval && $("#id_categoria_producto").required();
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