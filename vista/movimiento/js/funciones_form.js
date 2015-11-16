$(document).ready(function() {    
	//alert("abrio");
	$("#acciones,#cronograma").hide();
    $("#save").attr("disabled",true);
    
   /* $("#id_tipo_movimiento").change(function(){

        if($(this).val()==1){
            mostrarVentas();
        }else if($(this).val()==2){          
            mostrarCompras();
        }else{
                $("#acciones,#cronograma").hide();
        }

    });*/
    $("#buscarActor").click(function() {
        buscarActores();
        $("#form-Actor").show();
    });


});
function validarMovimiento(){
    bval = true;   
    bval = bval && $("#id_forma_pago").required();
    bval = bval && $("#importe").required();
    if (bval){
         bootbox.confirm("¿Está seguro de efectuar el movimiento?", function(result) {
                    if (result) {
                        $("#frm").submit();
                    }
                });
    }else{
        alert("Complete los campos Necesarios");    
    }
    return false;
}
function validarCancelar(id,total){
    
    $("#id_accion").val(id);
    $("#num_cuotas").val('1');
    $("#monto_contado").val(total);
    $("#id_modalidad_t").val('CONTADO');
    
    
    bval = true;   
    bval = bval && $("#id_forma_pago").required();
    if (bval){
        bootbox.confirm("¿Está seguro de efectuar el movimiento?", function(result) {
                    if (result) {
                        $("#frm").submit();
                    }
                });
    }else{
        alert("Complete los campos Necesarios");    
    }
    return false;
}

