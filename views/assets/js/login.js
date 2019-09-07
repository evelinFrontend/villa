
$("#form-login").submit(function(e){
    e.preventDefault();
    var data = {
        "nombre_login":"",
        "contrasena":""
    }
    if ($("#user-name").val() != '' && $("#password").val() != '' ) {
        data.nombre_login = $("#user-name").val();
        data.contrasena =  $("#password").val()
        $.ajax({
            url:'logIn',
            type: 'POST',
            dataType: 'json',
            data: (data),
            success: function(success) {
                console.log(success);
                if (success.rol === 'ADMIN') {
                    location.href = 'home';
                } else if (success.rol == 'EMPLOYEE') {
                    location.href = 'home-personal'
                } else {

                }
            },
            error: function(err) {
                console.log(err);
                
            }
        });
       
    } else {
        console.log("llenar los datos");
        
    }

})
