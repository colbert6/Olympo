$(function() {
    $("input:text[readonly=readonly]").css('cursor', 'pointer');
       
    $("#socio").focus(function() {
        buscarSocio();
        $("#VtnBuscarSocio").show();
    });
    $("#AbrirVtnBuscarSocio").click(function() {
        buscarSocio();
        $("#VtnBuscarSocio").show();
    });
    $("#membresia").focus(function() {
        buscarMembresia();
        $("#VtnBuscarMembresia").show();
    });
    $("#AbrirVtnBuscarMembresia").click(function() {
        buscarMembresia();
        $("#VtnBuscarMembresia").show();
    });
    $("#socio_sel").focus(function() {
        buscarServicio();
        $("#VtnBuscarServicio").show();
    });
    $("#AbrirVtnBuscarServicio").click(function() {
        buscarServicio();
        $("#VtnBuscarServicio").show();
    });
    
    $("#save").click(function() {
        bval = true;
        bval = bval && $("#socio").required();
        bval = bval && $("#membresia").required();
        if (bval) {
            if ($(".row_tmp").length) {
                bootbox.confirm("¿Está seguro que desea guardar la compra?", function(result) {
                    if (result) {
                        $("#frm").submit();
                    }
                });
            } else {
                bootbox.alert("Agregue Servicios a la Matricula");
            }
        }
        return false;
    });
    
});
function buscarSocio() {
    $("#grillaMembresia").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');
    $("#grillaServicio").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');
    $("#grillaSocio").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');
    $.post(url + 'socio/buscador','matricula=1', function(datos) {
        var HTML = '<table id="table2" class="display" cellspacing="0" width="100%">' +
                '<thead>' +
                '<tr>' +
                '<th>Item</th>'+
                '<th>Nombre</th>' +
                '<th>DNI</th>' +
                '<th>Acciones</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>';

        for (var i = 0; i < datos.length; i++) {
            HTML = HTML + '<tr>';
            HTML = HTML + '<td>'+(i+1)+'</td>';
            HTML = HTML + '<td>' + datos[i].NOMBRE +' '+ datos[i].APELLIDO_PATERNO +' '+  datos[i].APELLIDO_MATERNO +'</td>';
            HTML = HTML + '<td>' + datos[i].DNI + '</td>';
            var id_socio = datos[i].ID_SOCIO;
            var socio = $.trim(datos[i].NOMBRE +' '+ datos[i].APELLIDO_PATERNO +' '+  datos[i].APELLIDO_MATERNO);
            var dni         = datos[i].DNI;
            HTML = HTML + '<td><a style="margin-right:4px" href="javascript:void(0)" onclick="sel_socio(\'' + id_socio + '\',\'' + socio + '\',\'' + dni + '\')" class="btn btn-success"><i class="icon-ok icon-white"></i> </a>';
            HTML = HTML + '</td>';
            HTML = HTML + '</tr>';
        }
        HTML = HTML + '</tbody></table>';
        $("#grillaSocio").html(HTML);
        $("#jsfoot").html('<script src="' + url + 'vista/matricula/js/run_table.js"></script>');
    }, 'json');
}
function buscarMembresia() {
    $("#grillaSocio").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');
    $("#grillaServicio").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');
    $("#grillaMembresia").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');
    $.post(url + 'membresia/buscador', function(datos) {
        var HTML = '<table id="table2" class="display" cellspacing="0" width="100%">' +
                '<thead>' +
                '<tr>' +
                '<th>Item</th>'+
                '<th>Descripcion</th>'+
                '<th>Vigencia</th>'+
                '<th>Servicios</th>'+
                '<th>Precio</th>'+
                '<th>Acciones</th>'+
                '</tr>' +
                '</thead>' +
                '<tbody>';

        for (var i = 0; i < datos.length; i++) {
            HTML = HTML + '<tr>';
            HTML = HTML + '<td>'+(i+1)+'</td>';
            HTML = HTML + '<td>'+datos[i].DESCRIPCION+'</td>';
            HTML = HTML + '<td>'+datos[i].DURACION+' '+datos[i].VIGENCIA+'</td>';
            HTML = HTML + '<td>'+datos[i].NUMERO_SERVICIOS+'</td>';
            HTML = HTML + '<td>'+datos[i].PRECIO+'</td>';
            var id_membresia = datos[i].ID_TIPO_MEMBRESIA;
            var descripcion = datos[i].DESCRIPCION;
            var numero_servicios = datos[i].NUMERO_SERVICIOS;
            var precio = datos[i].PRECIO;
            HTML = HTML + '<td><a style="margin-right:4px" href="javascript:void(0)" onclick="sel_membresia(\'' + id_membresia + '\',\'' + descripcion + '\',\'' + numero_servicios + '\',\'' + precio +'\')" class="btn btn-success"><i class="icon-ok icon-white"></i> </a>';
            HTML = HTML + '</td>';
            HTML = HTML + '</tr>';
        }
        HTML = HTML + '</tbody></table>'
        $("#grillaMembresia").html(HTML);
        $("#jsfoot").html('<script src="' + url + 'vista/matricula/js/run_table.js"></script>');
    }, 'json');
}
function buscarServicio() {
    $("#grillaSocio").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');
    $("#grillaMembresia").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');
    $("#grillaServicio").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');
    $.post(url + 'servicio/buscador', function(datos) {
        var HTML = '<table id="table2" class="display" cellspacing="0" width="100%">' +
                '<thead>' +
                '<tr>' +
                '<th>Item</th>'+
                '<th>Nombre</th>'+
                '<th>Descripcion</th>'+
                '<th>Ambiente</th>'+
                '<th>Acciones</th>'+
                '</tr>' +
                '</thead>' +
                '<tbody>';

        for (var i = 0; i < datos.length; i++) {
            HTML = HTML + '<tr>';
            HTML = HTML + '<td>'+(i+1)+'</td>';
            HTML = HTML + '<td>'+datos[i].NOMBRE+'</td>';
            HTML = HTML + '<td>'+datos[i].DESCRIPCION+'</td>';
            HTML = HTML + '<td>'+datos[i].AMBIENTE+'</td>';
            var id_servicio = datos[i].ID_SERVICIO;
            var servicio = datos[i].NOMBRE;
            var ambiente = datos[i].AMBIENTE;
            HTML = HTML + '<td><a style="margin-right:4px" href="javascript:void(0)" onclick="sel_servicio(\'' + id_servicio + '\',\'' + servicio +'\',\'' + ambiente + '\')" class="btn btn-success"><i class="icon-ok icon-white"></i> </a>';
            HTML = HTML + '</td>';
            HTML = HTML + '</tr>';
        }
        HTML = HTML + '</tbody></table>'
        $("#grillaServicio").html(HTML);
        $("#jsfoot").html('<script src="' + url + 'vista/matricula/js/run_table.js"></script>');
    }, 'json');
}


