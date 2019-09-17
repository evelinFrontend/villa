
$("#reception").ready(function () {
    $("#content-additional").hide();
   
    $.ajax({
        url: 'readByRoom',
        type: 'POST',
        dataType: 'json',
        data: ({
            "columnDBSearch": 1,
            "value": 1
        }),
        success: function (success) {
            console.log(success);
            var rooms = success.data;
            $.each(rooms, function (value, item) {
                if (item.id_tipo_habitacion == 1) {
                    // var card = (
                    //     '<div class="card cards room bg-success mb-4 ml-4" style="max-width: 10rem;">' +
                    //     '<div class="card-header">' + 'DISPONIBLE' + '</div>' +
                    //     '<div class="card-body">' +
                    //     '<div class="card-number d-flex justify-content-center align-items-center text-white" id="content-number-rooms">' +
                    //     '<h4 class="text-white">'+
                    //     item.hab_numero +
                    //     '</h4>'+
                    //     '</div>' +
                    //     '</div>' +
                    //     '</div>'
                    // );
                } else {
                    // var card = (
                    //     '<div class="card cards room bg-info mb-4 ml-4" style="max-width: 10rem;">' +
                    //     '<div class="card-header">' + 'DISPONIBLE' + '</div>' +
                    //     '<div class="card-body">' +
                    //     '<div class="card-number d-flex justify-content-center align-items-center text-white" id="content-number-rooms">' +
                    //     '<h4 class="text-white">'+
                    //     item.hab_numero +
                    //     '</h4>'+
                    //     '</div>' +
                    //     '</div>' +
                    //     '</div>'
                    // );
                }
                
                $("#content-card").append(card);

            })
        },
        error: function (err) {
            var message = err.responseJSON.message;
        }
    });
    getTurno();
});
function getTurno() {
    $.ajax({
        url: 'mostrarAbrirTurno',
        dataType: "json",
        type: "GET",
        success: function(success) { 
        },
        error: function (err) {
            $('#init-modal').modal('show');
        }
    }) 
}

$("#turn").submit(function(e) {
    e.preventDefault();
    if ($("#value").val() !== '') {
        $.ajax({
            url: 'createTurn',
            dataType: "json",
            type: "POST",
            data: ({
                "usuario": 1,
                "valor_inicial": $("#value").val()
            }),
            success: function(success) {
                console.log(success);
                
            },
            error: function (err) {
                
            }
        })
    } else {
        console.log("llenar");
        
    }
})

$(".goInvoices").click(function(e) {
    console.log(e);
    $("#invoices").addClass('active');
    $("#reception").hide();
})

$("#select-person").change(function () {
    if ($("#select-person").val() === 'si') {
        $("#content-additional").show()
    } else {
        $("#content-additional").hide()
    }
    
})

$('#value').keypress(function () {
    var data = this.value
    var result = data.replace(/(?=(\d{3})+(?!\d))/g, '$1,');
    console.log(result);
});
