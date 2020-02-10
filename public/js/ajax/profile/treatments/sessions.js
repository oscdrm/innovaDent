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
                      title: "El tratamiento se ha guardado correctamente",
                      text: "Presiona el botón para cerrar",
                      type: "success"
                  });
                  getTreatments();
              }

          }


       });
    });


 });