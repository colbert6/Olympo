$(function() {    
      
    $( "#save" ).click(function(){
        bval = true;   
        bval = bval && $("#id_proveedor").required();
        bval = bval && $("#razon_social").required();
        bval = bval && $("#ruc").required();
        bval = bval && $("#id_ubigeo").required();
        
        if (bval) 
        {
            $("#frm").submit();
        }
        return false;
    }); 
});