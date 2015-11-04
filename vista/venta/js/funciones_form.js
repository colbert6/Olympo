$(function() {
    $("#socio").focus();
    $("#socio").click(function(){
        buscarSocio();
        $("#VtnBuscarSocio").show();
    });
    $("#AbrirVtnBuscarSocio").click(function(){
         buscarSocio();
        $("#VtnBuscarSocio").show();
    });
    
    $("#id_tipopago").change(function(){
        if($(this).val()==2){
            $("#celda_credito").show();
        }else{
            $("#celda_credito").hide();
        }
    });
    $("#sel_tipo_documento").change(function(){
        $.post(url+'venta/getCorrelativo','id_tipo_documento='+$("#sel_tipo_documento").val(),function(datos){
            $("#nrodoc").val(datos);
        });
    });
    
    $("#sel_venta").change(function(){
        if($(this).val()==2){
            $("#celda_matricula").hide();
            $("#celda_producto").show();    
        }else{
            $("#celda_producto").hide();
            $("#celda_matricula").show();
        }
    });
    //  \/-\/-\/-\/-\/------PRODUCTOS--------\/-\/-\/-\/-\/-------//
    $("#producto").click(function() {
        bval = true;   
        bval = bval && $("#sel_almacen").required();
        if (!bval) 
        {
           return false;
        }
        buscarProducto();
        $("#VtnBuscarProducto").show();
    });
    $("#AbrirVtnBuscarProducto").click(function() {
         bval = true;   
        bval = bval && $("#sel_almacen").required();
        if (!bval) 
        {
           return false;
        }
        buscarProducto();
        $("#VtnBuscarProducto").show();
    });
    $("#addDetalleProducto").click(function(){
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
            html += '   <a id="delete_producto" class="btn btn-danger delete"><i class="icon-trash icon-white"></i></a>';
            html += '</td>';
            html += '</tr>';

            $("#tblDetalleProductos").append(html);
            setTotal($("#importe").val(), 1);
            limpiar_producto();
        }
    });
    
    $("#delete_producto").live('click', function() {
        alert('Producto eliminado de la Lista');
        var i = $(this).parent().parent().index();
        var importe = $("#tblDetalleProductos tr:eq("+i+") td .importe").val();
        $("#tblDetalleProductos tr:eq("+i+")").remove();
        setTotal(importe,0);
    });
    // /\-/\-/\-/\-/\-/\---PRODUCTOS--------/\-/\-/\-/\-/\-/\------//
    
    $("#subtotal,#total,#igv").val('0.00');
    
    $("#chbx_igv").click(function(){
        if($("#chbx_igv").is(':checked')){
            $.post(url+'venta/getParam','id_param=IGV',function(datos){
                $("#igv").val(datos[0].VALOR);
                setTotal(0, 1);
            },'json');
        }else{
            $("#igv").val('0.00');
        }
        setTotal(0, 1);
    });
    $("input:text[readonly=readonly]").css('cursor','pointer');
    
    limpiar();
    $("#fechaventa").datepicker({dateFormat:'yy-mm-dd',changeMonth:true,changeYear:true});
    
    $( "#save" ).click(function(){
        bval = true;   
        bval = bval && $("#cliente").required();
        bval = bval && $("#id_tipocomprobante").required();
        bval = bval && $("#id_tipopago").required();
        if(bval && $("#id_tipopago").val()==2){
            bval = bval && $("#fecha_vencimiento").required();
            bval = bval && $("#intervalo_dias").required();
            var aceptacredito = $("#aceptacredito").val();
            if(bval && aceptacredito == '1'){
                var total = parseFloat($("#total").val());
                var maximocredito = parseFloat($("#maximocredito").val());
                if(bval && total > maximocredito){
                    bootbox.alert("No puede otorgarle un crédito mayor de S/. "+maximocredito);
                    bval = false;
                }
            } else{
                bootbox.alert("Límite de crédito superado");
                bval = false;
            }
        }
        if (bval) {
            if( $(".row_tmp").length ) {
                bootbox.confirm("¿Está seguro que desea guardar la venta?", function(result) {
                    if(result){
                        $("#frm").submit();
                    }
                });
            }else{
                bootbox.alert("Agregue los servicios al detalle");
            }
        }
        return false;
    });
    
    $("#selectServicio").click(function(){
        buscarServicio();
        $("#buscarServicio").focus();
        $("#VtnBuscarServicio").show();
    });
    $("#servicio").click(function(){
        buscarServicio();
        $("#buscarServicio").focus();
        $("#VtnBuscarServicio").show();
        $("#buscarServicio").focus();
    });
    $("#AbrirVtnBuscarServicio").click(function(){
        buscarServicio();
        $("#buscarServicio").focus();
        $("#VtnBuscarServicio").show();
        $("#buscarServicio").focus();
    });
    
    $("#buscarServicio").keypress(function(event){
        if(event.which == 13){
            event.preventDefault();
            buscarServicio();
        } 
    });
    $("#btn_buscarServicio").click(function(){
        buscarServicio();
        $("#buscarServicio").focus();
    });
    $("#btn_buscarCliente").click(function(){
        buscarCliente();
        $("#buscarCliente").focus();
    });
    $("#cantidad").keyup(function(){
        setImporte();
    });
    $("#precio").keyup(function(){
        setImporte();
    });
    $("#precio").blur(function(){
        var precio = parseFloat($(this).val());
        if (isNaN(precio)) {
            precio = 0;
        }
        $(this).val(precio.toFixed(2));
    });
    
    
});