function validaDistribucion(){
    if($("#importe").val()!=''){
        if(!isNaN($("#importe").val())){
            distribucion();                    
        }else{
            alert("Ingrese Solo Numeros");
            $("#importe").focus();
        }

    }else{
        alert("Ingrese Monto a Amortizar");
        $("#importe").focus();
    }
}
function distribucion(){
     $("#save").attr("disabled",false);

    monto_amortizacion = parseFloat($("#importe").val());
    gasto_total = parseFloat($("#deuda").val());
    total_cuotas = parseFloat($("#num_cuotas").val());
    if(monto_amortizacion>gasto_total){
        alert("Usted solo debe: S/."+$("#deuda").val());
        $("#importe").focus();
    }else{
        var pago = 0;
        var deuda = 0;
        for (var i = 1; i <= total_cuotas; i++) {
            var monto_total = parseFloat(document.getElementById("monto_cuota"+i).value);
            var monto_pagado = parseFloat(document.getElementById("monto_pagado"+i).value);
            var resto = 0;
            if(monto_total > monto_pagado){
                var monto_restante = monto_total - monto_pagado;
                 if(monto_amortizacion!=0){
                    if(monto_restante >= monto_amortizacion){
                        monto_pagado+=monto_amortizacion;
                        resto = monto_total - monto_pagado;
                        monto_amortizacion = 0;
                        document.getElementById("monto_pagado"+i).value = monto_pagado.toFixed(2);
                        document.getElementById("monto_restante"+i).value = resto.toFixed(2);
                    }else{
                        monto_pagado=monto_total;
                        resto = monto_total - monto_pagado;
                        monto_amortizacion -= monto_restante;   
                        document.getElementById("monto_pagado"+i).value = monto_pagado.toFixed(2);
                        document.getElementById("monto_restante"+i).value = resto.toFixed(2);
                    }
                 }
            }
        
        }
        for (var j = 1; j <= total_cuotas; j++) {
            var monto_total = parseFloat(document.getElementById("monto_cuota"+j).value);
            var monto_restante = parseFloat(document.getElementById("monto_restante"+j).value);
            var monto_pagado = parseFloat(document.getElementById("monto_pagado"+j).value);
            pago+=monto_pagado;
            deuda+=monto_restante;

            if(monto_pagado == 0){
                document.getElementById("fila"+j).className = "danger";
                document.getElementById('text_estado'+j).value = 'PENDIENTE';
                document.getElementById('estado'+j).value = '0';
            }else if(monto_pagado>0 && monto_pagado<monto_total){
                document.getElementById("fila"+j).className = "warning";
                document.getElementById('text_estado'+j).value = 'PENDIENTE';
                document.getElementById('estado'+j).value = '0';
            }else if(monto_pagado==monto_total) {
                document.getElementById("fila"+j).className = "success";
                document.getElementById('text_estado'+j).value = 'CANCELADO';
                document.getElementById('estado'+j).value = '1';
            }else{
                clase = 'default';
            }
        }
        
        document.getElementById("pago").value = pago.toFixed(2);
        document.getElementById("deuda").value = deuda.toFixed(2);
        $("#amortizar").attr('disabled',true);
        $("#importe").attr('readonly',true);
        $("#deshacer").attr('disabled',false);
    }

}
function buscarActores(){
	//alert("Entre Buscar Actor");
	$("#grillaActor").html('<div class="page-header"><img src="'+url+'lib/img/loading.gif" /></div>');
    $.post(url + 'movimiento/getActores', function(datos) {
       var HTML = '<table id="table2" class="display" cellspacing="1" width="100%">' +
                '<thead>' +
                '<tr>' +
                '<th>ITEM</th>' +
                '<th>RAZON SOCIAL</th>' +
                '<th>DNI/RUC</th>' +
                '<th>TIPO</th>' +
                '<th>Acciones</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>';

        for (var i = 0; i < datos.length; i++) {
        	var id_actor = datos[i].ID;
        	var tipo_actor = datos[i].FLAG;
            var razon_social = $.trim(datos[i].RAZON_SOCIAL);
            var nro_doc = datos[i].NRO_DOC;
            HTML = HTML + '<tr>';
            HTML = HTML + '<td>' + (i + 1) + '</td>';
            HTML = HTML + '<td>' + datos[i].RAZON_SOCIAL + '</td>';
            HTML = HTML + '<td>' + datos[i].NRO_DOC + '</td>';
            HTML = HTML + '<td>';
            if(datos[i].FLAG == 's'){
            	HTML = HTML + 'Socio';
            }else{
            	HTML = HTML + 'Proveedor';
            }
            HTML = HTML + '</td>';
            HTML = HTML + '<td><a style="margin-right:4px" href="javascript:void(0)" onclick="sel_actor(\'' + id_actor + '\',\'' + tipo_actor + '\',\'' + razon_social + '\',\'' + nro_doc + '\')" class="btn btn-success"><i class="icon-ok icon-white"></i> </a>';
            HTML = HTML + '</td>';
            HTML = HTML + '</tr>';
        }
        HTML = HTML + '</tbody></table>';
        $("#grillaActor").html(HTML);
        $("#jsfoot").html('<script src="' + url + 'vista/movimiento/js/run_table.js"></script>');

    }, 'json');
}

function sel_actor(id_actor,tipo_actor,razon_social,nro_doc) {
    $("#id_tipo_movimiento").html('<option value=\'0\'>Seleccione...</option>');
    $("#id_actor").val(id_actor);
    $("#tipo_actor").val(tipo_actor);
    $("#nro_doc").val(nro_doc);
    $("#razon_social").val(razon_social);
    $('#modalActor').modal('hide');

    if(tipo_actor == 's'){
        $("#tipo_movimiento").val("INGRESO");
        $("#id_concepto_movimiento").val("2");
        mostrarVentas(id_actor);

    }else{
        $("#tipo_movimiento").val("EGRESO");
        $("#id_concepto_movimiento").val("1");
        mostrarCompras(id_actor);
    }
    $("#cronograma").hide();
    $("#importe").attr('readonly',true);
    $("#amortizar").attr('disabled',true);

    //$("#id_tipo_movimiento").focus();
    $("#id_forma_pago").append(new Option('Efectivo','1'));
    $("#id_forma_pago").append(new Option('Tarjeta','2'));
}

