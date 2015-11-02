$(function() {    
	//alert("abrio");
	$("#acciones,#cronograma").hide();
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
        mostrarVentas();

    }else{
        $("#tipo_movimiento").val("EGRESO");
        mostrarCompras();
    }
    //$("#id_tipo_movimiento").focus();
    //$("#id_tipo_movimiento").append(new Option('INGRESO','1'));
    //$("#id_tipo_movimiento").append(new Option('EGRESO','2'));
}

function mostrarVentas(){
    $("#acciones").show();
    HTML="";
    HTML+="<legend>Ventas Pendientes de Pago</legend>";
    $("#acciones").html(HTML);
}

function mostrarCompras(){
    $("#acciones").show();   
    HTML="";
    HTML+="<legend>Compras Pendientes de Pago</legend>";
    $("#acciones").html(HTML);
}