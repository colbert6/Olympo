$(function() {    
	//alert("abrio");
	$("#acciones,#cronograma").hide();
    $("#amortizar").attr('disabled',true);
    $( "#save" ).click(function(){
        bval = true;   
        bval = bval && $("#descripcion").required();
        
        if (bval) 
        {
            $("#frm").submit();
        }
        return false;
    }); 
    
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
       // mostrarVentas();

    }else{
        $("#tipo_movimiento").val("EGRESO");
        mostrarCompras(id_actor);
    }
    //$("#id_tipo_movimiento").focus();
    //$("#id_tipo_movimiento").append(new Option('INGRESO','1'));
    //$("#id_tipo_movimiento").append(new Option('EGRESO','2'));
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
                    '<th class=\'text-center\'>DOCUMENTO</th>' +
                    '<th class=\'text-center\'>MODALIDAD</th>' +
                    '<th class=\'text-center\'>MONTO</th>' +
                    '<th class=\'text-center\'>VER CRONOGRAMA</th>' +
                    '</tr>' +
                '</thead>' +
                '<tbody>';

        for (var i = 0; i < proveedor.length; i++) {
            HTML += '<tr>';
            HTML += '   <td class=\'text-center\'>' + (i + 1) + '</td>';
            HTML += '   <td class=\'text-center\'>' + proveedor[i].FECHA + '</td>';
            HTML += '   <td class=\'text-center\'>' + proveedor[i].NUM_DOCUMENTO + '</td>';
            HTML += '   <td class=\'text-center\'>' + proveedor[i].MODALIDAD_TRANSACCION + '</td>';
            HTML += '   <td class=\'text-center\'>' + proveedor[i].MONTO + '</td>';
            HTML += '   <td class=\'text-center\'> <input type=\'checkbox\' onchange=\'validaCheckBox(this)\' name=\'cronograma\' id=\'cronograma'+(i+1)+'\' value=\''+proveedor[i].ID_COMPRA+'\'></td>';
            HTML += '</tr>';
        }
        HTML += '</tbody></table>';
        $("#acciones").html(HTML);
    }, 'json');

    
}


/*function mostrarVentas(){
    $("#acciones").show();   
    HTML="";
    HTML+="<legend>Compras Pendientes de Pago</legend>";
    $("#acciones").html(HTML);
}*/


function validaCheckBox(check){
    var total = parseInt($("#num_opc").val());
    var contador = 0;
    for (var i = 1; i <= total; i++) {
        var elemento = document.getElementById("cronograma"+i);
        //alert(i);
        if(elemento.checked){
            contador++;
        }
    }
    //alert(total+" / "+contador);
    if(contador>1){
        check.checked = false;
        alert("Solo puede Marcar una Opcion")
    }else{
        if(check.checked){
         $("#amortizar").attr('disabled',false);
          mostrarCronograma(check.value);  
        }else{
            $("#amortizar").attr('disabled',true);
            $("#cronograma").hide();
        }
    }
}

function mostrarCronograma(id){
    $("#cronograma").show();
    $.post(url + 'cronograma_pago/getCuotasCompra',"id_c="+id, function(cuotas) {
        alert(cuotas.length);
       
        HTML ="";
        HTML +="<legend>Cronograma de Pagos</legend>";
        HTML += '<table class=\'table table-striped table-bordered table-hover sortable\'>' +
                '<thead>' +
                    '<tr>' +
                    '<th class=\'text-center\'># CUOTA</th>' +
                    '<th class=\'text-center\'>FECHA VENC.</th>' +
                    '<th class=\'text-center\'>MONTO</th>' +
                    '<th class=\'text-center\'>MONTO PAGADO</th>' +
                    '<th class=\'text-center\'>MONTO RESTANTE</th>' +
                    '<th class=\'text-center\'>ESTADO</th>' +
                    '</tr>' +
                '</thead>' +
                '<tbody>';
//style="border:none; background:none"
        for (var i = 0; i < cuotas.length; i++) {
            HTML += '<tr>';
            HTML += '   <td class=\'text-center\'>' + cuotas[i].NUM_CUOTA  + '</td>';
            HTML += '   <td class=\'text-center\'>' + cuotas[i].FECHA_VENC + '</td>';
            HTML += '   <td class=\'text-center\'>' + cuotas[i].MONTO_CUOTA + '</td>';
            HTML += '   <td class=\'text-center\' > <input style=\'text-align:center;border:none; background:none\' name=\'monto_pagado[]\' id=\'monto_pagado'+(i+1)+'\' value=\''+cuotas[i].MONTO_PAGADO+'\'/></td>';
            HTML += '   <td class=\'text-center\' > <input style=\'text-align:center;border:none; background:none\' name=\'monto_restante[]\' id=\'monto_restante'+(i+1)+'\' value=\'0.00\'/></td>';
            HTML += '   <td class=\'text-center\'>';
            if(cuotas[i].MONTO_CUOTA == cuotas[i].MONTO_PAGADO){
                HTML += 'CANCELADO';
            }else{
                HTML += 'PENDIENTE';
            }
            HTML += '</td>';
            HTML += '</tr>';
        }
        HTML += '</tbody></table>';
        $("#cronograma").html(HTML);
    }, 'json');
}