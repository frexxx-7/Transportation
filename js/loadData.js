$(document).ready(function(){
  $.ajax({
      url: './php/select_load.php',
      type: 'get',
      dataType: 'JSON',
      success: function(response){
          var len = response.length;
          for(var i=0; i<len; i++){
              var name = response[i].name;
              $("#whatCar").append("<option value='"+name+"'>"+name+"</option>");
          }
      }
  });
});
