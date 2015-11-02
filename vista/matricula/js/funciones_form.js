$(function() {
    $("input:text[readonly=readonly]").css('cursor', 'pointer');
    
    
    
    $("#socio").focus(function() {
        buscarMembresia();
        $("#VtnBuscarSocio").show();
    });
    $("#AbrirVtnBuscarSocio").click(function() {
        buscarMembresia();
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
    
    $("#save").click(function() {
        bval = true;
        bval = bval && $("#nrodoc").required();
        bval = bval && $("#fechacompra").required();
        bval = bval && $("#proveedor").required();
        bval = bval && $("#id_tipopago").required();
        if ($("#id_tipopago").val() == 2) {
            bval = bval && $("#cuotas").required();
            bval = bval && $("#intervalo").required();
        }
        if (bval) {
            if ($(".row_tmp").length) {
                bootbox.confirm("¿Está seguro que desea guardar la compra?", function(result) {
                    if (result) {
                        $("#frm").submit();
                    }
                });
            } else {
                bootbox.alert("Agregue los insumos al detalle");
            }
        }
        return false;
    });
    
});

function buscarMembresia() {
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
            HTML = HTML + '<td><a style="margin-right:4px" href="javascript:void(0)" onclick="sel_insumo(\'' + id_membresia + '\',\'' + descripcion + '\',\'' + numero_servicios + '\',\'' + precio + '\',\'' + '\')" class="btn btn-success"><i class="icon-ok icon-white"></i> </a>';
            HTML = HTML + '</td>';
            HTML = HTML + '</tr>';
        }
        HTML = HTML + '</tbody></table>'
        $("#grillaMembresia").html(HTML);
        $("#jsfoot").html('<script src="' + url + 'vista/compra/js/run_table.js"></script>');
    }, 'json');
}

function buscarSocio() {
    $("#grillaSocio").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');
    $.post(url + 'socio/buscador', function(datos) {
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
            HTML = HTML + '<td><a style="margin-right:4px" href="javascript:void(0)" onclick="sel_proveedor(\'' + id_socio + '\',\'' + socio + '\',\'' + dni + '\')" class="btn btn-success"><i class="icon-ok icon-white"></i> </a>';
            HTML = HTML + '</td>';
            HTML = HTML + '</tr>';
        }
        HTML = HTML + '</tbody></table>';
        $("#grillaSocio").html(HTML);
        $("#jsfoot").html('<script src="' + url + 'vista/matricula/js/run_table.js"></script>');
    }, 'json');
}


function limpiar() {
    $("#id_socio,#id_membresia,#socio,#dni,#precio,#numero_servicios").val('');
    $("#cantidad,#precio").attr('disabled', true);
}
