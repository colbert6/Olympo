function cargar_php(pagina,capa){

        $('#'+capa).html("<br/><img src='"+url+"lib/img/loading.gif' />");
        $('#'+capa).load(url+"reportes_graficos/"+pagina,function(){
            $('#'+capa).show("slow");
        });
    }