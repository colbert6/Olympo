$(document).ready(function() {    

    $("#save").click(function() {
        bval = true;   
        bval = bval && $("#id_tipo_movimiento").required();
        bval = bval && $("#id_concepto_movimiento").required();
        bval = bval && $("#id_forma_pago").required();
        bval = bval && $("#descripcion").required();
        bval = bval && $("#monto").required();
        if (bval){
            $("#frm").submit();
        }
        return false;
    });

    $('#id_tipo_movimiento').change(function(){
        
        $("#id_concepto_movimiento").html('<option></option>');
        $("#id_forma_pago").html('<option></option>');
        //$("#descripcion").empty();
        $.post(url+'concepto_movimiento/getConceptoMovimiento',{id:$("#id_tipo_movimiento").val()},function(concepto){
            //alert(concepto.length);
            for (var i = 0; i < concepto.length; i++) {
                if(concepto[i].ID_CONCEPTO_MOVIMIENTO>2){
                    $("#id_concepto_movimiento").append(new Option(concepto[i].DESCRIPCION,concepto[i].ID_CONCEPTO_MOVIMIENTO));
                }  
            }
        },'json');

        $("#id_forma_pago").append(new Option("EFECTIVO","1"));
        $("#id_forma_pago").append(new Option("TARJETA","2"));

    });


});