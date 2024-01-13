let showForm = false;
$(".registration-btn").on("click",()=>{
  if(showForm){
     $(".authorization").css("display", "flex")
     $(".registration").css("display", "none") 
  }else{
    $(".authorization").css("display", "none")
    $(".registration").css("display", "flex") 
  }
  showForm = !showForm
})

$(document).ready(function() {

    // Обработка формы авторизации
    $('#authorization').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '../php/auth.php',
            data: $(this).serialize(),
            success: function(response)
            {
                var jsonData = JSON.stringify(response);
                var jsonInfo = JSON.parse(jsonData)
                var jsonInfo1 = JSON.parse(jsonInfo)
                console.log(jsonInfo1);
                // Пользователь успешно авторизован 
                if (jsonInfo1.success == true)
                {
                    location.href = '../pages/profile.php';
                }
                else
                {
                    alert('Неверные учетные данные');
                }
           },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            }
       });
     });

    // Обработка формы регистрации
    $('#registration').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '../php/reg.php',
            data: $(this).serialize(),
            success: function(response)
            {
                var jsonData = JSON.stringify(response);
                var jsonInfo = JSON.parse(jsonData)
                // Пользователь успешно зарегистрирован 
                if (jsonInfo.success)
                {
                    location.href = '../pages/profile.php';
                }
                else
                {
                    alert('Ошибка регистрации');
                }
           }
       });
     });
});
