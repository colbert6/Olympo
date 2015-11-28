

function ver(id){
    //alert(id);
    $.post(url+'empleado/buscador','id='+id,function(datos){
        empleado = datos[0]["NOMBRE"]+" "+datos[0]["APELLIDO_PATERNO"]+" "+datos[0]["APELLIDO_MATERNO"];
        titulo = "<strong>EMPLEADO</strong>: "+empleado.toUpperCase();
        html='<br>';
        html+='<table class="table table-striped table-bordered table-hover sortable">';
        html+= '<tr>';
        html+= '<th>CATEGORIA DE EMPLEADO:</th>';
        html+= '<td>'+datos[0]["CATEGORIA-EMPLEADO"]+'</td>';
        html+= '</tr>';
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
        html+= '<th>DNI:</th>';
        html+= '<td>'+datos[0]["DNI"]+'</td>';
        html+= '</tr>';
        html+= '<th>EMAIL:</th>';
        html+= '<td>'+datos[0]["EMAIL"]+'</td>';
        html+= '</tr>';
        html+= '</tr>';
        html+= '<th>TELEFONO:</th>';
        html+= '<td>'+datos[0]["TELEFONO"]+'</td>';
        html+= '</tr>';
        html+= '</tr>';
        html+= '<th>CELULAR:</th>';
        html+= '<td>'+datos[0]["CELULAR"]+'</td>';
        html+= '</tr>';
        html+= '</tr>';
        html+= '<th>SEXO:</th>';
        if(datos[0]['SEXO']=='f'){
            html+= '<td>FEMENINO</td>';
        }
        else{
            html+= '<td>MASCULINO</td>';
        }
        html+= '</tr>';
        html+= '</tr>';
        html+= '<th>DIRECCION:</th>';
        html+= '<td>'+datos[0]["DIRECCION"]+'</td>';
        html+= '</tr>';
        html+= '</tr>';
        html+= '<th>FECHA DE NACIMIENTO:</th>';
        html+= '<td>'+datos[0]["FECHA_NACIMIENTO"]+'</td>';
        html+= '</tr>';
        html+= '</tr>';
        html+= '<th>ESTADO_CIVIL:</th>';
        html+= '<td>'+datos[0]["ESTADO_CIVIL"]+'</td>';
        html+= '</tr>';
        html+= '</tr>';
        html+= '<th>Nº DE HIJOS:</th>';
        html+= '<td>'+datos[0]["NUMERO_HIJO"]+'</td>';
        html+= '</tr>';
        html+= '</tr>';
        html+= '<th>GRADO DE ESTUDIO:</th>';
        html+= '<td>'+datos[0]["GRADO_ESTUDIO"]+'</td>';
        html+= '</tr>';
        html+= '</tr>';
        html+= '</table>';
        $("#titulo").html(titulo);
        $("#home").html(html);
    },'json');
}

