
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
            success: function(data) {
                location.href = "home"
            },
            error: {
                
            }
        });
       
    } else {
        console.log("llenar los datos");
        
    }

})
