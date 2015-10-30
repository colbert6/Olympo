$(document).ready(function(){


});

function ver(id){

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
        html+= '<th>APELLIDOS</th>';
        html+= '<td>'+datos[0]["APELLIDO_PATERNO"]+' '+datos[0]["APELLIDO_MATERNO"]+'</td>';
        html+= '</tr>';
        html+= '<tr>';
        html+= '<th>TIPO DE SOCIO:</th>';
        html+= '<td>'+datos[0]["TIPO_SOCIO"]+'</td>';
        html+= '</tr>';
        html+= '<tr>';
        html+= '<th>DNI:</th>';
        html+= '<td>'+datos[0]["DNI"]+'</td>';
        html+= '</tr>';
        html+= '<tr>';
        html+= '<th>ALIAS:</th>';
        html+= '<td>'+datos[0]["ALIASS"]+'</td>';
        html+= '</tr>';
        html+= '<tr>';
        html+= '<th>DIRECCION:</th>';
        html+= '<td>'+datos[0]["DIRECCION"]+'</td>';
        html+= '</tr>';
        html+= '<tr>';
        html+= '<th>SEXO:</td>';
        if(datos[0]['SEXO']==0){
            html+= '<td>Femenino</td>';
        }
        else{
            html+= '<td>Masculino</td>';
        }
        html+= '</tr>';
        html+= '<tr>';
        html+= '<th>ESTADO CIVIL:</th>';
        html+= '<td>'+datos[0]["ESTADO_CIVIL"].toUpperCase()+'</td>';
        html+= '</tr>';
        html+= '<tr>';
        html+= '<th>EMAIL:</th>';
        html+= '<td>'+datos[0]["EMAIL"]+'</td>';
        html+= '</tr>';
        html+= '<tr>';
        html+= '<th>TELEFONO / CELULAR:</th>';
        html+= '<td>'+datos[0]["TELEFONO"]+" / "+datos[0]["CELULAR"]+'</td>';
        html+= '</tr>';
        html+= '<th>FECHA NACIMIENTO:</th>';
        html+= '<td>'+datos[0]["FECHA_NACIMIENTO"]+'</td>';
        html+= '</tr>';
        html+= '<tr>';
        html+= '<th>OCUPACION:</th>';
        html+= '<td>'+datos[0]["OCUPACION"]+'</td>';
        html+= '</tr>';
        html+= '<tr>';
        html+= '<th>NUMERO DE HIJOS:</th>';
        html+= '<td>'+datos[0]["NUMERO_HIJO"]+'</td>';
        html+= '</tr>';
        html+= '<tr>';
        html+= '<th>SECTOR:</th>';
        html+= '<td>'+datos[0]["SECTOR"]+'</td>';
        html+= '</tr>';
        html+= '<tr>';
        html+= '<th>GRADO DE ESTUDIO:</th>';
        html+= '<td>'+datos[0]["GRADO_ESTUDIO"]+'</td>';
        html+= '</tr>';
        html+= '</table>';
        $("#titulo").html(titulo);
        $("#home").html(html);
    },'json');
    $.post(url+'socio/extraerTriaje','id='+id,function(triaje){
        //alert(triaje.length);
        if(triaje.length>0){
            $.post(url+'socio/conceptoTriaje',function(concepto_triaje){
                //alert(concepto_triaje.length);
                $.post(url+'socio/ultimoTriaje','id='+id,function(utriaje){
                    //alert(utriaje.length);
                    triaje="<br>";
                    triaje+="<div class='btn-group btn-group-justified' style='width:60%; margin:0 auto;'>";
                    triaje+=" <a href='"+url+"triaje/editar/"+id+"' class='btn btn-danger'>Editar Triaje</a>";
                    triaje+=" <a href='"+url+"triaje/nuevo/"+id+"' class='btn btn-warning'>Nuevo Triaje</a>";
                    triaje+=" <a href='#' class='btn btn-success'>Ver Historial</a>";
                    triaje+="</div>";
                    triaje+='<br>';
                    triaje+='<table class="table table-striped table-bordered table-hover sortable">';
                    for (var j = 0; j < concepto_triaje.length; j++) {
                        triaje+= '<tr>';
                        triaje+= '<th>'+concepto_triaje[j]["DESCRIPCION"]+'</th>';
                        triaje+= '<td>';
                        for (var i = 0; i < utriaje.length; i++) {
                            if(concepto_triaje[j]["ID_CONCEPTO_TRIAJE"] == utriaje[i]["ID_CONCEPTO_TRIAJE"]){
                                triaje+= utriaje[i]["VALOR"]+utriaje[i]["UNIDAD_MEDIDA"];
                            }else{
                                triaje+="";
                            }
                        };
                        triaje+= '</td>';
                        triaje+= '</tr>';
                    };
                    triaje+='</table>';
                    //alert(triaje);
                    $("#triaje").html(triaje);

                },'json');
            
            },'json');
            
        }else{
            btnFinal="<br>";
            btnFinal+="<div class='btn-group btn-group-justified' style='width:20%; margin:0 auto;'>";
            btnFinal+=" <a href='"+url+"triaje/nuevo/"+id+"' class='btn btn-warning'>Agregar Triaje</a>";
            btnFinal+="</div>";
            $("#triaje").html(btnFinal);
        }
        
    },'json');
    $.post(url+'socio/extraerTriaje','id='+id,function(datos){




        $("#rutina").html(datos[0]["NOMBRE"]);
    },'json');
}

