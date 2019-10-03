

$("#cierre").submit(function (e) {
    e.preventDefault()
    if ($("#cierre-input").val() !== '') {
        $.ajax({
            url: 'UptadeTurn',
            dataType: "json",
            type: "POST",
            data: ({
                "valor_final": $("#cierre-input").val()
            }),
            success: function (success) {
               location.href = 'login'
            },
            error: function (err) {
                $(".alert-danger").addClass("show");
                $(".alert-danger").append(err);
            }
        })

    } else {
        $(".alert-danger").addClass("show");
        $(".alert-danger").append("Ingrese un valor para cerrar el turno");
    }
    setTimeout(() => {
        $(".alert").empty()
        $(".alert").removeClass('show')
    }, 5000)
})