function sel_socio(id_s,s,dni) {
    $("#id_socio").val(id_s);
    $("#socio").val(s);
    $("#dni").val(dni);
    $('#modalSocio').modal('hide');
}

function sel_membresia(id_m,m,ns,p) {
    $("#id_membresia").val(id_m);
    $("#membresia").val(m);
    $("#numero_servicios").val(ns);
    $("#precio").val(p);
    $('#modalMembresia').modal('hide');
    $("#celda_servicio").show();
}

function sel_servicio(id_s,s,a) {
    if ($(".id_serv[value=" + id_s + "]").length) {
            bootbox.alert("Este servicio ya fue agregado");
            return false;
        }
    if ($(".id_serv").length+1 >$("#numero_servicios").val()) {
            bootbox.alert("Maximos Servicios Inlcuidos");
            $('#modalServicio').modal('hide');
            return false;
        }
        var html = '<tr class="row_tmp">';
        html += '<td>';
        html +=  $(".id_serv").length+1;       
        html += '</td>';
        html += '<td>';
        html += '   <input type="hidden" name="id_servicio[]" class="id_serv" value="' + id_s + '" />' + s;
        html += '</td>';
        html += '<td>';
        html +=         a
        html += '</td>';
        html += '<td>';
        html += '   <a class="btn btn-danger delete"><i class="icon-trash icon-white"></i></a>';
        html += '</td>';
        html += '</tr>';
        $('#modalServicio').modal('hide');
        $("#tblDetalle").append(html);
        
    
}
function limpiar() {
    $("#id_socio,#id_membresia,#socio,#dni,#precio,#numero_servicios").val('');
    $("#cantidad,#precio").attr('disabled', true);
}

$(".delete").live('click', function() {
    var i = $(this).parent().parent().index();
    var importe = $("#tblDetalle tr:eq(" + i + ") td .importe").val();
    $("#tblDetalle tr:eq(" + i + ")").remove();
    setTotal(importe, 0);
});
