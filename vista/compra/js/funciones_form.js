$(function() {
    $("#id_tipopago").change(function() {
        if ($(this).val() == 2) {
            $("#celda_credito").show();
        } else {
            $("#celda_credito").hide();
        }
    });
    $("#sel_almacen").change(function() {
        limpiar();
    });
    $("#nrodoc").focus();
    $("#subtotal,#total,#igv").val('0.00');
    $("#chbx_igv").click(function() {
        if ($("#chbx_igv").is(':checked')) {
            $.post(url + 'compra/getParam', 'id_param=IGV', function(datos) {
                $("#igv").val(datos[0].VALOR);
                setTotal(0, 1);
            }, 'json');
        } else {
            $("#igv").val('0.00');
        }
        setTotal(0, 1);
    });
    $("input:text[readonly=readonly]").css('cursor', 'pointer');
    limpiar();
    $("#fechacompra, #fecha_vencimiento").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true});
    $("#save").click(function() {
        bval = true;
        bval = bval && $("#nrodoc").required();
        bval = bval && $("#fechacompra").required();
        bval = bval && $("#proveedor").required();
        bval = bval && $("#id_tipopago").required();
        if ($("#id_tipopago").val() == 2) {
            bval = bval && $("#fecha_vencimiento").required();
            bval = bval && $("#intervalo_dias").required();
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
    $("#selectInsumo").click(function() {
        bval = true;   
        bval = bval && $("#sel_almacen").required();
        if (!bval) 
        {
           return false;
        }
        buscarInsumo();
        $("#VtnBuscarInsumo").show();
    });
    $("#producto").click(function() {
        bval = true;   
        bval = bval && $("#sel_almacen").required();
        if (!bval) 
        {
           return false;
        }
        buscarInsumo();
        $("#VtnBuscarInsumo").show();
    });
    $("#AbrirVtnBuscarInsumo").click(function() {
        bval = true;   
        bval = bval && $("#sel_almacen").required();
        if (!bval) 
        {
           return false;
        }
        buscarInsumo();
        $("#VtnBuscarInsumo").show();
    });
    $("#proveedor").click(function() {
        buscarProveedor();
        $("#buscarProveedor").focus();
        $("#VtnBuscarProveedor").show();
        $("#buscarProveedor").focus();
    });
    $("#proveedor").focus(function() {
        buscarProveedor();
        $("#buscarProveedor").focus();
        $("#VtnBuscarProveedor").show();
        $("#buscarProveedor").focus();
    });
    $("#AbrirVtnBuscarProveedor").click(function() {
        buscarProveedor();
        $("#buscarProveedor").focus();
        $("#VtnBuscarProveedor").show();
        $("#buscarProveedor").focus();
    });

    $("#buscarInsumo").keypress(function(event) {
        if (event.which == 13) {
            event.preventDefault();
            buscarInsumo();
        }
    });

    $("#btn_buscarInsumo").click(function() {
        buscarInsumo();
        $("#buscarInsumo").focus();
    });

    $("#buscarProveedor").keypress(function(event) {
        if (event.which == 13) {
            event.preventDefault();
            buscarProveedor();
        }
    });

    $("#btn_buscarProveedor").click(function() {
        buscarProveedor();
        $("#buscarProveedor").focus();
    });

    $("#cantidad").keyup(function() {
        setImporte();
    });
    
    $("#precio").keyup(function() {
        setImporte();
    });
    $("#preciounitario").blur(function() {
        var preciounitario = parseFloat($(this).val());
        if (isNaN(preciounitario)) {
            preciounitario = 0;
        }
        $(this).val(preciounitario.toFixed(2));
    });

    $("#addDetalle").click(function() {
        bval = true;
        bval = bval && $("#producto").required();
        bval = bval && $("#cantidad").required();
        bval = bval && $("#precio").required();

        if (bval) {
            if ($(".id_prod[value=" + $("#id_producto").val() + "]").length && $(".id_alm[value=" + $("#id_almacen").val() + "]").length) {
                bootbox.alert("Este insumo ya fue agregado");
                return false;
            }
            var html = '<tr class="row_tmp">';
            html += '<td>';
            html += '   <input type="hidden" name="id_producto[]" class="id_prod" value="' + $("#id_producto").val() + '" />' + $("#producto").val();
            html += '</td>';
            html += '<td>';
            html += '   <input type="hidden" name="id_almacen[]" class="id_alm" value="' + $("#id_almacen").val() + '" />' + $("#almacen").val();
            html += '</td>';
            html += '<td>';
            html += '   <input type="hidden" name="cantidad[]" value="' + $("#cantidad").val() + '" />' + $("#cantidad").val();
            html += '</td>';
            html += '<td>';
            html += '   <input type="hidden" name="precio[]" value="' + $("#precio").val() + '" />' + $("#precio").val();
            html += '</td>';
            html += '<td>';
            html += '   <input type="hidden" name="importe[]" class="importe" value="' + $("#importe").val() + '" />' + $("#importe").val();
            html += '</td>';
            html += '<td>';
            html += '   <a class="btn btn-danger delete"><i class="icon-trash icon-white"></i></a>';
            html += '</td>';
            html += '</tr>';

            $("#tblDetalle").append(html);
            setTotal($("#importe").val(), 1);
            limpiar();
        }
    });

    $(".delete").live('click', function() {
        var i = $(this).parent().parent().index();
        var importe = $("#tblDetalle tr:eq(" + i + ") td .importe").val();
        $("#tblDetalle tr:eq(" + i + ")").remove();
        setTotal(importe, 0);
    });
    $("#reg_proveedor").click(function() {
        rs = $("#razonsocialprov").val();
        prov = $("#nombreprov").val();
        ruc = $("#rucprov").val();
        dir = $("#direccionprov").val();
        tel = $("#telefmovilprov").val();
        email = $("#emailprov").val();
        ciu = $("#ciudadprov").val();
        if (rs == "") {
            alert("Ingrese Razon Social");
            $("#razonsocialprov").focus();
        }
        else {
            if (prov == "") {
                alert("Ingrese Representante");
                $("#nombreprov").focus();
            }
            else {
                if (ruc == "") {
                    alert("Ingrese Ruc");
                    $("#rucprov").focus();
                }
                else {
                    if (dir == "") {
                        alert("Ingrese Direccion");
                        $("#direccionprov").focus();
                    }
                    else {
                        if (tel == "") {
                            alert("Ingrese Telefono");
                            $("#telefmovilprov").focus();
                        }
                        else {
                            if (email == "") {
                                alert("Ingrese Email");
                                $("#emailprov").focus();
                            }
                            else {
                                if (ciu == "") {
                                    alert("Ingrese Ciudad");
                                    $("#ciudadprov").focus();
                                }
                                else {
                                    $.post(url + 'compra/inserta_prov', 'nombre=' + $("#nombreprov").val() + '&dir=' + $("#direccionprov").val() + '&rs=' + $("#razonsocialprov").val() +
                                            '&em=' + $("#emailprov").val() + '&ciu=' + $("#ciudadprov").val() + '&ruc=' + $("#rucprov").val() + '&tel=' + $("#telefmovilprov").val(), function(datos) {
                                        $("#id_proveedor").val(datos.id_proveedor);
                                        $("#proveedor").val($("#razonsocialprov").val());
                                        $('#modalNuevoProveedor').modal('hide');
                                        $("#razonsocialprov,#nombreprov,#rucprov,#direccionprov,#telefmovilprov,#emailprov,#ciudadprov").val('');
                                    }, 'json')
                                }
                            }
                        }
                    }
                }
            }
        }
    });
});

function setImporte() {
    var cantidad = $("#cantidad").val();
    cantidad = parseInt(cantidad);
    if (isNaN(cantidad)) {
        cantidad = 0;
    }
    var precio = $("#precio").val();
    precio = parseFloat(precio);
    if (isNaN(precio)) {
        precio = 0;
    }
    var importe;
    importe = cantidad * precio;
    $("#importe").val(importe.toFixed(2));
}

function setTotal(importe, aumenta) {
    var subtotal = $("#subtotal").val();
    subtotal = parseFloat(subtotal);
    if (isNaN(subtotal)) {
        subtotal = 0;
    }
    var igv = $("#igv").val();
    igv = parseFloat(igv);
    if (isNaN(igv)) {
        igv = 0;
    }
    if (aumenta) {
        subtotal = subtotal + parseFloat(importe);
    } else {
        subtotal = subtotal - parseFloat(importe);
    }
    $("#subtotal").val(subtotal.toFixed(2));
    var total = subtotal + subtotal * igv;
    $("#total").val(total.toFixed(2));
}
function buscarInsumo() {
    $("#title_almacen").html('<h4>'+$( "#sel_almacen option:selected" ).text()+'</h4>');
    $("#grillaInsumo").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');
    $("#grillaProveedor").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');
    $.post(url + 'producto/buscador','id_almacen=' + $("#sel_almacen").val(), function(datos) {
        var HTML = '<table id="table2" class="display" cellspacing="0" width="100%">' +
                '<thead>' +
                '<tr>' +
                '<th>Item</th>'+
                '<th>Producto</th>'+
                '<th>Presentacion</th>'+
                '<th>Categoria</th>'+
                '<th>Marca</th>'+
                '<th>Acciones</th>'+
                '</tr>' +
                '</thead>' +
                '<tbody>';

        for (var i = 0; i < datos.length; i++) {
            HTML = HTML + '<tr>';
            HTML = HTML + '<td>'+(i+1)+'</td>';
            HTML = HTML + '<td>'+datos[i].NOMBRE+'</td>';
            HTML = HTML + '<td>'+datos[i].PRESENTACION+'</td>';
            HTML = HTML + '<td>'+datos[i].DESCRIPCION_CAPR+'</td>';
            HTML = HTML + '<td>'+datos[i].DESCRIPCION_MAR+'</td>';
            var id_producto = datos[i].ID_PRODUCTO;
            var id_almacen =$("#sel_almacen").val();
            var nombre = datos[i].NOMBRE;
            var almacen = $( "#sel_almacen option:selected" ).text();
            var stock = datos[i].STOCK_ALMACEN;
            var precioc = datos[i].PRECIO;
            HTML = HTML + '<td><a style="margin-right:4px" href="javascript:void(0)" onclick="sel_insumo(\'' + id_producto + '\',\'' + id_almacen + '\',\'' + almacen + '\',\'' + nombre + '\',\'' + stock + '\',\'' + precioc + '\')" class="btn btn-success"><i class="icon-ok icon-white"></i> </a>';
            HTML = HTML + '</td>';
            HTML = HTML + '</tr>';
        }
        HTML = HTML + '</tbody></table>'
        $("#grillaInsumo").html(HTML);
        $("#jsfoot").html('<script src="' + url + 'vista/compra/js/run_table.js"></script>');
    }, 'json');
}

function buscarProveedor() {
    $("#grillaInsumo").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');
    $("#grillaProveedor").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');
    $.post(url + 'proveedor/buscador', function(datos) {
        var HTML = '<table id="table2" class="display" cellspacing="0" width="100%">' +
                '<thead>' +
                '<tr>' +
                '<th>Item</th>' +
                '<th>Razon Social</th>' +
                '<th>Ruc</th>' +
                '<th>Telefono</th>' +
                '<th>Acciones</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>';

        for (var i = 0; i < datos.length; i++) {
            HTML = HTML + '<tr>';
            HTML = HTML + '<td>' + (i + 1) + '</td>';
            HTML = HTML + '<td>' + datos[i].RAZON_SOCIAL + '</td>';
            HTML = HTML + '<td>' + datos[i].RUC + '</td>';
            HTML = HTML + '<td>' + datos[i].TELEFONO + '</td>';
            var idproveedor = datos[i].ID_PROVEEDOR;
            var descripcion = $.trim(datos[i].RAZON_SOCIAL);
            var ruc         = datos[i].RUC;
            HTML = HTML + '<td><a style="margin-right:4px" href="javascript:void(0)" onclick="sel_proveedor(\'' + idproveedor + '\',\'' + descripcion + '\',\'' + ruc + '\')" class="btn btn-success"><i class="icon-ok icon-white"></i> </a>';
            HTML = HTML + '</td>';
            HTML = HTML + '</tr>';
        }
        HTML = HTML + '</tbody></table>';
        $("#grillaProveedor").html(HTML);
        $("#jsfoot").html('<script src="' + url + 'vista/compra/js/run_table.js"></script>');
    }, 'json');
}

function sel_insumo(id_p,id_a,a, d, s, pc) {
    $("#cantidad,#precio").attr('disabled', false);
    $("#id_almacen").val(id_a);
    $("#almacen").val(a);
    $("#id_producto").val(id_p);
    $("#producto").val(d);
    $("#stockactual").val(s);
    $("#precio").val(parseFloat(pc).toFixed(2));
    $('#modalInsumo').modal('hide');
    $("#cantidad").focus();
    setImporte()
}

function sel_proveedor(id_p, d,ruc) {
    $("#id_proveedor").val(id_p);
    $("#proveedor").val(d);
    $("#ruc_prov").val(ruc);
    $('#modalProveedor').modal('hide');
    $("#id_tipopago").focus();
}

f

function limpiar() {
    $("#id_producto,#id_almacen,#stockactual,#producto,#cantidad,#precio,#importe").val('');
    $("#cantidad,#precio").attr('disabled', true);
}

function seleccionaDias(fecha_final) {
    fecha_inicio = $("#fechacompra").val();
    if (fecha_inicio == '') {
        bootbox.alert("Escoja una fecha valida");
        $("#fecha_vencimiento").val('');
        return;
    }
    var dias = getDias($(fecha_final).val(), fecha_inicio);
    if (dias <= 0) {
        bootbox.alert("Escoja una fecha valida");
        $("#fecha_vencimiento").val('');
    }
}