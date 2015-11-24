$(function() {
    $("#id_tipopago").change(function() {
        if ($(this).val() == 2) {
            $("#celda_credito").show();
        } else {
            $("#celda_credito").hide();
            limpiar_tipo_pago();
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
    
    $("#fechacompra").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true});
    
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
                if($("#id_tipopago").val()==2){
                    if (!$("#CronogramaAbierto").is(':checked')) {
                        crearCuotas();
                    }
                    if ($("#restante_cuota").val()!=0 && $("#restante_cuota").val()!='0.00') {
                        mostrar_ver_cuotas();
                        return false;
                    }
                }
                
                bootbox.confirm("¿Está seguro que desea guardar la compra?", function(result) {
                    if (result) {
                        
                        $("#celda_cronograma").html($("#grillaCuotas").html()); 
                        $("#frm").submit();
                    }
                });
                
                                
            } else {
                bootbox.alert("Agregue los Productos al detalle");
            }
        }
        return false;
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
    $("#proveedor").focus(function() {
        buscarProveedor();
        $("#VtnBuscarProveedor").show();
    });
    $("#AbrirVtnBuscarProveedor").click(function() {
        buscarProveedor();
        $("#VtnBuscarProveedor").show();
    });
    
    $("#verCuotas").click(function() {
        mostrar_ver_cuotas();
    });
    
    $("#CronogramaAbierto").click(function() {
        if ($("#CronogramaAbierto").is(':checked')) {
            var completo= mostrar_ver_cuotas();
            if(completo){
                $("#verCuotas").show();
                limpiar_cuotas();
            }
            
            
        } else {
            quitar_cronograma_abierto()
        }
    });
    
    $("#guardar_cuotas").click(function() {    
        $("#estado_cronograma").val('1');
    });
    $("#cuotas").keyup(function() {
        quitar_cronograma_abierto()
        
    });
    $("#intervalo").keyup(function() {
        quitar_cronograma_abierto()
    });

    $("#cantidad").keyup(function() {
        setImporte();
    });
    
    $("#precio").keyup(function() {
        setImporte();
    });
    $("#precio").blur(function(){
        var precio = parseFloat($(this).val());
        if (isNaN(precio)) {
            precio = 0;
        }
        $(this).val(precio.toFixed(2));
    });

    $("#addDetalle").click(function() {
        bval = true;
        bval = bval && $("#producto").required();
        bval = bval && $("#cantidad").required();
        bval = bval && $("#precio").required();

        if (bval) {
            if ($(".id_prod[value=" + $("#id_producto").val() + "]").length && $(".id_alm[value=" + $("#id_almacen").val() + "]").length) {
                bootbox.alert("Este producto ya fue agregado");
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
            quitar_cronograma_abierto()
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
        if (rs == "") {
            alert("Ingrese Razon Social");
            $("#razonsocialprov").focus();
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
                                $.post(url + 'compra/inserta_prov', 'dir=' + $("#direccionprov").val() + '&rs=' + $("#razonsocialprov").val() +
                                        '&em=' + $("#emailprov").val() + '&ciu=' + $("#ciudadprov").val() + '&ruc=' + $("#rucprov").val() + '&tel=' + $("#telefmovilprov").val(), function(datos) {
                                    $("#id_proveedor").val(datos.id_proveedor);
                                    $("#proveedor").val($("#razonsocialprov").val());
                                    $("#ruc_prov").val($("#rucprov").val());
                                    $('#modalNuevoProveedor').modal('hide');
                                    $("#razonsocialprov,#rucprov,#direccionprov,#telefmovilprov,#emailprov,#ciudadprov").val('');
                                }, 'json')
                            
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
    $.post(url + 'producto/buscador', function(datos) {
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
function crearCuotas() {
                
    $("#grillaInsumo").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');
    $("#grillaProveedor").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');   
        
        var HTML = '<table id="table" class="table table-bordered"  width="100%">' +
            '<thead>' +
            '<tr>' +
            '<th>Nro</th>' +
            '<th>Fecha Vencimiento</th>' +
            '<th>Monto</th>'
            '</tr>' +
            '</thead>' +
            '<tbody>';
    
        var letras = $("#cuotas").val();
        var c=letras;   
    
        if($("#estado_cronograma").val()==0){
            
            var monto = $("#total").val();
            var intervalo_dias = $("#intervalo").val();

               
            var nueva_fecha = new Date();
                month = nueva_fecha.getMonth()+1;
                day = nueva_fecha.getDate();
                year = nueva_fecha.getFullYear();

                month = (month < 10) ? ("0" + month) : month;
                day = (day < 10) ? ("0" + day) : day;   
            var fecha_actual=  year + '-' + month + '-' +day  ;
            
            var fecha_temp = new Date();
            var monto_pagado = 0;
            var cuota = [];
            var pago_mensual = parseInt(monto / c);

            for(var i=1;i<=c;i++){
                cuota[i]=pago_mensual;
                monto_pagado = monto_pagado + pago_mensual;  
            }
            if(monto_pagado !== monto){
                cuota[c]=(cuota[c] + (monto- monto_pagado)).toFixed(2);
            }

            fecha_temp.setDate (fecha_temp.getDate() + parseInt(intervalo_dias));
            var month ;
            var day ;
            var year;

            for (var i = 1; i<=c; i++) {

                month = fecha_temp.getMonth()+1;
                day = fecha_temp.getDate();
                year = fecha_temp.getFullYear();

                month = (month < 10) ? ("0" + month) : month;
                day = (day < 10) ? ("0" + day) : day;            
                
                var valor= parseFloat(cuota[i]).toFixed(2)
                
                HTML = HTML + '<tr>';
                HTML = HTML + '<td>' + i + '</td>';
                HTML = HTML + '<td>';
                HTML = HTML + '   <input type="date" name="fecha_cuota[]" id="fecha_cuota'+i+'" readonly class="fecha_cuota" value="'+year + '-' + month + '-' +day+'"  min="'+fecha_actual+'"  max="3500-12-31" />';
                HTML = HTML + '</td>';
                HTML = HTML + '<td>';
                HTML = HTML + '   <input type="text" value="'+valor+'" maxlength="10"  name="monto_cuota[]" id="monto_cuota'+i+'" class="monto_cuotas" onkeypress="return dosDecimales(event,this)" onblur="montoCuota('+i+')" />';
                HTML = HTML + '</td>';
                HTML = HTML + '</tr>';

                fecha_temp.setDate (fecha_temp.getDate() + parseInt(intervalo_dias));

            }
            HTML = HTML + '</tbody></table>';
            HTML = HTML+'<div class="form-group col-md-6 style="float:left;" >'+
                           '<label class="control-label col-md-4">Restante:</label>'+
                           '<div class="col-md-7">'+    
                               '<input id="restante_cuota" name="restante_cuota" readonly class="form-control" value="0.00" >'+
                           '</div>'+
                        '</div>' ;
            HTML = HTML+'<div class="form-group col-md-6 " style="float:left;" >'+
                           '<label class="control-label col-md-3">Total:</label>'+
                           '<div class="col-md-8">'+    
                               '<input id="total_en_cuotas" name="total_en_cuotas" readonly class="form-control" value="'+$("#total").val()+'" >'+
                           '</div>'+
                        '</div>'+
                        '<br>'
                        ;
            
            $("#grillaCuotas").html(HTML);
            $("#guardar_cuotas").show(); 
            
        
        }
          
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

function limpiar() {
    $("#id_producto,#producto,#id_almacen,#stockactual,#producto,#cantidad,#precio,#importe").val('');
    $("#cantidad,#precio").attr('disabled', true);
    
}
function limpiar_tipo_pago() {
    $("#intervalo,#cuotas").val('');
    $("#estado_cronograma").val('0');
    document.getElementById("CronogramaAbierto").checked=false;
    
}
function mostrar_ver_cuotas() {
    if($("#id_tipopago").val()=='2'){
                bval = true;
                bval = bval && $("#cuotas").required();
                bval = bval && $("#intervalo").required();
                if (bval) {
                    if($("#cuotas").val()<=0 || $("#intervalo").val()<=0){
                        return false;
                    }
                    var total=$("#total").val();
                    if($("#cuotas").val()>= parseInt(total)){
                        bootbox.alert("Numero de cuotas invalido, por ser Mayor al total ");
                        $("#cuotas").focus();
                        return false;
                    }
                    crearCuotas();
                    $("#modalCuotas").modal('show');
                    $("#VtnCuotas").show();
                    return true

                }else{
                    return false;
                }

    }
}
function quitar_cronograma_abierto() {
    $("#estado_cronograma").val('0');
    document.getElementById("CronogramaAbierto").checked=false;
     $("#verCuotas").hide();
    
}
function limpiar_cuotas() {
    for(var i=1;i<=$("#cuotas").val();i++){
        $("#monto_cuota"+i).val('0.00');
    }
    $("#restante_cuota").val($("#total").val());
    
}

function montoCuota(num) {
    var restante,
        suma_monto_cuotas=0,
        total=$("#total").val();
    
    if (isNaN($("#monto_cuota"+num).val()) || $("#monto_cuota"+num).val()=='') {
        $("#monto_cuota"+num).val('0.00');
    }else{
         var valor=(parseFloat($("#monto_cuota"+num).val()).toFixed(2));
        $("#monto_cuota"+num).val(valor);
    }

    for(var i=1;i<=$("#cuotas").val();i++){
        suma_monto_cuotas=(parseFloat(suma_monto_cuotas)+parseFloat($("#monto_cuota"+i).val())).toFixed(2);
    }
    restante=(parseFloat(total)-parseFloat(suma_monto_cuotas)).toFixed(2);
    
    if(restante<0){
       var exceso= (parseFloat($("#monto_cuota"+num).val())+parseFloat(restante)).toFixed(2);
       $("#monto_cuota"+num).val(exceso)
       $("#restante_cuota").val(0);
       $("#guardar_cuotas").show();
    }else{
       $("#restante_cuota").val(restante);
       if(restante==0){
           $("#guardar_cuotas").show();
       }else{
          $("#guardar_cuotas").hide();
       }
       
    }
    
}
