$(document).ready(function(){


});

function hoy(){
    var d = new Date();
    var month = d.getMonth()+1;
    var day = d.getDate();
    var output = d.getFullYear() + '-' +
        (month<10 ? '0' : '') + month + '-' +
        (day<10 ? '0' : '') + day;
    return output;
}
function ver(id,fecha){
    $.post(url+'triaje/datos_triajes','id='+id+"&fecha="+fecha,function(datos){
        alert(datos.length); 
        html="";
        html+="<div class='row'>";
        html+="<div class='col-md-9'>";
        html+="<div class='form-group'>";
        html+=" <label class='control-label'>SOCIO:</label>";
        html+=" <strong>"+datos[0]["NOMBRE"]+" "+datos[0]["APELLIDO_PATERNO"]+" "+datos[0]["APELLIDO_MATERNO"]+"</strong>"; 
        html+="</div>";
        html+="</div>";
        html+="<div class='col-md-3'>";
        html+="<div class='form-group'>";
        html+=" <label class='control-label'>FECHA:</label>";
        html+=" <strong>"+datos[0]["FECHA"]+"</strong>"; 
        html+="</div>";
        html+="</div>";
        html+="</div>";
        html+='<table class="table table-striped table-bordered table-hover sortable">';
        for (var i = 0; i < datos.length; i++) {     
            html+= '<tr>';
            html+= '<th>'+datos[i]["DESCRIPCION"]+':</th>';
            html+= '<td>'+datos[i]["VALOR"]+" "+datos[i]["UNIDAD_MEDIDA"]+'</td>';
            html+= '</tr>';
         }; 
         html+= '</table>';
        $("#cuerpo_modal").html(html);
    },'json');
    
}

