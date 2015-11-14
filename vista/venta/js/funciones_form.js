$(function() {
    $("#cliente").focus();
    $("#cliente").click(function(){
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
            limpiar_membresia();
            
        }else if($(this).val()==1){
            $("#celda_producto").hide();
            $("#celda_matricula").show();
            limpiar_producto();
        }else{
            $("#celda_producto").hide();
            $("#celda_matricula").hide();
            limpiar();
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
            html += '   <input type="hidden" name="id_tipo[]" value="p" />Producto' ;
            html += '</td>';
            html += '<td>';
            html += '   <input type="hidden" name="id_vendido[]" class="id_prod" value="' + $("#id_producto").val() + '" />' + $("#producto").val();
            html += '</td>';
            html += '<td>';
            html += '   <input type="hidden" name="id_campo2[]" class="id_alm" value="' + $("#id_almacen").val() + '" />' + $("#almacen").val();
            html += '</td>';
            html += '<td>';
            html += '   <input type="hidden" name="numero[]" value="' + $("#cantidad").val() + '" />' + $("#cantidad").val();
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
            limpiar_producto();
        }
    });
    // /\-/\-/\-/\-/\-/\---PRODUCTOS--------/\-/\-/\-/\-/\-/\------//
    // 
     //  \/-\/-\/-\/-\/------MEMBRESIA--------\/-\/-\/-\/-\/-------//
    $("#membresia").click(function() {
        buscarMembresia();
        $("#VtnBuscarMembresia").show();
    });
    $("#AbrirVtnBuscarMembresia").click(function() {
        buscarMembresia();
        $("#VtnBuscarMembresia").show();
    });
    $("#addDetalleMembresia").click(function(){
        bval = true;   
        bval = bval && $("#membresia").required();
        bval = bval && $("#fecha_ini").required();
        bval = bval && $("#precio_m").required();
         if (bval) {
            if ($(".id_mat[value=" + $("#id_matricula").val() + "]").length ) {
                bootbox.alert("Esta matricula ya fue agregado");
                return false;
            }
            var html = '<tr class="row_tmp">';
            html += '<td>';
            html += '   <input type="hidden" name="id_tipo[]" value="m" />Membresia' ;
            html += '</td>';
            html += '<td>';
            html += '   <input type="hidden" name="id_vendido[]" class="id_mat" value="' + $("#id_matricula").val() + '" />' + $("#membresia").val();
            html += '</td>';
            html += '<td>';
            html += '   <input type="hidden" name="id_campo2[]"  value="' + $("#id_membresia").val() + '" />' + $("#socio").val();
            html += '</td>';
            html += '<td>';
            html += '   <input type="hidden" name="numero[]" value="' + $("#fecha_ini").val() + '" />' + $("#fecha_ini").val();
            html += '</td>';
            html += '<td>';
            html += '   <input type="hidden" name="precio[]" value="' + $("#precio_m").val() + '" />' + $("#precio_m").val();
            html += '</td>';
            html += '<td>';
            html += '   <input type="hidden" name="importe[]" class="importe" value="' + $("#precio_m").val() + '" />' + $("#precio_m").val();
            html += '</td>';
            html += '<td>';
            html += '   <a  class="btn btn-danger delete"><i class="icon-trash icon-white"></i></a>';
            html += '</td>';
            html += '</tr>';

            $("#tblDetalle").append(html);
            setTotal($("#precio_m").val(), 1);
            limpiar_membresia();
        }
    });
    
    // /\-/\-/\-/\-/\-/\---MEMBRESIA--------/\-/\-/\-/\-/\-/\------//
    
    $(".delete").live('click', function() {
        var i = $(this).parent().parent().index();
        var importe = $("#tblDetalle tr:eq(" + i + ") td .importe").val();
        $("#tblDetalle tr:eq(" + i + ")").remove();
        setTotal(importe, 0);
    });
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
    $("#fecha_ini").datepicker({dateFormat:'yy-mm-dd',changeMonth:true,changeYear:true});
    
    $("#save").click(function(){
        bval = true;   
        bval = bval && $("#cliente").required();
        bval = bval && $("#sel_tipo_documento").required();
        bval = bval && $("#id_tipopago").required();
        if(bval && $("#id_tipopago").val()==2){
            bval = bval && $("#cuotas").required();
            bval = bval && $("#intervalo").required();
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
    
    
    $("#cantidad").keyup(function(){
        resta=$("#stockactual").val()-$("#cantidad").val();
        if (resta<0) {
            bootbox.alert("Stock Insuficiente");
            $("#cantidad").val('1');
            $("#cantidad").focus();
            return false;
        }
        if (resta<=5 && resta>=0) {
            bootbox.alert("Llegando Stock Minimo");
            return false;
        }
        setImporte();
    });
    $("#cantidad").blur(function(){
        var resta;
        
        
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
    $("#grillaProducto").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');
    $("#grillaMembresia").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');
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
    $("#grillaProducto").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');
    $("#grillaMembresia").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');
    $("#grillaSocio").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');
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

function buscarMembresia() {
    $("#title_almacen").html('<h4>'+$( "#sel_almacen option:selected" ).text()+'</h4>');
    $("#grillaProducto").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');
    $("#grillaMembresia").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');
    $("#grillaSocio").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');
    $.post(url + 'matricula/buscador', function(datos) {
        var HTML = '<table id="table2" class="display" cellspacing="0" width="100%">' +
                '<thead>' +
                '<tr>' +
                '<th>Item</th>'+
                '<th>Descripcion</th>'+
                '<th>Socio</th>'+
                '<th>Fecha Registro</th>'+
                '<th>Costo</th>'+
                '<th>Acciones</th>'+
                '</tr>' +
                '</thead>' +
                '<tbody>';

        for (var i = 0; i < datos.length; i++) {
            HTML = HTML + '<tr>';
            HTML = HTML + '<td>'+(i+1)+'</td>';
            HTML = HTML + '<td>'+datos[i].DESCRIPCION+' '+datos[i].DURACION+' '+datos[i].VIGENCIA +'</td>';
            HTML = HTML + '<td>'+datos[i].NOMBRE+' '+datos[i].APELLIDO_PATERNO+'</td>';
            HTML = HTML + '<td>'+datos[i].FECHA_REGISTRO+'</td>';
            HTML = HTML + '<td>'+datos[i].COSTO+'</td>';
            var id_matricula = datos[i].ID_MATRICULA;
            var descripcion = datos[i].DESCRIPCION+' '+datos[i].DURACION+' '+datos[i].VIGENCIA;
            var socio = datos[i].NOMBRE+' '+datos[i].APELLIDO_PATERNO;
            var precio_m = datos[i].COSTO;
            var id_membresia = datos[i].ID_TIPO_MEMBRESIA;
            HTML = HTML + '<td><a style="margin-right:4px" href="javascript:void(0)" onclick="sel_membresia(\'' + id_matricula + '\',\'' + descripcion + '\',\'' + socio + '\',\'' + precio_m +'\',\'' + id_membresia +  '\')" class="btn btn-success"><i class="icon-ok icon-white"></i> </a>';
            HTML = HTML + '</td>';
            HTML = HTML + '</tr>';
        }
        HTML = HTML + '</tbody></table>'
        $("#grillaMembresia").html(HTML);
        $("#jsfoot").html('<script src="' + url + 'vista/venta/js/run_table.js"></script>');
    }, 'json');
}

function sel_socio(id_s,soc){
    $("#id_cliente").val(id_s);
    $("#cliente").val(soc);
    $('#modalSocio').modal('hide');
    $("#sel_tipo_documento").focus();
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
function sel_membresia(id_m,d,s,p,memb){
    $("#fecha_ini, #precio_m").val('');
    $("#fecha_ini, #precio_m").attr('disabled',false);
    $("#id_matricula").val(id_m);
    $("#id_membresia").val(memb);
    $("#membresia").val(d);
    $("#socio").val(s);
    $("#precio_m").val(p);
    $('#modalMembresia').modal('hide');
    $("#fecha_ini").val( $("#fechaventa").val());
}

function limpiar_producto(){
    $("#id_producto,#producto,#id_almacen,#stockactual,#producto,#cantidad,#precio,#importe").val('');
    $("#cantidad,#precio").attr('disabled',true);
}
function limpiar_membresia(){
    $("#id_matricula,#id_membresia,#membresia,#socio,#fecha_ini,#precio_m").val('');
    $("#fecha_ini,#precio_m").attr('disabled',true);
}
function limpiar(){
    limpiar_producto();
    limpiar_membresia();
}
