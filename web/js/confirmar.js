function paginador(objeto, url) { 
    var first = url.indexOf("?"); window.location.href = url + ((first === -1) ? '?' : '&') + 'page=' + $(objeto).val(); 
} 

function eliminar(id, variable, url){
  $.ajax({
    url: url,
    data: variable + '=' + id,
    dataType: 'json',
    type: 'POST',
    success: function (data){
     location.reload();
    }
  });  
}
 function eliminarMasivo(){
  $('#myModalDeleteMasivo').modal('toggle');  
}

$(document).ready(function(){
  $('#chkAll').click(function(){
    $('input[name="chk[]"]').each(function(index, element){
      if($('#chkAll').is(':checked') == true && $(element).is (':checked') == true){
        }else if($('#chkAll').is(':checked')== true && $(element).is (':checked')== false){
        $(element).prop('checked', true);
      }else if($('#chkAll').is(':checked')== false && $(element).is (':checked')== true){
         $(element).prop('checked', false);
      }
      });
    });
  });