document.getElementById("main-action").onclick = function () {
  document.getElementById("cars").scrollIntoView({ behavior: "smooth" });
}

var buttons = document.getElementsByClassName("car-button");
for (var i = 0; i < buttons.length; i++) {
  buttons[i].onclick = function () {
    document.getElementById("price").scrollIntoView({ behavior: "smooth" });
  }
}

document.getElementById("price-action").onclick = function () {
  if (document.getElementById("name").value === "") {
    alert("Запоните поле имя!");
  } else if (document.getElementById("phone").value === "") {
    alert("Запоните поле телефон!");
  } else if (document.getElementById("car").value === "") {
    alert("Запоните поле автомобиль!");
  } else {
    alert("Спасибо за заявку, мы свяжемся с вами в ближайшее время");
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const elem = document.querySelector(".main");
  document.addEventListener('scroll', () => {
    elem.style.backgroundPositionX = '0' + (0.5 * window.pageYOffset) + 'px';
  })
});
function oform() {
  var name = $('#name').val();
  var carName = $('#whatCar').val();
  var numberPhone = $('#phone').val();

  $.ajax({
    url: './php/data_request.php',
    type: 'post',
    data: { carName: carName, numberPhone: numberPhone },
    success: function (idCar) {
      $.ajax({
        url: './php/create_request.php',
        type: 'post',
        data: { name: name, idCar: idCar, numberPhone: numberPhone },
        success: function (response) {
          alert("Заявка отправлена!")
        }
      });
    }
  });
}
