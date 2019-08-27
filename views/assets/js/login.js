
$("#form-login").submit(function(e){
    e.preventDefault();
    console.log(
        $("#user-name").val(),
        $("#password").val()
     );
    
    $.ajax({
        url: actionurl,
        type: 'POST',
        dataType: 'json',
        data: ({}),
        success: function(data) {
            
        },
        error: {

        }
    });

})
