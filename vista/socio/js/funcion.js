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
function ver(id){
    
    
    $.post(url+'socio/buscador','id='+id,function(datos){
        socio = datos[0]["NOMBRE"]+" "+datos[0]["APELLIDO_PATERNO"]+" "+datos[0]["APELLIDO_MATERNO"];
        titulo = "<strong>SOCIO</strong>: "+socio.toUpperCase();
        html='<br>';
        html+='<table class="table table-striped table-bordered table-hover sortable">';
        html+= '<tr>';
        html+= '<th>NOMBRE:</th>';
        html+= '<td>'+datos[0]["NOMBRE"].toUpperCase()+'</td>';
        html+= '</tr>';
        html+= '<tr>';
        html+= '<th>APELLIDOS</th>';
        html+= '<td>'+datos[0]["APELLIDO_PATERNO"].toUpperCase()+' '+datos[0]["APELLIDO_MATERNO"].toUpperCase()+'</td>';
        html+= '</tr>';
        html+= '<tr>';
        html+= '<th>TIPO DE SOCIO:</th>';
        html+= '<td>'+datos[0]["TIPO_SOCIO"].toUpperCase()+'</td>';
        html+= '</tr>';
        html+= '<tr>';
        html+= '<th>DNI:</th>';
        html+= '<td>'+datos[0]["DNI"]+'</td>';
        html+= '</tr>';
        html+= '<tr>';
        html+= '<th>ALIAS:</th>';
        html+= '<td>'+datos[0]["ALIASS"].toUpperCase()+'</td>';
        html+= '</tr>';
        html+= '<tr>';
        html+= '<th>DIRECCION:</th>';
        html+= '<td>'+datos[0]["DIRECCION"].toUpperCase()+'</td>';
        html+= '</tr>';
        html+= '<tr>';
        html+= '<th>SEXO:</td>';
        if(datos[0]['SEXO']=='f'){
            html+= '<td>FEMENINO</td>';
        }
        else{
            html+= '<td>MASCULINO</td>';
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
        html+= '<td>'+datos[0]["OCUPACION"].toUpperCase()+'</td>';
        html+= '</tr>';
        html+= '<tr>';
        html+= '<th>NUMERO DE HIJOS:</th>';
        html+= '<td>'+datos[0]["NUMERO_HIJO"]+'</td>';
        html+= '</tr>';
        html+= '<tr>';
        html+= '<th>SECTOR:</th>';
        html+= '<td>'+datos[0]["SECTOR"].toUpperCase()+'</td>';
        html+= '</tr>';
        html+= '<tr>';
        html+= '<th>GRADO DE ESTUDIO:</th>';
        html+= '<td>'+datos[0]["GRADO_ESTUDIO"].toUpperCase()+'</td>';
        html+= '</tr>';
        html+= '</table>';
        $("#titulo").html(titulo);
        $("#home").html(html);
    },'json');
    $.post(url+'socio/extraerTriaje','id='+id,function(triaje){
        //alert(triaje.length);
        if(triaje.length>0){
            $.post(url+'concepto_triaje/jsonExtraerConceptoTriaje',function(concepto_triaje){
                //alert(concepto_triaje.length);
                $.post(url+'socio/ultimoTriaje','id='+id,function(utriaje){
                    //alert(utriaje.length);
                    triaje="<br>";
                    triaje+="<div class='btn-group btn-group-justified' style='width:80%; margin:0 auto;'>";
                    triaje+=" <a href='"+url+"triaje/editar_ultimo/"+id+"' class='btn btn-danger'>EDITAR TRIAJE</a>";
                    if (Date.parse(hoy())==Date.parse(utriaje[0]["FECHA"])){
                        triaje+="";
                    }else{
                        triaje+=" <a href='"+url+"triaje/nuevo/"+id+"' class='btn btn-warning'>NUEVO TRIAJE</a>";    
                    }
                    triaje+=" <a href='"+url+"triaje/historial/"+id+"' class='btn btn-success'>VER HISTORIAL</a>";
                    triaje+="</div>";
                    triaje+='<br>';
                    triaje+='<table class="table table-striped table-bordered table-hover sortable">';
                    for (var j = 0; j < concepto_triaje.length; j++) {
                        triaje+= '<tr>';
                        triaje+= '<th>'+concepto_triaje[j]["DESCRIPCION"]+'</th>';
                        triaje+= '<td>';
                        for (var i = 0; i < utriaje.length; i++) {
                            if(concepto_triaje[j]["ID_CONCEPTO_TRIAJE"] == utriaje[i]["ID_CONCEPTO_TRIAJE"]){
                                triaje+= utriaje[i]["VALOR"]+" "+utriaje[i]["UNIDAD_MEDIDA"];
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
    $.post(url+'socio/extraerRutina','id='+id,function(rutina){
        //alert(rutina.length);
        if(rutina.length>0){
            $.post(url+'categoria_ejercicio/jsonCategoria_Ejercicio',function(categoria_ejercicio){      
                //   alert(categoria_ejercicio.length);
                dat_rutina="<br>";
                dat_rutina+="<div class='btn-group btn-group-justified' style='width:40%; margin:0 auto;'>";
                dat_rutina+=" <a href='"+url+"rutina/editar/"+id+"' class='btn btn-warning'>EDITAR RUTINA </a>";
                dat_rutina+="</div>";
                dat_rutina+='<br>';
                dat_rutina+='<table class="table table-striped table-bordered table-hover sortable">';
                dat_rutina+='<thead>';
                dat_rutina+='<th>DIA</th>';
                dat_rutina+='<th>CATEGORIA EJERCICIO</th>';
                dat_rutina+='</thead>';
                dat_rutina+='<tbody>';
               for (var k = 0; k <rutina.length; k++) {
                    dat_rutina+='<tr>';
                    dat_rutina+='<th>'+rutina[k]["DIA"]+'</th>';
                    for (var l = 0; l < categoria_ejercicio.length; l++) {
                        if(categoria_ejercicio[l]["ID_CATEGORIA_EJERCICIO"] == rutina[k]["ID_CATEGORIA_EJERCICIO"]){
                            dat_rutina+= '<td>'+categoria_ejercicio[l]["DESCRIPCION"].toUpperCase()+'</td>';
                        }
                    };
                    dat_rutina+= '</tr>';
                };
                dat_rutina+='</tbody>';


                
                dat_rutina+= '</table>';
              //  alert(dat_rutina);
            
                $("#rutina").html(dat_rutina);
            
            },'json');
            
        }else{
            btnFinal="<br>";
            btnFinal+="<div class='btn-group btn-group-justified' style='width:20%; margin:0 auto;'>";
            btnFinal+=" <a href='"+url+"rutina/nuevo/"+id+"' class='btn btn-warning'>Agregar Rutina</a>";
            btnFinal+="</div>";
            $("#rutina").html(btnFinal);
        }

    },'json');
}

