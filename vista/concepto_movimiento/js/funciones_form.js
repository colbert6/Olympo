$(function() {    
      
    $( "#save" ).click(function(){
        bval = true;   
        bval = bval && $("#id_tipo_movimiento").required();
        bval = bval && $("#descripcion").required();
        
        if (bval) 
        {
            $("#frm").submit();
        }
        return false;
    }); 
});