function setImporte(){
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

function setTotal(importe,aumenta){
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
    if(aumenta){
        subtotal = subtotal + parseFloat(importe);
    }else{
        subtotal = subtotal - parseFloat(importe);
    }
    $("#subtotal").val(subtotal.toFixed(2));
    var total = subtotal + subtotal * igv;
    $("#total").val(total.toFixed(2));
}

function buscarSocio() {
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
            HTML = HTML + '<td><a style="margin-right:4px" href="javascript:void(0)" onclick="sel_socio(\'' + id_socio + '\',\'' + socio + '\')" class="btn btn-success"><i class="icon-ok icon-white"></i> </a>';
            HTML = HTML + '</td>';
            HTML = HTML + '</tr>';
        }
        HTML = HTML + '</tbody></table>';
        $("#grillaSocio").html(HTML);
        $("#jsfoot").html('<script src="' + url + 'vista/venta/js/run_table.js"></script>');
    }, 'json');
}
function buscarProducto() {
    $("#title_almacen").html('<h4>'+$( "#sel_almacen option:selected" ).text()+'</h4>');
    $("#grillaSocio").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');
    $("#grillaProducto").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');
    $.post(url + 'producto/buscador','id_almacen=' + $("#sel_almacen").val(), function(datos) {
        var HTML = '<table id="table2" class="display" cellspacing="0" width="100%">' +
                '<thead>' +
                '<tr>' +
                '<th>Item</th>'+
                '<th>Producto</th>'+
                '<th>Presentacion</th>'+
                '<th>Categoria</th>'+
                '<th>Marca</th>'+
                '<th>Stock</th>'+
                '<th>Acciones</th>'+
                '</tr>' +
                '</thead>' +
                '<tbody>';

        for (var i = 0; i < datos.length; i++) {
            HTML = HTML + '<tr>';
            HTML = HTML + '<td>'+(i+1)+'</td>';
            HTML = HTML + '<td>'+datos[i].NOMBRE+'</td>';
            HTML = HTML + '<td>'+datos[i].PRESENTACION+'</td>';
            HTML = HTML + '<td>'+datos[i].CATEGORIA+'</td>';
            HTML = HTML + '<td>'+datos[i].MARCA+'</td>';
            HTML = HTML + '<td>'+datos[i].STOCK_ALMACEN+'</td>';
            var id_producto = datos[i].ID_PRODUCTO;
            var id_almacen =$("#sel_almacen").val();
            var nombre = datos[i].NOMBRE;
            var almacen = $( "#sel_almacen option:selected" ).text();
            var stock = datos[i].STOCK_ALMACEN;
            var precioc = datos[i].PRECIO;
            HTML = HTML + '<td><a style="margin-right:4px" href="javascript:void(0)" onclick="sel_producto(\'' + id_producto + '\',\'' + id_almacen + '\',\'' + almacen + '\',\'' + nombre + '\',\'' + stock + '\',\'' + precioc + '\')" class="btn btn-success"><i class="icon-ok icon-white"></i> </a>';
            HTML = HTML + '</td>';
            HTML = HTML + '</tr>';
        }
        HTML = HTML + '</tbody></table>'
        $("#grillaProducto").html(HTML);
        $("#jsfoot").html('<script src="' + url + 'vista/venta/js/run_table.js"></script>');
    }, 'json');
}