function mostrarCompras(id_p){
    $("#acciones").show();
    
    //alert(id_p);
    $.post(url + 'compra/getComprasProveedor',"id_p="+id_p, function(proveedor) {
        $("#num_opc").val(proveedor.length);
        HTML ="";
        HTML +="<legend>Compras Pendientes de Pago</legend>";
        HTML += '<table class=\'table table-striped table-bordered table-hover sortable\'>' +
                '<thead>' +
                    '<tr>' +
                    '<th class=\'text-center\'>ITEM</th>' +
                    '<th class=\'text-center\'>FECHA</th>' +
                    '<th class=\'text-center\'>RETRASO</th>' +
                    '<th class=\'text-center\'>DOCUMENTO</th>' +
                    '<th class=\'text-center\'>MODALIDAD</th>' +
                    '<th class=\'text-center\'>MONTO</th>' +
                    '<th class=\'text-center\'>VER CRONOGRAMA</th>' +
                    '</tr>' +
                '</thead>' +
                '<tbody>';

        for (var i = 0; i < proveedor.length; i++) {
            var importe= (proveedor[i].MONTO*(1+parseFloat(proveedor[i].IGV))).toFixed(2);
            HTML += '<tr>';
            HTML += '   <td class=\'text-center\'>' + (i + 1) + '</td>';
            HTML += '   <td class=\'text-center\'>' + proveedor[i].FECHA + '</td>';
            HTML += '   <td class=\'text-center\'>0</td>';
            HTML += '   <td class=\'text-center\'>' + proveedor[i].NUM_DOCUMENTO + '</td>';
            HTML += '   <td class=\'text-center\'>' + proveedor[i].MODALIDAD_TRANSACCION + '</td>';
            HTML += '   <td class=\'text-center\'>' + (proveedor[i].MONTO*(1+parseFloat(proveedor[i].IGV))).toFixed(2) + '</td>';
            if(proveedor[i].MODALIDAD_TRANSACCION=='CREDITO'){
              HTML += '   <td class=\'text-center\'> <input type=\'checkbox\' onchange=\'validaCheckBox(this)\' name=\'cronograma\' id=\'cronograma'+(i+1)+'\' value=\''+proveedor[i].ID_COMPRA+'\'></td>'; 
            }else{
              HTML += '   <td class=\'text-center\'><a style="margin-right:4px" href="javascript:void(0)" onclick="validarCancelar(\'' + proveedor[i].ID_COMPRA + '\',\'' + importe + '\')" class="btn btn-danger"><i class="icon-ok icon-white"></i>Cancelar </a></td>';    
            }
           HTML += '</tr>';
        }
        HTML += '</tbody></table>';

        $("#acciones").html(HTML);
    }, 'json');

    
}

function mostrarVentas(id_c){
    $("#acciones").show();
    
    $.post(url + 'venta/getVentasCliente',"id_c="+id_c, function(cliente) {
        $("#num_opc").val(cliente.length);
        HTML ="";
        HTML +="<legend>Ventas Pendientes de Pago</legend>";
        HTML += '<table class=\'table table-striped table-bordered table-hover sortable\'>' +
                '<thead>' +
                    '<tr>' +
                    '<th class=\'text-center\'>ITEM</th>' +
                    '<th class=\'text-center\'>FECHA</th>' +
                    '<th class=\'text-center\'>RETRASO</th>' +
                    '<th class=\'text-center\'>DOCUMENTO</th>' +
                    '<th class=\'text-center\'>MODALIDAD</th>' +
                    '<th class=\'text-center\'>MONTO</th>' +
                    '<th class=\'text-center\'>VER CRONOGRAMA</th>' +
                    '</tr>' +
                '</thead>' +
                '<tbody>';

        for (var i = 0; i < cliente.length; i++) {
            var importe= (cliente[i].MONTO*(1+parseFloat(cliente[i].IGV))).toFixed(2);
            HTML += '<tr>';
            HTML += '   <td class=\'text-center\'>' + (i + 1) + '</td>';
            HTML += '   <td class=\'text-center\'>' + cliente[i].FECHA + '</td>';
            HTML += '   <td class=\'text-center\'>0</td>';
            HTML += '   <td class=\'text-center\'>' + cliente[i].NUM_DOCUMENTO + '</td>';
            HTML += '   <td class=\'text-center\'>' + cliente[i].MODALIDAD_TRANSACCION + '</td>';
            HTML += '   <td class=\'text-center\'>' + importe + '</td>';
            if(cliente[i].MODALIDAD_TRANSACCION=='CREDITO'){
              HTML += '   <td class=\'text-center\'> <input type=\'checkbox\' onchange=\'validaCheckBox(this)\' name=\'cronograma\' id=\'cronograma'+(i+1)+'\' value=\''+cliente[i].ID_VENTA+'\'></td>';  
            }else{
              HTML += '   <td class=\'text-center\'><a style="margin-right:4px" href="javascript:void(0)" onclick="validarCancelar(\'' + cliente[i].ID_VENTA + '\',\'' + importe + '\')" class="btn btn-danger"><i class="icon-ok icon-white"></i>Cancelar </a></td>';    
            }
            HTML += '</tr>';
        }
        HTML += '</tbody></table>';

        $("#acciones").html(HTML);
    }, 'json');

    
}


