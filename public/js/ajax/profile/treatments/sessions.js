var modal = $('#myModal');
   var session_id = 0;
   var form_session = '\
    <form class="form-horizontal" id="form-session">\
      <div class="form-group">\
         <label class="col-sm-2 control-label">Abono</label>\
         <div class="col-sm-10"><input name="payment" type="number" class="form-control"></div>\
      </div>\
      <div class="form-group">\
         <label class="col-sm-2 control-label">Mensaje</label>\
         <div class="col-sm-10"><textarea name="message" class="form-control" cols="40" rows="5"></textarea></div>\
      </div>\
      <div class="modal-footer">\
         <button type="submit" class="btn btn-primary" id="btn-save-session">Guardar</button>\
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>\
      </div>\
      </form>';

   $('#new-session').click(function(){
      $('.modal-body').html(form_session);
      session_id = $(this).attr('data-sesid');
      //End call functions to fill selectors
        $('.modal-title').html('Registrar nueva sesión de tratamiento');
   });

   $(function() {

    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
    });

    $('body').on('click', '#btn-save-session', function (e) {
       e.preventDefault();
       var inputs_session = $('#form-session').serialize();
       $.ajax({
          data:inputs_session,
          url:'/treatments/sessions/'+session_id+'/store',
          type: "POST",
          //dataType:"Json",
          success:function(data){
              if(data.succesfull != true){

              }

              if(data.result == 'save'){
                  $('#myModal').modal('hide');
                  swal({
                      title: "La sesion del tratamiento se ha guardado correctamente",
                      text: "Presiona el botón para cerrar",
                      type: "success"
                  });
                  getTreatments();
              }

          }


       });
    });


 });


 function getSessionsTreatments(id){
   // $('#loadingSpin').show();
   $.ajax({ 
      type: "GET",
      dataType: "json",
      url: "/treatments/sessions/"+url,
      success: function(data){        
         if(data.succesfull == true){
            if(data.result != ""){
               // $('#treat-table tbody').html('');
               $.each(data.result, function(key, entry) {
                  alert('si hay');
                  // var status = entry.active == 1 ? 'Activo' : 'Terminado'; 
                  // var tr = '<tr data-id="'+entry.id+'">';
                  // tr += '<td>'+count+'</td>';
                  // tr += '<td>'+entry.id+'</td>';
                  // tr += '<td>'+entry.doctor+'</td>';
                  // tr += '<td>'+entry.concept+'</td>';
                  // tr += '<td>'+entry.sessions+'</td>';
                  // tr += '<td>'+status+'</td>';
                  // tr += '</tr>';
                  // count++;
                  // $('#treat-table tbody').append(tr);
               });
               $('#loadingSpin').delay(800).hide();
            }else{
               alert('aun no hay sesiones');
               // $('#treat-table').html('<p>No hay tratamientos disponibles</p>');
            }
         }else{
            alert('Algo ha salido mal por favor contacta a soporte tecnico')
         }
      }
   });
}