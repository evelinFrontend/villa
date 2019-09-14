
$("#form-login").submit(function (e) {
    $(".form-control").removeClass("is-invalid")
    e.preventDefault();
    var data = {
        "nombre_login": "",
        "contrasena": ""
    }
    if ($("#user-name").val() != '' && $("#password").val() != '') {
        data.nombre_login = $("#user-name").val();
        data.contrasena = $("#password").val()
        $.ajax({
            url: 'logIn',
            type: 'POST',
            dataType: 'json',
            data: (data),
            success: function (success) {
                console.log(success);
                if (success.rol === 'ADMIN') {
                    location.href = 'home';
                } else if (success.rol == 'EMPLOYEE') {
                    location.href = 'recepcion'
                } else {

                }
            },
            error: function (err) {
                var message = err.responseJSON.message;
                $(".alert").addClass("show");
                $(".alert").empty();
                $(".alert").append(message);
            }
        });

    } else {
        $(".form-control").addClass("is-invalid")
    }

})
