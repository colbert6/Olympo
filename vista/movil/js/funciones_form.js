$(document).ready(function(){    
	alert("asdas");
    $( "#save" ).click(function(){
        bval = true;   
        bval = bval && $("#login-username").required();
        bval = bval && $("#login-password").required();
        
        if (bval) 
        {
            $("#frm").submit();
        }
        return false;
    }); 
});