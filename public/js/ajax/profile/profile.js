$(document).ready(function(){
   getTreatments();

   $('#loadingSpin').hide()  // Hide it initially
    .ajaxStart(function() {
        $(this).show();
    });
   //  .ajaxStop(function() {
   //      $(this).delay(800).hide();
   //  });




});


function getTreatments(){
   var url  = window.location.pathname;
   var count = 1;
   url = url.replace(/\D/g, "");
   // $('#loadingSpin').show();
   $.ajax({ 
      type: "GET",
      dataType: "json",
      url: "/treatments/"+url,
      success: function(data){        
         if(data.succesfull == true){
            if(data.result != ""){
               $('#treat-table tbody').html('');
               $.each(data.result, function(key, entry) {
                  var status = entry.active == 1 ? 'Activo' : 'Terminado'; 
                  var tr = '<tr data-id="'+entry.id+'">';
                  tr += '<td>'+count+'</td>';
                  tr += '<td>'+entry.id+'</td>';
                  tr += '<td>'+entry.doctor+'</td>';
                  tr += '<td>'+entry.concept+'</td>';
                  tr += '<td>'+entry.sessions+'</td>';
                  tr += '<td>'+status+'</td>';
                  tr += '</tr>';
                  count++;
                  $('#treat-table tbody').append(tr);
               });
               $('#loadingSpin').delay(800).hide();
            }else{
               $('#treat-table').html('<p>No hay tratamientos disponibles</p>');
            }
         }else{
            alert('Algo ha salido mal por favor contacta a soporte tecnico')
         }
      }
   });
}