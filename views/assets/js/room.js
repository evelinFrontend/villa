$(document).ready(function () {
    $('#table-type-room').DataTable();
    $('#table-create-room').DataTable();
    $.ajax({
        url: 'readByTypeRoom',
        type: 'POST',
        dataType: 'json',
        data: ({
            "columnDBSearch": "1",
            "value": "1"
        }),
        success: function (success) {
            console.log(success);
        },
        error: function (err) {
            var message = err.responseJSON.message;
            console.log(message);
        }
    });
    $.ajax({
        url: 'newNumberOfRoom',
        type: 'GET',
        dataType: 'json',
        success: function (success) {
            console.log(success);
        },
        error: function (err) {
            var message = err.responseJSON.message;
            console.log(message);
        }
    });
});

function openModal() {
    $('#detail-modal').modal('show')
}

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


