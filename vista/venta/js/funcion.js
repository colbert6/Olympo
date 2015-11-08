 function ver(id){
        titulo='',html='';
        $("#myModalLabel").html('');
        $("#bodymodal").html('<div class="text-center"><img src="'+url+'lib/img/loading.gif" /></div>');
           $.post(url+'venta/ver','id_venta='+id,function(datos){
                titulo += 'Datos de la Venta';
                html += '<table class="table table-striped table-bordered table-hover sortable">';
                html+= '<tr>';
                html+= '<td>Nro.Documento:</td>';
                html+= '<td>'+datos[0]['NUMERO_VENTA']+'</td>';
                html+= '</tr>';
                html+= '<tr>';
                html+= '<td>Cliente:</td>';
                var cliente = datos[0]['NOMBRE_SOC']+' '+datos[0]['APE_P_SOC'] +' '+datos[0]['APE_M_SOC'];
                html+= '<td>'+cliente+'</td>';
                html+= '</tr>';
                html+= '<tr>';
                html+= '<td>Fecha de Venta:</td>';
                html+= '<td>'+datos[0]['FECHA_VENTA']+'</td>';
                html+= '</tr>';
                html+= '<tr>';
                html+= '<td>EMPLEADO:</td>'; 
                var empleado = datos[0]['NOMBRE_EMP']+' '+datos[0]['APE_P_EMP'] +' '+datos[0]['APE_M_EMP'];
                html+= '<td>'+empleado+'</td>';
                html+= '</tr>';
                html+= '<tr>';
                html+= '<td>Tipo de Pago:</td>';
                html+= '<td>'+datos[0]['MODALIDAD']+'</td>';
                html+= '</tr>';
                html+= '<tr>';
                html+= '<td>Importe:</td>';
                html+= '<td>'+datos[0]['MONTO_VENTA']+'</td>';
                html+= '</tr>';
                html+= '<tr>';
                html+= '<td>IGV:</td>';
                html+= '<td>'+datos[0]['IGV_VENTA']+'</td>';
                html+= '</tr>';
                html+= '<tr>';
                html+= '<td>Total:</td>';
                tot = (parseFloat(datos[0]['IGV_VENTA'])+1)*parseFloat(datos[0]['MONTO_VENTA']);
                html+= '<td>'+(tot).toFixed(2)+'</td>';
                html+= '</tr>';
                html+= '</table>';
                
                html+= '<p>Detalle Venta</p>';
                html+= '<table class="table table-striped table-bordered table-hover sortable">';
                html+= '<tr>';
                html+= '<th>Item</th>';
                html+= '<th>Tipo</th>';
                html+= '<th>Descripcion</th>';
                html+= '<th>Soc. / Alm</th>';
                html+= '<th>Fecha / Cant</th>';
                html+= '<th>Precio</th>';
                html+= '<th>Subtotal</th>';
                html+= '</tr>';
                for(var i=0;i<datos.length;i++){
                    html+= '<tr>';
                    html+= '<td>'+(i+1)+'</td>';
                    html+= '<td>'+datos[i]['TIPO']+'</td>';
                    html+= '<td>'+datos[i]['DESCRIPCION']+'</td>';
                    html+= '<td>'+datos[i]['NOMBRE']+'</td>';
                    html+= '<td>'+datos[i]['NUMERO']+'</td>';
                    html+= '<td>'+datos[i]['PRECIO']+'</td>';
                    var subtotal=0;
                    if(datos[i]['TIPO']=='Membresia'){
                         subtotal=datos[i]['PRECIO'];
                    }else{
                         subtotal=(datos[i]['NUMERO']*datos[i]['PRECIO']).toFixed(2);
                    }
                    html+= '<td>'+subtotal+'</td>';
                    html+= '</tr>';
                }
                html+= '</table>';
                
                $("#myModalLabel").html(titulo);
                $("#bodymodal").html(html);
           },'json');
       }
