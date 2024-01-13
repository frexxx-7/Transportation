$(document).ready(function () {
  // Загрузка данных в форму
  $.ajax({
    url: '../php/load.php',
    type: 'POST',
    data: {
      id: $('#id').val(),
      name: $('#username').val()
    }, // передача параметров id и name
    dataType: 'json',
    success: function (response) {
      console.log(response);
      $('#price').val(response.fio);
      $('#name').val(response.type);
      $('#engines').val(response.name);
      $('#year').val(response.price);
      $('#height').val(response.price);
      $('#liftingCapacity').val(response.price);
      $('#lenght').val(response.price);
      $('#compartmentLenght').val(response.price);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
    }
  });


  // Обновление данных в базе данных
  $('#editForm').submit(function (e) {
    e.preventDefault();

    var formData = new FormData();
    formData.append('price', $('#price').val());
    formData.append('name', $('#name').val());
    formData.append('engines', $('#engines').val());
    formData.append('year', $('#year').val());
    formData.append('height', $('#height').val());
    formData.append('liftingCapacity', $('#liftingCapacity').val());
    formData.append('lenght', $('#lenght').val());
    formData.append('compartmentLenght', $('#compartmentLenght').val());

    $.ajax({
      url: '../php/edit.php',
      type: 'POST',
      data: $(this).serialize(),
      success: function (response) {
        alert(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
      }
    });
  });
});
