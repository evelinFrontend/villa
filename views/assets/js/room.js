$(document).ready(function () {
    $('#table-type-room').DataTable();
    $('#table-create-room').DataTable();
    $.ajax({
        url: 'readByTypeRoom',
        type: 'POST',
        dataType: 'json',
        data: ({
            "columnDBSearch": 1,
            "value": 1
        }),
        success: function (success) {
            var options = success.data;
            $.each(options, function (value, item) {
                $("#room-type").append($("<option>",{
                    value: item.id_tipo_habitacion,
                    text: item.th_nombre_tipo
                }));
                   
            })
        },
        error: function (err) {
            var message = err.responseJSON.message;
        }
    });
    $.ajax({
        url: 'newNumberOfRoom',
        type: 'GET',
        dataType: 'json',
        success: function (success) {
            $("#room-number").val(success.numero_nueva_habitacion);
        },
        error: function (err) {
            var message = err.responseJSON.message;
            console.log(message);
        }
    });
});

function getTyperoom() {
    
}

function openModal() {
    $('#detail-modal').modal('show')
}

$("#create-room").submit(function(e) {
    e.preventDefault();
    if ($("#room-type").val() !== '') {
        $.ajax({
            url: 'createRoom',
            type: 'POST',
            dataType: 'json',
            data: ({
                "tipo_habitacion": $("#room-type").val(),
                "detalles": $("#room-detail").val()
            }),
            success: function (success) {
                console.log(success);
                $("#create-room").trigger("reset");
                $.ajax({
                    url: 'newNumberOfRoom',
                    type: 'GET',
                    dataType: 'json',
                    success: function (success) {
                        $("#room-number").val(success.numero_nueva_habitacion);
                    },
                    error: function (err) {
                        var message = err.responseJSON.message;
                        console.log(message);
                    }
                });
                $(".alert-success").addClass("show");
                $(".alert-success").empty();
                $(".alert-success").append(success.message);
            },
            error: function (err) {
                var message = err.responseJSON.message;
                $(".alert").addClass("show");
                $(".alert").empty();
                $(".alert").append(message);
            }
        });
    } else {
        console.log("error");
        
    }
})

$("#form-type-room").submit(function (e) {
    e.preventDefault();
    if ($('#room-type-name').val() !== '' && $('#room-type-detail').val() !== '' && $('#hour-value').val() !== '' && $('#people').val() !== '') {
        $.ajax({
            url: 'createType',
            type: 'POST',
            dataType: 'json',
            data: ({
                "nombre_tipo": $('#room-type-name').val(),
                "descripcion": $('#room-type-detail').val(),
                "valor_hora": $('#hour-value').val(),
                "valor_persona_adicional": $('#people').val()
            }),
            success: function (success) {
                console.log(success);
            },
            error: function (err) {
                var message = err.responseJSON.message;
                $(".alert").addClass("show");
                $(".alert").empty();
                $(".alert").append(message);
            }
        });
    } else {
        $(".alert").addClass("show");
        $(".alert").empty();
        $(".alert").append("Todos los campos son obligatorios");
    }


})


