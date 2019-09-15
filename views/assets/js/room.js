$(document).ready(function () {
    $('#table-create-room').DataTable();
    reloadTypeRoom();
    realoadRoom();
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
                realoadRoom();
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
                reloadTypeRoom();
                $("#alert-success").addClass('show')
                $("#alert-success").empty()
                $("#alert-success").append(success.message)
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

function realoadRoom(){
    $.ajax({
        url: 'readByRoom',
        dataType: "json",
        type: "POST",
        data: ({
            "columnDBSearch": 1,
            "value": 1
        }),
        success: function (response) {
            $('#table-create-room> tbody>').empty();
            for (var i = 0; i < response.data.length; i++) {
                $('#table-create-room> tbody:last').append(`
                <tr>
                    <th>${response.data[i].hab_numero}</th>
                    <td>${response.data[i].th_descripcion}</td>
                    <td>${response.data[i].th_nombre_tipo}</td>
                    <td>${response.data[i].th_valor_hora}</td>
                    <td>${response.data[i].th_valor_persona_adicional}</td>
                    <td class="d-flex justify-content-around">
                        <img src="views/assets/icons/print.png" class="icon-list">
                        <img src="views/assets/icons/delete.png" class="icon-list" onclick="deleteRoom(${response.data[i].hab_numero}, 'deleteRoom')">
                    </td>
                </tr>
                `);
            }
            $('#table-create-room').DataTable();
        },
        error: function (response) {
            console.log(response);
        },
    });
}

function reloadTypeRoom(){
    //cargar el option de tipo de habitacion
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
            $('#room-type').empty();
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

    //llenar la  tabla de tipos de habitacion
    $.ajax({
        url: 'readByTypeRoom',
        dataType: "json",
        type: "POST",
        data: ({
            "columnDBSearch": 1,
            "value": 1
        }),
        success: function (response) {
            $('#table-type-room> tbody>').empty();
            for (var i = 0; i < response.data.length; i++) {
                $('#table-type-room> tbody:last').append(`
                <tr>
                    <th>${response.data[i].th_nombre_tipo}</th>
                    <td>${response.data[i].th_descripcion}</td>
                    <td>${response.data[i].th_valor_hora}</td>
                    <td>${response.data[i].th_valor_persona_adicional}</td>
                    <td class="d-flex justify-content-around">
                        <img src="views/assets/icons/delete.png" class="icon-list" onclick="deleteRoom(${response.data[i].id_tipo_habitacion}, 'deleteTypeRoom')">
                    </td>
                </tr>
                `);
            }
            $('#table-type-room').DataTable();
        },
        error: function (response) {
            console.log(response);
        },
    });
}

function deleteRoom(id, url) {
    $.ajax({
        url: url,
        dataType: "json",
        type: "POST",
        data: ({
            "id": id,
        }),
        success: function(success) {
            console.log(success);
            reloadTypeRoom();
            realoadRoom();
            $(".alert-success").addClass('show');
            $(".alert-success").empty();
            $(".alert-success").append(success.message)
            
        },
        error: function (err) {
            console.log(err);
            $(".alert-alert-danger").addClass('show')
            $(".alert-alert-danger").empty();
            $(".alert-alert-danger").append(success.message)
        }
    })
    setTimeout(() => {
        $(".alert").removeClass('show')
        $(".alert").empty()
    }, 5000);
}