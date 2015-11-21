$(function() {    
      
    $( "#btnAperturar" ).click(function(){
        bval = true;   
    	bval = bval && $("#monto_apertura").required();
        if (bval) 
        {
            alert("Desde este Momento Ud. es responsable de todo lo que suceda en esta Caja");
            enviarApertura($('#id_caja').val(),$('#monto_apertura').val());	
        }
        return false;
    }); 
});
function apertura(id){
    var empleado = $('#id_empleado').val();
    $.post(url+'sesion_caja/sesiones_activas',function(datos){
        var ocupado = false;
        for (var i = 0; i < datos.length; i++) {
          if(datos[i].ID_EMPLEADO == empleado){
            ocupado = true;
          }  
        };
        if(!ocupado){
            $('#myModal').modal('show');
            $('#id_caja').val(id);
        }else{
            alert("Ud. ya Aperturo una Caja Anteriormente");
        }
    },'json');
	
}
function enviarApertura(id,monto){
  	$.post(url+'sesion_caja/aperturar',{id:id,monto:monto});
    window.location = url+'sesion_caja/';
}
function cerrarCaja(url,reporte){
    if(confirm("¿Esta seguro de Cerrar esta Caja?")){
        if(confirm("¿Desea Generar el Reporte de Movimientos de esta Sesion?")){
            window.open(reporte,'_blank');
        }
        href = url;
        window.location = href;
    }
}