function validaCheckBox(check){
    var total = parseInt($("#num_opc").val());
    var contador = 0;
    for (var i = 1; i <= total; i++) {
        var val = document.getElementById("cronograma"+i);
        if(val.checked){
            contador++;
        }
    }
    if(contador>=2){
        if(confirm("¿Estas Segura de Cambiar de Cronograma?\nOJO!!! Se Perderan los Cambios")){
            for (var i = 1; i <= total; i++) {
                var id = "cronograma"+i;
                
                if(id!=check.getAttribute("id")){
                        var elemento = document.getElementById("cronograma"+i);
                        elemento.checked = false;
                        elemento.disabled = false;
                }
            }
            check.disabled = true;
            $("#importe").attr('readonly',false);
            $("#amortizar").attr('disabled',false);
            if($("#tipo_actor").val()=='s'){
                mostrarCronogramaVenta(check.value);
            }else{
                mostrarCronogramaCompra(check.value);
            }
             
        }else{
            check.checked = false;
        }
    }else{
         for (var i = 1; i <= total; i++) {
                var id = "cronograma"+i;
                
                if(id!=check.getAttribute("id")){
                        var elemento = document.getElementById("cronograma"+i);
                        elemento.checked = false;
                        elemento.disabled = false;
                }
            }
            check.disabled = true;
            $("#importe").attr('readonly',false);
            $("#amortizar").attr('disabled',false);
            if($("#tipo_actor").val()=='s'){
                mostrarCronogramaVenta(check.value);
            }else{
                mostrarCronogramaCompra(check.value);
            } 
    }
    
     
}