function buscarMembresia(){
    $("#grillaServicio").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');
    $("#grillaCliente").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');
    $("#modalServicio").modal('show');
    $.post(url+'servicio/buscador','descripcion='+$("#buscarServicio").val()+'&filtro='+$("#filtroServicio").val(),function(datos){
        HTML = '<table id="table" class="table table-striped table-bordered table-hover sortable">'+
        '<thead>'+
        '<tr>'+
        '<th>Item</th>'+
        '<th>Descripcion</th>'+
        '<th>Tipo Servicio</th>'+
        '<th>Acciones</th>'+
        '</tr>'+
        '</thead>'+
        '<tbody>';

        for(var i=0;i<datos.length;i++){
            var idservicio = datos[i].ID_SERVICIO;
            var descripcion = datos[i].DESCRIPCION;
            HTML = HTML + '<tr>';
            HTML = HTML + '<td>'+(i+1)+'</td>';
            HTML = HTML + '<td>'+descripcion+'</td>';
            HTML = HTML + '<td>'+datos[i].TTIPOSERVICIO+'</td>';
            HTML = HTML + '<td><a style="margin-right:4px" href="javascript:void(0)" onclick="sel_servicio(\''+idservicio+'\',\''+descripcion+'\')" class="btn btn-success btn-minier"><i class="icon-ok icon-white"></i> </a>';
            HTML = HTML + '</td>';
            HTML = HTML + '</tr>';
        }
        HTML = HTML + '</tbody></table>';
        $("#grillaServicio").html(HTML);
        $("#jsfoot").html('<script src="'+url+'vista/web/js/scriptgrilla.js"></script>');
    },'json');
}
function sel_producto(id_p,id_a,a, p, s, pc) {
    $("#cantidad,#precio").attr('disabled', false);
    $("#id_almacen").val(id_a);
    $("#almacen").val(a);
    $("#id_producto").val(id_p);
    $("#producto").val(p);
    $("#stockactual").val(s);
    $("#precio").val(parseFloat(pc).toFixed(2));
    $('#modalProducto').modal('hide');
    $("#cantidad").focus();
    setImporte()
}

function sel_servicio(id_s,s){
    getUnidadesServicio(id_s);
    $("#cantidad, #precio").val('');
    $("#cantidad, #precio").attr('disabled',false);
    $("#id_servicio").val(id_s);
    $("#servicio").val(s);
    $('#modalServicio').modal('hide');
    $("#cantidad").focus();
}


function sel_socio(id_s,soc){
    $("#id_socio").val(id_s);
    $("#socio").val(soc);
    $('#modalSocio').modal('hide');
    $("#sel_tipo_documento").focus();
}

function limpiar_producto(){
    $("#id_producto,#producto,#id_almacen,#stockactual,#producto,#cantidad,#precio,#importe").val('');
    $("#cantidad,#precio").attr('disabled',true);
}
function limpiar(){
    $("#id_servicio,#servicio,#cantidad,#cantidadub,#precio,#importe").val('');
    $("#cantidad,#precio").attr('disabled',true);
    $("#id_unidadmedida").html('<option value="0">Unid. Med.:</option>');
}
