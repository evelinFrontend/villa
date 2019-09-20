
$("#reception").ready(function () {
    $("#content-additional").hide();
    getTurno();
    getRooms();
});
function closeAlerts() {
    setTimeout(() => {
        $(".alert").removeClass('show')
        $(".alert").empty()
    }, 5000);
}

function getTurno() {
    $.ajax({
        url: 'mostrarAbrirTurno',
        dataType: "json",
        type: "GET",
        success: function (success) {
        },
        error: function (err) {
            $('#init-modal').modal('show');
        }
    })
}
function getRooms() {
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
            for (var i = 0; i < success.data.length; i++) {
                console.log(success.data[i]);
                var data = success.data[i]
                var time;
                if (data.tiempo_transcurido) {
                 var time = data.tiempo_transcurido
                } else {
                  var time = '';   
                }
                $("#content-card").append(`
                <div class="cards room mb-2" onclick="reserva(${data.sr_estado_reserva}, ${data.hab_numero})">
                    <div class="linear-room" style="background:${data.sr_color};"></div>
                    <div class="body-room-card d-flex">
                        <div>
                            <h1 class="card-number" style="color:${data.sr_color};">${data.hab_numero}</h1>
                        </div>
                    <div>
                        <p id="type-room">${data.sr_nombre}</p>
                        <small id="type-room">${data.th_nombre_tipo}</small>
                        <p id="time-room">${time}</p>
                    </div>
                    </div>
                </div>
                `)

            }
        },
        error: function (err) {
            console.log(err);
            
            // var message = err.responseJSON.message;
        }
    });
}

$("#turn").submit(function (e) {
    e.preventDefault();
    if ($("#value").val() !== '') {
        $.ajax({
            url: 'createTurn',
            dataType: "json",
            type: "POST",
            data: ({
                "valor_inicial": $("#value").val()
            }),
            success: function (success) {
                $("#init-modal").modal('hide');
            },
            error: function (err) {
                $(".alert-danger").addClass("show")
                $(".alert-danger").append(err)
            }
        })
    } else {
        $("#value").addClass("is-invalid")
    }
})

$(".goInvoices").click(function (e) {
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
function reloadProduct() {
    $.ajax({
        url: 'readByProduct',
        dataType: "json",
        type: "POST",
        data: ({
            "columnDBSearch": 1,
            "value": 1
        }),
        success: function (response) {
            for (var i = 0; i < response.data.length; i++) {
                
            }
        },
        error: function (err) {
            console.log(err);
        },
    });
}

function reserva(data, id) {
    console.log(data ,id);
    $.ajax({
        url: 'readByRoom',
        dataType: "json",
        type: "POST",
        data: ({
            "columnDBSearch": "hab_numero",
            "value": id
        }),
        success: function(success) {
            var data = success.data[0];
            console.log(data);
            
        },
        error: function (err) {
            
        }
    });
    
    switch (data) {
        case 1:
            $("#invoices").addClass('active');
            $("#content-card").hide()
            $("#reception").hide()
            break;
    
        default:
            break;
    }
    
}

    
