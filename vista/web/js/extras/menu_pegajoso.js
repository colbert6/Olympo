//-----------MENU PEGAJOSO ---------------------///
$(document).ready(function() {
    
              var nav = $('nav');
              var container = $('#div_pegajoso');
              //var contenedor = $('#menu-contenedor');
              var menu_offset = nav.offset();
              // Cada vez que se haga scroll en la página
              // haremos un chequeo del estado del menú
              // y lo vamos a alternar entre 'fixed' y 'static'.
              $(window).on('scroll', function() {
                if($(window).scrollTop() > menu_offset.top) {
                  
                  nav.removeClass('navbar navbar-default');
                  nav.addClass('navbar navbar-default navbar-fixed-top');
                  container.addClass('mycontainer');

                } else {
                  nav.removeClass('navbar navbar-default navbar-fixed-top');
                  container.removeClass('mycontainer');
                  nav.addClass('navbar navbar-default');
                  
                }
              });
              
            });
