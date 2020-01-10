$(document).ready(function(){
   var modal = $('#myModal');

   var form_sesion = '\
    <form id="new-treatment">\
       hola \
    </form>';

   $('#new-treatment').click(function(){
        $('.modal-title').html('Registrar nuevo tratamiento');
        
        $('.modal-body').html(form_sesion);


   });


});