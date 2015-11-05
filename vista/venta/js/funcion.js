 function ver(id){
        titulo='',html='';
        $("#myModalLabel").html('');
        $("#bodymodal").html('<div class="text-center"><img src="'+url+'lib/img/loading.gif" /></div>');
           $.post(url+'venta/ver','id_venta='+id,function(datos){
                titulo += 'Datos de la Venta';
                html += '<table class="table table-striped table-bordered table-hover sortable">';
                html+= '<tr>';
                html+= '<td>Nro.Documento:</td>';
                html+= '<td>'+datos[0]['NUM_DOCUMENTO']+'</td>';
                html+= '</tr>';
                html+= '<tr>';
                html+= '<td>Cliente:</td>';
                var cliente = datos[0]['NSOCIO'];
                if(datos[0]['ASOCIO'] != '' && datos[0]['ASOCIO'] != null && datos[0]['ASOCIO'] != ' '){
                     cliente += ' '+ datos[0]['ASOCIO'];
                }
                html+= '<td>'+cliente+'</td>';
                html+= '</tr>';
                html+= '<tr>';
                html+= '<td>Fecha de Venta:</td>';
                html+= '<td>'+datos[0]['FECHA']+'</td>';
                html+= '</tr>';
                html+= '<tr>';
                html+= '<td>Tipo de Pago:</td>';
                html+= '<td>'+datos[0]['MODALIDAD_TRANSACCION']+'</td>';
                html+= '</tr>';
                html+= '<tr>';
                html+= '<td>Importe:</td>';
                html+= '<td>'+datos[0]['MONTO']+'</td>';
                html+= '</tr>';
                html+= '<tr>';
                html+= '<td>IGV:</td>';
                html+= '<td>'+datos[0]['IGV']+'</td>';
                html+= '</tr>';
                html+= '<tr>';
                html+= '<td>Total:</td>';
                tot = (parseFloat(datos[0]['IGV'])+1)*parseFloat(datos[0]['MONTO']);
                html+= '<td>'+(tot).toFixed(2)+'</td>';
                html+= '</tr>';
                html+= '</table>';
                html+= '<p>Detalle Venta</p>';
                html+= '<table class="table table-striped table-bordered table-hover sortable">';
                html+= '<tr>';
                html+= '<th>Item</th>';
                html+= '<th>Producto</th>';
                html+= '<th>Almacen</th>';
                html+= '<th>Cantidad</th>';
                html+= '<th>Precio</th>';
                html+= '<th>Subtotal</th>';
                html+= '</tr>';
                for(var i=0;i<datos.length;i++){
                    html+= '<tr>';
                    html+= '<td>'+(i+1)+'</td>';
                    html+= '<td>'+datos[i]['PRODUCTO']+'</td>';
                    html+= '<td>'+datos[i]['ALMACEN']+'</td>';
                    html+= '<td>'+datos[i]['CANTIDAD_PRO']+'</td>';
                    html+= '<td>'+datos[i]['PRECIO_PRO']+'</td>';
                    html+= '<td>'+(datos[i]['CANTIDAD_PRO']*datos[i]['PRECIO_PRO']).toFixed(2)+'</td>';
                    html+= '</tr>';
                }
                html+= '</table>';
                
                $("#myModalLabel").html(titulo);
                $("#bodymodal").html(html);
           },'json');
       }