function borrar(){
    $("#save").attr("disabled",true);
    var total = parseInt($("#num_opc").val());
    for (var i = 1; i <= total; i++) {
        var elemento = document.getElementById("cronograma"+i);
        if(elemento.checked){
            if($("#tipo_actor").val()=='s'){
                mostrarCronogramaVenta(elemento.value);
            }else{
                mostrarCronogramaCompra(elemento.value);
            }
            $("#amortizar").attr('disabled',false);
            $("#deshacer").attr('disabled',true);
            $("#importe").attr('readonly',false);
            break;        
        }
    } 
}
function mostrarCronogramaCompra(id){
    $("#cronograma").show();
    $("#id_accion").val(id);
    $.post(url + 'cronograma_pago/getCuotasCompra',"id_c="+id, function(cuotas) {
//        alert(cuotas.length);
        var total_pagado = 0;
        var tot_restante = 0;
        var total = 0;
        for (var i = 0; i < cuotas.length; i++) {
                total+= parseFloat(cuotas[i].MONTO_CUOTA);
                total_pagado+= parseFloat(cuotas[i].MONTO_PAGADO);        
        }
        var resto = total - total_pagado;

        //$.post(url + 'cronograma_pago/getSaldoCompra',"id_c="+id, function(saldo) {
            HTML ="";
        
            HTML +="<legend>Cronograma de Pagos</legend>";
            HTML+="<div class=\'row\'>";
            HTML+="    <div class=\'col-md-4\'>";
            HTML+="     <strong> MONTO:</strong>";
            HTML+="         <input type=\"text\" name=\"importe\" id=\"importe\" onkeypress=\"return dosDecimales(event,this)\" placeholder=\"Importe\" class=\"form-control\"  style=\"width: 80px\" />";
            HTML+="         <button type=\"button\" class=\"btn btn-primary btn-sm\"  id=\"amortizar\" onclick='validaDistribucion()'>Distribuir</button>";
            HTML+="         <button type=\"button\" class=\"btn btn-warning btn-sm\"  id=\"deshacer\" onclick='borrar()'><i class=\"icon-repeat icon-white\"></i></button>";
            HTML+="     </div>";
            HTML+="    <div class=\'col-md-4\'>";
            HTML+="        <div class=\'form-group\'>";
            HTML+="            <label class=\'col-md-3 control-label\' >PAGO TOTAL</label>";              
            HTML+="            <div class=\'col-md-8\'>";
            HTML+="                <input name=\'pago\' id=\'pago\' class=\'form-control\'  readonly=\'readonly\' value=\'"+total_pagado.toFixed(2)+"\'>";
            HTML+="            </div>";
            HTML+="        </div>";
            HTML+="    </div>";
            HTML+="    <div class=\'col-md-4 \'>";
            HTML+="        <div class=\'form-group\'>";
            HTML+="            <label class=\'col-md-3 control-label\' > DEUDA TOTAL</label>";              
            HTML+="            <div class=\'col-md-8\'>";
            HTML+="                <input name=\'deuda\' id=\'deuda\' class=\'form-control\'  readonly=\'readonly\' value=\'"+resto.toFixed(2)+"\'>";
            HTML+="            </div>";
            HTML+="        </div>";
            HTML+="    </div>";
            HTML+="</div>";
            HTML+= '<table class=\'table table-striped table-bordered table-hover sortable\'>' +
                    '<thead>' +
                        '<tr>' +
                        '<th class=\'text-center\'># CUOTA</th>' +
                        '<th class=\'text-center\'>FECHA VENC.</th>' +
                        '<th class=\'text-center\'>RETRASO</th>' +
                        '<th class=\'text-center\'>MONTO</th>' +
                        '<th class=\'text-center\'>MONTO PAGADO</th>' +
                        '<th class=\'text-center\'>MONTO RESTANTE</th>' +
                        '<th class=\'text-center\'>ESTADO</th>' +
                        '</tr>' +
                    '</thead>' +
                    '<tbody>';
    //style="border:none; background:none"
            for (var i = 0; i < cuotas.length; i++) {
                if(parseFloat(cuotas[i].MONTO_PAGADO) == 0){
                    clase = 'danger';
                    text_estado = 'PENDIENTE';
                    estado = '0';
                }
                else if(parseFloat(cuotas[i].MONTO_PAGADO)>0 && parseFloat(cuotas[i].MONTO_PAGADO)<parseFloat(cuotas[i].MONTO_CUOTA)){
                    clase = 'warning';
                    text_estado = 'PENDIENTE';
                    estado = '0';
                }else if(parseFloat(cuotas[i].MONTO_PAGADO)==parseFloat(cuotas[i].MONTO_CUOTA)) {
                    clase = 'success';
                    text_estado = 'CANCELADO';
                    estado = '1';
                }else{
                    clase = 'default';
                }
                HTML += '<tr id=\'fila'+(i+1)+'\' class=\''+clase+'\'>';
                HTML += '   <td class=\'text-center\'>' + cuotas[i].NUM_CUOTA  + '</td>';
                HTML += '   <td class=\'text-center\'>' + cuotas[i].FECHA_VENC + '</td>';
                HTML += '   <td class=\'text-center\'>0</td>';
                HTML += '   <td class=\'text-center\'><input readonly  style=\'text-align:center;border:none; background:none\' name=\'monto_cuota[]\' id=\'monto_cuota'+(i+1)+'\' value=\''+cuotas[i].MONTO_CUOTA+'\'/></td>';
                HTML += '   <td class=\'text-center\' > <input readonly  style=\'text-align:center;border:none; background:none\' name=\'monto_pagado[]\' id=\'monto_pagado'+(i+1)+'\' value=\''+cuotas[i].MONTO_PAGADO+'\'/></td>';
                HTML += '   <td class=\'text-center\' > <input readonly  style=\'text-align:center;border:none; background:none\' name=\'monto_restante[]\' id=\'monto_restante'+(i+1)+'\' value=\''+(parseFloat(cuotas[i].MONTO_CUOTA)-parseFloat(cuotas[i].MONTO_PAGADO)).toFixed(2)+'\'/></td>';
                HTML += '   <td class=\'text-center\' >';
                HTML += '<input type=\'hidden\' name=\'estado[]\' id=\'estado'+(i+1)+'\' value=\''+estado+'\'/>';
                HTML += '<input readonly  style=\'text-align:center;border:none; background:none\' name=\'text_estado[]\' id=\'text_estado'+(i+1)+'\' value=\''+text_estado+'\'/></td>';
                HTML += '</tr>';
            }
            HTML += '</tbody></table>';
            HTML+=" <div class=\'row\'>";
            HTML+="    <div class=\'col-md-2\'>";
            HTML+="            <label class=\'control-label\' >REFERENCIA:</label>";              
            HTML+="    </div>";
            HTML+="    <div class=\'col-md-10\'>";
            HTML+="                <textarea name=\'referencia\' id=\'referencia\' class=\'form-control\' ></textarea>";
            HTML+="    </div>";
            HTML+=" </div> <br>";
      
            $("#num_cuotas").val(cuotas.length);
            $("#cronograma").html(HTML);
            $("#deshacer").attr('disabled',true);

       // }, 'json');
    }, 'json');
}

