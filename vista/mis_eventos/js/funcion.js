$(function() {    

});

function participar(id_btn,id_evento,id_socio){
    
	
    if($('#btn_pa'+id_btn).attr('estado')=='1'){
        $.post(url+'mis_eventos/insertaSocioxEvento',{id_evento:id_evento,id_socio:id_socio},function(datos){
            
            $('#btn_pa'+id_btn).attr('idsocioevento', datos[0].ID_SOCIO_X_EVENTO);
            $('#accion'+id_btn).html("[&nbsp;NO ASISTIR&nbsp;]");
            $('#btn_pa'+id_btn).attr('estado', '0');
            //window.location = url+'movil/sistema_movil/mis_eventos/';

        },'json');
    }else{
        $.post(url+'mis_eventos/eliminaSocioxEvento',{id_socio_evento:$('#btn_pa'+id_btn).attr('idsocioevento')});
        $('#accion'+id_btn).html("[&nbsp;ASISTIR&nbsp;]");
        $('#btn_pa'+id_btn).attr('idsocioevento','0');
        $('#btn_pa'+id_btn).attr('estado', '1');
        //window.location = url+'movil/sistema_movil/mis_eventos/';
    }

}