/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
    
});
function ver(id){
            $("#myModalLabel").html('');
            $("#bodymodal").html('<div class="text-center"><img src="'+url+'lib/img/loading.gif" /></div>');
            html='';titulo='';
           $.post(url+'web_producto/ver','id='+id,function(datos){
                titulo = datos[0].TITULO;
                imagen = datos[0].IMAGEN;
		if(imagen != ''){
		    html += "<div class='text-center'><img src='"+url+"lib/img/producto/"+imagen.toLowerCase()+"' /></div>";
		}else{
		    html += "<h4>No tiene imagen</h4>";
		}
                $("#myModalLabel").html(titulo);
                $("#bodymodal").html(html);
           },'json');
       }