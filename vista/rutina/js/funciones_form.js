$(document).ready(function() {    
     
    
});
function validaEjercicio(dia){
	$("#dia").val(dia);
	mostrarCategoria_Ejercicio();
	$('#btn-ejercicio').show();

}
function mostrarCategoria_Ejercicio(){
	$.post(url + 'categoria_ejercicio/jsonCategoria_Ejercicio', function(datos) {
		//alert(datos.length);
		$.post(url + 'rutina/rutina_dia',{id_socio:$('#id_socio').val(),dia:$('#dia').val()} ,function(rutina) {
			
	        var HTML = '<table class="table" cellspacing="0" width="100%">' +
	                '<thead>' +
	                '<tr>' +
	                '<th class=\'text-center\'>CATEGORIA EJERCICIO</th>'+
	                '<th class=\'text-center\'>SELECCION</th>' +
	                '</tr>' +
	                '</thead>' +
	                '<tbody>';

	        for (var i = 1; i < datos.length; i++) {
	            HTML = HTML + '<tr>';
	            HTML = HTML + '<td>'+datos[i].DESCRIPCION+'</td>';
	            HTML = HTML + '<td ><input type=\'checkbox\' onclick=\'agregarRutina('+datos[i].ID_CATEGORIA_EJERCICIO+',this)\' id=\'cat_ejercicio'+(i)+'\' name=\'cat_ejercicio[]\'></td>';
	            HTML = HTML + '</tr>';
	        }
	        HTML = HTML + '</tbody></table>';

	        $("#grillaEjercicio").html(HTML);
     		
     		for (var i = 0; i < rutina.length; i++) {
     			document.getElementById("cat_ejercicio"+rutina[i].ID_CATEGORIA_EJERCICIO).checked = true;
     		};

        }, 'json');

    }, 'json');
}

function agregarRutina(id_categoria_ejercicio,check){
	if(check.checked){
		$.post(url+'rutina/registrarRutina',{id_socio:$('#id_socio').val(),dia:$('#dia').val(),
		id_categoria_ejercicio:id_categoria_ejercicio});
	}else{
		$.post(url+'rutina/eliminarRutina',{id_socio:$('#id_socio').val(),dia:$('#dia').val(),
		id_categoria_ejercicio:id_categoria_ejercicio});
	}

}