$(function() {    

});

function participar(id_evento,id_socio){
    if($('#btn_pa').attr('estado')=='1'){
        $.post(url+'mis_eventos/insertaSocioxEvento',{id_evento:id_evento,id_socio:id_socio},function(datos){
            $('#btn_pa').attr('idsocioevento', datos[0].ID_SOCIO_X_EVENTO);
            
            window.location = url+'mis_eventos/';
        },'json');
    }else{
        $.post(url+'mis_eventos/eliminaSocioxEvento',{id_socio_evento:$('#btn_pa').attr('idsocioevento')});
        window.location = url+'mis_eventos/';
    }

}