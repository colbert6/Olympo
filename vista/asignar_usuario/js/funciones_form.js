$(function() {    
      
    $( "#save1" ).click(function(){
        bval = true;   
        bval = bval && $("#n_socio").required();
        bval = bval && $("#user_s").required();
        bval = bval && $("#pass_s").required();
        
        if (bval) 
        {
        	ValidaCredencial("#frm1");
            //$("#frm1").submit();
        }
        return false;
    }); 

    $( "#save2" ).click(function(){
        bval = true;   
        bval = bval && $("#n_empleado").required();
        bval = bval && $("#user_e").required();
        bval = bval && $("#pass_e").required();
        bval = bval && $("#id_perfil_usuario").required();
        
        if (bval) 
        {
        	ValidaCredencial("#frm2");
            //$("#frm2").submit();
        }
        return false;
    }); 


    $("#socio").hide();
    $("#empleado").hide();
    $("#actor").change(function(){
             if($("#actor").val()==1){
             	$("#socio").show();
            	$("#empleado").hide();
             }else if($("#actor").val()==2){
             	$("#socio").hide();
            	$("#empleado").show();
             }else{
             	$("#socio").hide();
    			$("#empleado").hide();
             }       
    });

    $( "#btnBSocio" ).click(function(){
        listSocio()
        $('#btn-socio').show();
    }); 
    $( "#btnBEmpleado" ).click(function(){
        listEmpleados()
        $('#btn-empleado').show();
    }); 
    $( "#cambiar" ).click(function(){

    	bval = true;   
        bval = bval && $("#user").required();
        bval = bval && $("#pass").required();
        if (bval){
        	
            $.post(url+'movimiento/validaAdmin',{user:$("#user").val(),pass:$("#pass").val()},function(datos){
                //alert(datos.length);
                if(datos.length>0){
                    var form = $('#formulario').val();
                    
                    $(form).submit();
                    

                }else{
                    HTML="<div class=\"alert alert-danger alert-dismissable\">";
                    HTML+="<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
                    HTML+="<strong>¡Error!</strong> Datos Incorrectos.";
                    HTML+="</div>";
                    $("#alerta").html(HTML);
                }
            },'json');
        
        }
        return false;

        
        
    }); 

});

function ValidaCredencial(form){
     $('#user').val("");
     $('#pass').val("");
     $("#alerta").html("");
     $('#formulario').val(form);

     $('#validaAdministrador').modal('show');   
}
function cambiarCredencial(){

}

function listEmpleados(){
	$.post(url + 'empleado/buscador','all=1', function(datos) {
        var HTML = '<table id="table3" class="display" cellspacing="0" width="100%">' +
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
            var id_empleado = datos[i].ID_EMPLEADO;
            var empleado = $.trim(datos[i].NOMBRE +' '+ datos[i].APELLIDO_PATERNO +' '+  datos[i].APELLIDO_MATERNO);
            HTML = HTML + '<td><a style="margin-right:4px" href="javascript:void(0)" onclick="sel_empleado(\'' + id_empleado + '\',\'' + empleado + '\')" class="btn btn-success"><i class="icon-ok icon-white"></i> </a>';
            HTML = HTML + '</td>';
            HTML = HTML + '</tr>';
        }
        HTML = HTML + '</tbody></table>';

        $("#grillaEmpleado").html(HTML);
        $("#jsfoot").html("<script src='" + url + "vista/asignar_usuario/js/run_table2.js'></script>");
    }, 'json');
}

function sel_empleado(id,nombre){

	$("#id_empleado").val(id);
	$("#n_empleado").val(nombre);
	$("#tipo_e").val('e');
	 $('#modalEmpleado').modal('hide');
}
function listSocio(){
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
        $("#jsfoot").html("<script src='" + url + "vista/asignar_usuario/js/run_table.js'></script>");
    }, 'json');

	
}

function sel_socio(id,nombre){

		$("#id_socio").val(id);
		$("#n_socio").val(nombre);
		$("#tipo_s").val('s');
		$('#modalSocio').modal('hide');
	}
