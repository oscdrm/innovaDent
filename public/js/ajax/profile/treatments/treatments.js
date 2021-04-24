
   var modal = $('#myModal');

   var form_treatment = '\
    <form class="form-horizontal" id="new-treat">\
      <div class="form-group">\
         <label class="col-sm-2 control-label">Servicio</label>\
         <div class="col-sm-10">\
            <select data-placeholder="Selecciona un servicio" name="concept" class="chosen-select" id="service"  tabindex="2" required>\
                  <option value="">Selecciona un servicio</option>\
            </select>\
         </div>\
      </div>\
      <div class="form-group">\
         <label class="col-sm-2 control-label">Doctor</label>\
         <div class="col-sm-10">\
            <select data-placeholder="Selecciona un doctor" name="doctor" class="chosen-select" id="doctor"  tabindex="2" required>\
                  <option value="">Selecciona un doctor</option>\
            </select>\
         </div>\
      </div>\
      <div class="form-group">\
         <label class="col-sm-2 control-label">Costo Total</label>\
         <div class="col-sm-10"><input name="amount" type="number" class="form-control"></div>\
      </div>\
      <div class="form-group">\
         <label class="col-sm-2 control-label">¿Cuantas Sesiones?</label>\
         <div class="col-sm-10"><input name="sessions" type="number" class="form-control"></div>\
      </div>\
      <div class="modal-footer">\
         <button type="submit" class="btn btn-primary" id="btn-save">Guardar</button>\
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>\
      </div>\
      </form>';

   $('#new-treatment').click(function(){
      $('.modal-body').html(form_treatment);

      //call functions to fill selectors
        getServices();
        getDoctors();
      //End call functions to fill selectors
        $('.modal-title').html('Registrar nuevo tratamiento');
   });

   function getServices(){
         $.ajax({ 
            type: "GET",
            dataType: "json",
            url: "/catalogs/services",
            success: function(data){        
               if(data.data != ''){
                  $.each(data.data, function(key, entry) {
                     var option = '<option value="'+entry.id+'"> '+entry.name+' </option>';
                     $('#service').append(option);
                  });
                  //$('.chosen-select').chosen({width: "100%"});
               }
            }
      });
   }

   function getDoctors(){
      $.ajax({ 
         type: "GET",
         dataType: "json",
         url: "/catalogs/doctors",
         success: function(data){        
            if(data.data != ''){
               $.each(data.data, function(key, entry) {
                  var option = '<option value="'+entry.id+'">'+entry.name+'</option>';
                  $('#doctor').append(option);
               });
               $('.chosen-select').chosen({width: "100%"});
            }
         }
   });

   }

   $(function() {

      $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });

      $('body').on('click', '#btn-save', function (e) {
         var url  = window.location.pathname;
         url = url.replace(/\D/g, "");
         e.preventDefault();
         var inputs = $('#new-treat').serialize();
         $.ajax({
            data:inputs,
            url:'/treatments/'+url+'/store',
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


