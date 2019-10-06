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
        }
    });
});
function closeAlerts() {
    setTimeout(() => {
        $(".alert").removeClass('show')
        $(".alert").empty()
    }, 5000);
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
                    }
                });
                $(".alert-create-room").addClass("show");
                $(".alert-create-room").empty();
                $(".alert-create-room").append(success.message);
                realoadRoom();
            },
            error: function (err) {
                var message = err.responseJSON.message;
                $(".alert-error").addClass("show");
                $(".alert-error").empty();
                $(".alert-error").append(message);
            }
        });
    } else {
        console.log("error");
    }
    closeAlerts();
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
                "valor_persona_adicional": $('#people').val(),
                "price_hora_1":$("#price_hora_1").val(),
                "price_hora_2":$("#price_hora_2").val(),
                "price_hora_3":$("#price_hora_3").val(),
                "price_hora_4":$("#price_hora_4").val(),
                "price_hora_5":$("#price_hora_5").val(),
                "price_hora_6":$("#price_hora_6").val(),
                "price_hora_7":$("#price_hora_7").val(),
                "price_hora_8":$("#price_hora_8").val(),
                "price_hora_9":$("#price_hora_9").val(),
                "price_hora_10":$("#price_hora_10").val(),
                "price_hora_11":$("#price_hora_11").val(),
                "price_hora_12":$("#price_hora_12").val(),
                "price_hora_13":$("#price_hora_13").val(),
                "price_hora_14":$("#price_hora_14").val(),
                "price_hora_15":$("#price_hora_15").val(),
                "price_hora_16":$("#price_hora_16").val(),
                "price_hora_17":$("#price_hora_17").val(),
                "price_hora_18":$("#price_hora_18").val(),
                "price_hora_19":$("#price_hora_19").val(),
                "price_hora_20":$("#price_hora_20").val(),
                "price_hora_21":$("#price_hora_21").val(),
                "price_hora_22":$("#price_hora_22").val(),
                "price_hora_23":$("#price_hora_23").val(),
                "price_hora_24":$("#price_hora_24").val()
            }),
            success: function (success) {
                reloadTypeRoom();
                $("#alert-success").addClass('show')
                $("#alert-success").empty()
                $("#alert-success").append()
                alert(success.message);
                $("#form-type-room")[0].reset();
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
            "valor_persona_adicional": $('#people-up').val(),
            "price_hora_1":$("#update_price_hora_1").val(),
            "price_hora_2":$("#update_price_hora_2").val(),
            "price_hora_3":$("#update_price_hora_3").val(),
            "price_hora_4":$("#update_price_hora_4").val(),
            "price_hora_5":$("#update_price_hora_5").val(),
            "price_hora_6":$("#update_price_hora_6").val(),
            "price_hora_7":$("#update_price_hora_7").val(),
            "price_hora_8":$("#update_price_hora_8").val(),
            "price_hora_9":$("#update_price_hora_9").val(),
            "price_hora_10":$("#update_price_hora_10").val(),
            "price_hora_11":$("#update_price_hora_11").val(),
            "price_hora_12":$("#update_price_hora_12").val(),
            "price_hora_13":$("#update_price_hora_13").val(),
            "price_hora_14":$("#update_price_hora_14").val(),
            "price_hora_15":$("#update_price_hora_15").val(),
            "price_hora_16":$("#update_price_hora_16").val(),
            "price_hora_17":$("#update_price_hora_17").val(),
            "price_hora_18":$("#update_price_hora_18").val(),
            "price_hora_19":$("#update_price_hora_19").val(),
            "price_hora_20":$("#update_price_hora_20").val(),
            "price_hora_21":$("#update_price_hora_21").val(),
            "price_hora_22":$("#update_price_hora_22").val(),
            "price_hora_23":$("#update_price_hora_23").val(),
            "price_hora_24":$("#update_price_hora_23").val()
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
            $("#update-room").modal('hide');
            $(".alert-list").addClass('show');
            $(".alert-list").append(success.message);
            realoadRoom();
        },
        error: function (err) {
            $(".danger-modal").addClass("show");
            $(".danger-modal").append(err.responseJSON.message)
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
                    <td>${response.data[i].hab_detalle}</td>
                    <td>${response.data[i].th_nombre_tipo}</td>
                    <td>${response.data[i].th_valor_hora_despues24}</td>
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
                    <td>${response.data[i].th_valor_hora_despues24}</td>
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
            reloadTypeRoom();
            realoadRoom();
            $(".alert-success").addClass('show');
            $(".alert-success").empty();
            $(".alert-success").append(success.message)
            
        },
        error: function (err) {
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
            $('#hour-value-up').val(data.th_valor_hora_despues24),
            $('#people-up').val(data.th_valor_persona_adicional),
            $("#update_price_hora_1").val(data.th_valor_hora1),
            $("#update_price_hora_2").val(data.th_valor_hora2),
            $("#update_price_hora_3").val(data.th_valor_hora3),
            $("#update_price_hora_4").val(data.th_valor_hora4),
            $("#update_price_hora_5").val(data.th_valor_hora5),
            $("#update_price_hora_6").val(data.th_valor_hora6),
            $("#update_price_hora_7").val(data.th_valor_hora7),
            $("#update_price_hora_8").val(data.th_valor_hora8),
            $("#update_price_hora_9").val(data.th_valor_hora9),
            $("#update_price_hora_10").val(data.th_valor_hora10),
            $("#update_price_hora_11").val(data.th_valor_hora11),
            $("#update_price_hora_12").val(data.th_valor_hora12),
            $("#update_price_hora_13").val(data.th_valor_hora13),
            $("#update_price_hora_14").val(data.th_valor_hora14),
            $("#update_price_hora_15").val(data.th_valor_hora14),
            $("#update_price_hora_16").val(data.th_valor_hora16),
            $("#update_price_hora_17").val(data.th_valor_hora17),
            $("#update_price_hora_18").val(data.th_valor_hora18),
            $("#update_price_hora_19").val(data.th_valor_hora19),
            $("#update_price_hora_20").val(data.th_valor_hora20),
            $("#update_price_hora_21").val(data.th_valor_hora21),
            $("#update_price_hora_22").val(data.th_valor_hora22),
            $("#update_price_hora_23").val(data.th_valor_hora23),
            $("#update_price_hora_24").val(data.th_valor_hora24)
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
            $("#room-status-up").val(data.hab_estado);
            $("#room-number-up").val(data.hab_numero);
            $("#room-detail-up").val(data.hab_detalle);
            $(`#room-type-up option[value=${id}]`).attr("selected", true);
        },
        error: function (err) {
            
        }
    })   
}