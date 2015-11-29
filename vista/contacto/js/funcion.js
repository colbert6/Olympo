/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
  $( "#ok" ).click(function(){
     window.location=url+'contacto/';
  });
});
function ver(id){
    
            $("#myModalLabel").html('');
            $("#bodymodal").html('<div class="text-center"><img src="'+url+'lib/img/loading.gif" /></div>');
            html='';nombre='';
           $.post(url+'contacto/ver','id='+id,function(datos){
           
                nombre = datos[0].NOMBRE;
                correo= datos[0].CORREO;
                telefono= datos[0].TELEFONO;
                descripcion= datos[0].MENSAJE;
              //  alert(descripcion);
		if(descripcion != ''){
      if (telefono!= '') {
        html += "<div style='font-size: 2em;padding: 0px 0px 0px 0px;'><strong>Telefono :</strong></div>";
        html += "<div style='font-size: 20px;padding: 10px 0px 10px 150px;'>"+telefono+"</div>";
      }else{
        html += "<div style='font-size: 2em;padding: 0px 0px 0px 0px;'><strong>Telefono :</strong></div>";
        html += "<div style='font-size: 20px;padding: 10px 0px 10px 150px;'>Sin Numero</div>";
      }
        html += "<div style='font-size: 2em;padding: 0px 0px 0px 0px;'><strong>Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp:</strong></div>";
        html += "<div style='font-size: 20px;padding: 10px 0px 10px 150px;'>"+correo+"</div>";
		    html += "<div style='font-size: 2em;padding: 0px 0px 0px 0px;'><strong>Mensaje :</strong></div>";
        html += "<div  style='font-size: 20px;padding: 10px 0px 10px 150px;'>"+descripcion+"</div>";
		}else{
		    html += "<h4>No tiene mensaje</h4>";
		}
                $("#myModalLabel").html('<strong>Nombre :</strong> '+nombre);
                $("#bodymodal").html(html);
           },'json');
}