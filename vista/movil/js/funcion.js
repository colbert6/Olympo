$(document).ready(function() {    
      
    $( "#save" ).click(function(){
        bval = true;   
        bval = bval && $("#buscar_id").required();
        
        if (bval) 
        {
            //$("#frm").submit();
        }
        return false;
    }); 
});

function participar(id_btn,id_evento,id_socio,url){

    if($('#btn_pa'+id_btn).attr('estado')=='1'){
        $.post(url+'mis_eventos/insertaSocioxEvento',{id_evento:id_evento,id_socio:id_socio},function(datos){
        	
            $('#btn_pa'+id_btn).attr('idsocioevento', datos[0].ID_SOCIO_X_EVENTO);
            $('#accion'+id_btn).html("<span class='glyphicon glyphicon-remove'></span>&nbsp;NO ASISTIR");
            $('#btn_pa'+id_btn).attr('estado', '0');
            //window.location = url+'movil/sistema_movil/mis_eventos/';

        },'json');
    }else{
        $.post(url+'mis_eventos/eliminaSocioxEvento',{id_socio_evento:$('#btn_pa'+id_btn).attr('idsocioevento')});
        $('#accion'+id_btn).html("<span class='glyphicon glyphicon-ok'></span>&nbsp;ASISTIR");
        $('#btn_pa'+id_btn).attr('idsocioevento','0');
        $('#btn_pa'+id_btn).attr('estado', '1');
        //window.location = url+'movil/sistema_movil/mis_eventos/';
    }

}

function extraerDatos(url){
    if($("#buscar_id").val()!=""){
        if(!isNaN($("#buscar_id").val())){
            $.post(url+'movil/sel_movimiento/',{id:$("#buscar_id").val()},function(datos){
                //alert(datos.length);
                $("#datos").attr('style','width:87%; margin:0 auto;background:#DCDCDC;padding:10px;border-radius:5px;');
                //style='width:87%; margin:0 auto;background:#DCDCDC;padding:10px;border-radius:5px;'
                HTML='';
                HTML+='<h5><strong>TIPO MOVIMIENTO:<br></strong> '+datos[0].TIPO_MOVIMIENTO+'</h5>';
                HTML+='<h5><strong>CONCEPTO MOVIMIENTO:<br></strong> '+datos[0].CONCEPTO_MOVIMIENTO+'</h>';
                HTML+='<h5><strong>DESCRIPCION:<br></strong> '+datos[0].DESCRIPCION+'</h5>';
                HTML+='<h5><strong>FECHA:<br></strong> '+datos[0].FECHA+'</h5>';
                HTML+='<h5><strong>MONTO:<br></strong> '+datos[0].MONTO+'</h5>';
                HTML+='<div class=\'text-right\'><a href=\''+url+'movimiento/extornar/'+datos[0].ID_MOVIMIENTO+'\' class=\'btn btn-warning\'>Extornar</a></div>';
                $('#datos').html(HTML);

            },'json');
        }else{
            $("#buscar_id").val("");
            $("#buscar_id").attr('placeholder','Dato Erroneo!!. Solo Numeros');
            $("#buscar_id").focus();
        }
    }else{
        $("#buscar_id").focus();        
    }

   
}
