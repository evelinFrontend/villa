
$("#submitLogin").click(function(e){
    location.href();
    e.preventDefault();
    $.ajax({
        url: actionurl,
        type: 'post',
        dataType: 'json',
        // data: $("#myform").serialize(),
        success: function(data) {
            
        },
        error: {

        }
    });

})
