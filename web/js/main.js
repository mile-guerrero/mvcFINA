$(document).ready(function(){
  $('#mvcIcon').hide();
  $('#mvcIcon .mvcPointer').click(function(){
    $('#mvcMain').toggle(150);
    $('#mvcIcon').toggle(150);
  });
  $('#mvcMain .mvcPointer').click(function(){
    $('#mvcMain').toggle(150);
    $('#mvcIcon').toggle(150);
  });
});

function cargarInsumo(url) {
   if($('#slcTipoDeInsumo').val() !== '') {
     $.ajax({
       data: {
         idTipoInsumo: $('#slcTipoDeInsumo').val()
       },
       dataType: 'json',
       success: function(data){
         $(data).each(function(index){
           $('#slcInsumo').append('<option value="' + data[index].id + '">' + data[index].name + '</option>');
         });
       },
       type: 'POST',
       url: url
     });
   } else {
     $('#slcInsumo').html('');
     $('#slcInsumo').append('<option value="">Seleccione el insumo</option>');
   }
 }