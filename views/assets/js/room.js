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
setTimeout(() => {
    $(".alert").removeClass("show");
    $(".alert").empty();
}, 6000);

})

$("#form-update-type-room").submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: 'UpdateTypeRoom',
        type: 'POST',
        dataType: 'json',
        data: ({
            "id": $('#room-type-id-up').val(),
            "estado": $('#room-type-status-up').val(),
            "nombre_tipo": $('#room-type-name-up').val(),
            "descripcion": $('#room-type-detail-up').val(),
            "valor_hora": $('#hour-value-up').val(),
            "valor_persona_adicional": $('#people-up').val()
        }),
        success: function (success) {
            reloadTypeRoom();
            $("#alert-success").addClass('show');
            $("#alert-success").append(success.message);
        },
        error: function (err) {
            var message = err.responseJSON.message;
            $(".danger-modal").addClass("show");
            $(".danger-modal").append(message);
        }
    });
    setTimeout(() => {
        $(".alert").removeClass("show");
        $(".alert").empty();
    }, 6000);
})

$("#form-update-room").submit(function(e) {
    e.preventDefault()
    $.ajax({
        url: 'UpdateRoom',
        dataType: "json",
        type: "POST",
        data: ({
            "tipo_habitacion": $("#room-type-up").val(),
            "hab_detalle": $("#room-detail-up").val(),
            "id": $("#room-number-up").val(),
            "estado": $("#room-status-up").val()
        }),
        success: function(success) {
            console.log(success);
            
            $("#update-room").modal('hide');
            $("#alert-success").addClass('show');
            $("#alert-success").append(success.message);
        },
        error: function (err) {
           console.log(err);
           
            $(".danger-modal").addClass("show");
            $(".danger-modal").append(err.message)
        }
    });
    setTimeout(() => {
        $(".alert").removeClass("show");
        $(".alert").empty();
    }, 6000);
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
                        <img src="views/assets/icons/edit.png" class="icon-list" onclick="updateRoom(${response.data[i].hab_numero})">
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
            $('#room-type, #room-type-up').empty();
            $.each(options, function (value, item) {
                $("#room-type, #room-type-up").append($("<option>",{
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
                        <img src="views/assets/icons/edit.png" class="icon-list" onclick="updateType(${response.data[i].id_tipo_habitacion}, 'deleteTypeRoom')">
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
function updateType(id) {
    $.ajax({
        url: 'readByTypeRoom',
        dataType: "json",
        type: "POST",
        data: ({
            "columnDBSearch": "id_tipo_habitacion",
            "value": id
        }),
        success: function(success) {
            var data = success.data[0];
            $("#update-type").modal('show');
            $('#room-type-id-up').val(data.id_tipo_habitacion),
            $('#room-type-status-up').val(data.th_estado),
            $('#room-type-name-up').val(data.th_nombre_tipo),
            $('#room-type-detail-up').val(data.th_descripcion),
            $('#hour-value-up').val(data.th_valor_hora),
            $('#people-up').val(data.th_valor_persona_adicional)
        },
        error: function (err) {
            
        }
    })

}

function updateRoom(id) {
    $.ajax({
        url: 'readByRoom',
        dataType: "json",
        type: "POST",
        data: ({
            "columnDBSearch": "hab_numero",
            "value": id
        }),
        success: function(success) {
            data= success.data[0];
            $("#update-room").modal("show");
            $("#room-status-up").val(data.hab_estado),
            $("#room-number-up").val(data.hab_numero),
            $("#room-type-up").val(data.th_nombre_tipo),
            $("#room-detail-up").val(data.hab_detalle)
            
        },
        error: function (err) {
            
        }
    })   
}