function mostrarCronogramaVenta(id){
    $("#cronograma").show();
    $("#id_accion").val(id);
    $.post(url + 'cronograma_cobro/getCuotasVenta',"id_c="+id, function(cuotas) {
       //alert(cuotas.length);
        var total_pagado = 0;
        var tot_restante = 0;
        var total = 0;
        for (var i = 0; i < cuotas.length; i++) {
                total+= parseFloat(cuotas[i].MONTO_CUOTA);
                total_pagado+= parseFloat(cuotas[i].MONTO_PAGADO);        
        }
        var resto = total - total_pagado;

        //$.post(url + 'cronograma_pago/getSaldoCompra',"id_c="+id, function(saldo) {
            HTML ="";
        
            HTML +="<legend>Cronograma de Pagos</legend>";
            HTML+="<div class=\'row\'>";
            HTML+="    <div class=\'col-md-4\'>";
            HTML+="     <strong> MONTO:</strong>";
            HTML+="         <input type=\"text\" name=\"importe\" id=\"importe\" onkeypress=\"return dosDecimales(event,this)\" placeholder=\"Importe\" class=\"form-control\"  style=\"width: 80px\" />";
            HTML+="         <button type=\"button\" class=\"btn btn-primary btn-sm\"  id=\"amortizar\" onclick='validaDistribucion()'>Distribuir</button>";
            HTML+="         <button type=\"button\" class=\"btn btn-warning btn-sm\"  id=\"deshacer\" onclick='borrar()'><i class=\"icon-repeat icon-white\"></i></button>";
            HTML+="     </div>";
            HTML+="    <div class=\'col-md-4\'>";
            HTML+="        <div class=\'form-group\'>";
            HTML+="            <label class=\'col-md-3 control-label\' >PAGO TOTAL</label>";              
            HTML+="            <div class=\'col-md-8\'>";
            HTML+="                <input name=\'pago\' id=\'pago\' class=\'form-control\'  readonly=\'readonly\' value=\'"+total_pagado.toFixed(2)+"\'>";
            HTML+="            </div>";
            HTML+="        </div>";
            HTML+="    </div>";
            HTML+="    <div class=\'col-md-4 \'>";
            HTML+="        <div class=\'form-group\'>";
            HTML+="            <label class=\'col-md-3 control-label\' > DEUDA TOTAL</label>";              
            HTML+="            <div class=\'col-md-8\'>";
            HTML+="                <input name=\'deuda\' id=\'deuda\' class=\'form-control\'  readonly=\'readonly\' value=\'"+resto.toFixed(2)+"\'>";
            HTML+="            </div>";
            HTML+="        </div>";
            HTML+="    </div>";
            HTML+="</div>";
            HTML+= '<table class=\'table table-striped table-bordered table-hover sortable\'>' +
                    '<thead>' +
                        '<tr>' +
                        '<th class=\'text-center\'># CUOTA</th>' +
                        '<th class=\'text-center\'>FECHA VENC.</th>' +
                        '<th class=\'text-center\'>RETRASO</th>' +
                        '<th class=\'text-center\'>MONTO</th>' +
                        '<th class=\'text-center\'>MONTO PAGADO</th>' +
                        '<th class=\'text-center\'>MONTO RESTANTE</th>' +
                        '<th class=\'text-center\'>ESTADO</th>' +
                        '</tr>' +
                    '</thead>' +
                    '<tbody>';
    //style="border:none; background:none"
            for (var i = 0; i < cuotas.length; i++) {
                if(parseFloat(cuotas[i].MONTO_PAGADO) == 0){
                    clase = 'danger';
                    text_estado = 'PENDIENTE';
                    estado = '0';
                }
                else if(parseFloat(cuotas[i].MONTO_PAGADO)>0 && parseFloat(cuotas[i].MONTO_PAGADO)<parseFloat(cuotas[i].MONTO_CUOTA)){
                    clase = 'warning';
                    text_estado = 'PENDIENTE';
                    estado = '0';
                }else if(parseFloat(cuotas[i].MONTO_PAGADO)==parseFloat(cuotas[i].MONTO_CUOTA)) {
                    clase = 'success';
                    text_estado = 'CANCELADO';
                    estado = '1';
                }else{
                    clase = 'default';
                }
                HTML += '<tr id=\'fila'+(i+1)+'\' class=\''+clase+'\'>';
                HTML += '   <td class=\'text-center\'>' + cuotas[i].NUM_CUOTA  + '</td>';
                HTML += '   <td class=\'text-center\'>' + cuotas[i].FECHA_VENC + '</td>';
                HTML += '   <td class=\'text-center\'>0</td>';
                HTML += '   <td class=\'text-center\'><input readonly  style=\'text-align:center;border:none; background:none\' name=\'monto_cuota[]\' id=\'monto_cuota'+(i+1)+'\' value=\''+cuotas[i].MONTO_CUOTA+'\'/></td>';
                HTML += '   <td class=\'text-center\' > <input readonly  style=\'text-align:center;border:none; background:none\' name=\'monto_pagado[]\' id=\'monto_pagado'+(i+1)+'\' value=\''+cuotas[i].MONTO_PAGADO+'\'/></td>';
                HTML += '   <td class=\'text-center\' > <input readonly  style=\'text-align:center;border:none; background:none\' name=\'monto_restante[]\' id=\'monto_restante'+(i+1)+'\' value=\''+(parseFloat(cuotas[i].MONTO_CUOTA)-parseFloat(cuotas[i].MONTO_PAGADO)).toFixed(2)+'\'/></td>';
                HTML += '   <td class=\'text-center\' >';
                HTML += '<input type=\'hidden\' name=\'estado[]\' id=\'estado'+(i+1)+'\' value=\''+estado+'\'/>';
                HTML += '<input readonly  style=\'text-align:center;border:none; background:none\' name=\'text_estado[]\' id=\'text_estado'+(i+1)+'\' value=\''+text_estado+'\'/></td>';
                HTML += '</tr>';
            }
            HTML += '</tbody></table>';
            HTML+=" <div class=\'row\'>";
            HTML+="    <div class=\'col-md-2\'>";
            HTML+="            <label class=\'control-label\' >REFERENCIA:</label>";              
            HTML+="    </div>";
            HTML+="    <div class=\'col-md-10\'>";
            HTML+="                <textarea name=\'referencia\' id=\'referencia\' class=\'form-control\' ></textarea>";
            HTML+="    </div>";
            HTML+=" </div> <br>";
      
            $("#num_cuotas").val(cuotas.length);
            $("#cronograma").html(HTML);
            $("#deshacer").attr('disabled',true);

       // }, 'json');
    }, 'json');
}
function extornar(url){
    if(confirm("¿Esta Seguro de Extornar este Movimiento?")){
        window.location = url;
    }
}