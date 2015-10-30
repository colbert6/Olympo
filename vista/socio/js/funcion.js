$(document).ready(function(){


});

function ver(id){
    alert("sada");
    
    $.post(url+'socio/buscador','id='+id,function(datos){
        socio = datos[0]["NOMBRE"]+" "+datos[0]["APELLIDO_PATERNO"]+" "+datos[0]["APELLIDO_MATERNO"];
        titulo = "<strong>SOCIO</strong>: "+socio.toUpperCase();
        html='<br>';
        html+='<table class="table table-striped table-bordered table-hover sortable">';
        html+= '<tr>';
        html+= '<th>NOMBRE:</th>';
        html+= '<td>'+datos[0]["NOMBRE"]+'</td>';
        html+= '</tr>';
        html+= '<tr>';
        html+= '<th>APELLIDO PATERNO:</th>';
        html+= '<td>'+datos[0]["APELLIDO_PATERNO"]+'</td>';
        html+= '</tr>';
        html+= '<tr>';
        html+= '<th>APELLIDO PATERNO:</th>';
        html+= '<td>'+datos[0]["APELLIDO_MATERNO"]+'</td>';
        html+= '</tr>';
        html+= '<tr>';
        html+= '<th>TIPO DE SOCIO:</th>';
        html+= '<td>'+datos[0]["TIPO_SOCIO"]+'</td>';
        html+= '</tr>';
        html+= '<tr>';
        html+= '<th>DNI:</th>';
        html+= '<td>'+datos[0]["DNI"]+'</td>';
        html+= '</tr>';
        html+= '</table>';
        $("#titulo").html(titulo);
        $("#home").html(html);
    },'json');
    $.post(url+'socio/buscador','id='+id,function(datos){
        html='<br>';
        html+='<table class="table table-striped table-bordered table-hover sortable">';
        html+= '<tr>';
        html+= '<td>Nombres:</td>';
        html+= '<td>asdas</td>';
        html+= '</tr>';
        html+= '<tr>';
        html+= '<td>Nombres:</td>';
        html+= '<td>asdas</td>';
        html+= '</tr>';
        html+= '<tr>';
        html+= '<td>Nombres:</td>';
        html+= '<td>asdas</td>';
        html+= '</tr>';
        html+= '</table>';
        $("#triaje").html(html);
        
    },'json');
    $.post(url+'socio/buscador','id='+id,function(datos){
        $("#rutina").html(datos[0]["NOMBRE"]);
        
        
    },'json');
}

