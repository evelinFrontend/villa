$(document).ready(function () {
    realoanUser();
    realoanPromo();
    getReserveStatus();
    $("#table-promo").DataTable();

});



function getReserveStatus() {
    colors = [
        { "value": "#17a2b8", "label": "Azul" },
        { "value": "#28a745", "label": "Verde" },
        { "value": "#ffc107", "label": "Amarillo" },
        { "value": "#6f42c1", "label": "Violeta" },
        { "value": "#dc3545", "label": "Rojo" },
        { "value": "#343a40", "label": "Negro" },
        { "value": "#fd7e14", "label": "Naranja" },
        { "value": "#6c757d", "label": "gris" },
        { "value": "#e83e8c", "label": "rosado" }
    ]
    for (let i = 0; i < colors.length; i++) {
        const color = colors[i];
        $(".select-color").append($("<option>", {
            value: color.value,
            text: color.label
        }));


    }
    $.ajax({
        url: 'readBystateR',
        dataType: "json",
        type: "POST",
        data: ({
            "columnDBSearch": 1,
            "value": 1
        }),
        success: function (success) {
            for (let i = 0; i < success.data.length; i++) {
                const elm = success.data[i];
                switch (elm.sr_estado_reserva) {
                    case "1":
                        $("#shema-disponible").css("background-color", elm.sr_color)
                        $("#text-disponible").css("color", elm.sr_color)
                        $(`#disponible option[value="${elm.sr_color}"]`).attr("selected", true);
                        break;
                    case "2":
                        $("#shema-reservado").css("background-color", elm.sr_color)
                        $("#text-reservado").css("color", elm.sr_color)
                        $(`#reservado option[value="${elm.sr_color}"]`).attr("selected", true);
                        break;
                    case "3":
                        $("#shema-tiempo-parcial").css("background-color", elm.sr_color);
                        $("#text-tiempo-parcial").css("color", elm.sr_color);
                        $(`#tiempo-parcial option[value="${elm.sr_color}"]`).attr("selected", true);
                        break;
                    case "4":
                        $("#shema-cortesia").css("background-color", elm.sr_color);
                        $("#text-cortesia").css("color", elm.sr_color);
                        $(`#cortesia option[value="${elm.sr_color}"]`).attr("selected", true);
                        break;
                    case "5":
                        $("#shema-promocion").css("background-color", elm.sr_color);
                        $("#text-promocion").css("color", elm.sr_color);
                        $(`#promocion option[value="${elm.sr_color}"]`).attr("selected", true);
                        break;
                    case "6":
                        $("#shema-limpieza").css("background-color", elm.sr_color);
                        $("#text-limpieza").css("color", elm.sr_color);
                        $(`#limpieza option[value="${elm.sr_color}"]`).attr("selected", true);
                        break;
                    default:
                        break;
                }

            }

        },
        error: function (err) {

        }
    })
}

$("#1").change(function () {
    alert("afsdfsdf")
    console.log("daojs");

})


function realoanUser() {
    $.ajax({
        url: 'readUsuBy',
        dataType: "json",
        type: "POST",
        data: ({
            "columnDBSearch": 1,
            "value": 1
        }),
        success: function (response) {
            for (var i = 0; i < response.data.length; i++) {
                $("#table-employee> tbody:last").append(`
                    <tr>
                    <td>${response.data[i].usu_nombres}</td>
                    <td>${response.data[i].usu_apellidos}</td>
                    <td>${response.data[i].usu_numero_contacto}</td>
                    <td class="d-flex justify-content-around">
                        <img src="views/assets/icons/edit.png" class="icon-list" onclick="updateUser(${response.data[i].usu_id})">
                        <img src="views/assets/icons/delete.png" class="icon-list" onclick="deleteData(${response.data[i].usu_id}, 'deleteUser')">
                    </td>
                    </tr>
                `)
            }
            $('#table-employee').DataTable();
        },
        error: function (err) {
            console.log(err);
        }
    });

}
function realoanPromo() {
    $.ajax({
        url: 'readByPromo',
        dataType: "json",
        type: "POST",
        data: ({
            "columnDBSearch": 1,
            "value": 1
        }),
        success: function (response) {
            console.log(response);
            $("#table-promo> tbody:last").empty();
            for (var i = 0; i < response.data.length; i++) {
                var valorProm = new Intl.NumberFormat().format(response.data[i].promo_valor);
                $("#table-promo> tbody:last").append(`
                    <tr>
                    <td>${response.data[i].promo_nombre}</td>
                    <td>${response.data[i].promo_tiempo}</td>
                    <td>${valorProm}</td>
                    <td class="d-flex justify-content-around">
                        <img src="views/assets/icons/edit.png" class="icon-list" onclick="updatePromo(${response.data[i].id_promocion})">
                        <img src="views/assets/icons/delete.png" class="icon-list" onclick="DeletePromo(${response.data[i].id_promocion})">
                    </td>
                    </tr>
                `)
            }
            $('#table-promo').DataTable();
        },
        error: function (err) {
            console.log(err);

        }
    })
}
function deleteData(id, url) {
    $.ajax({
        url: url,
        dataType: "json",
        type: "POST",
        data: ({
            "id": id,
        }),
        success: function (success) {
            console.log(success);

        },
        error: function (err) {
            console.log(err);

        }
    })
}
function DeletePromo(id) {
    if(confirm("¿Deseas eliminar esta promoción?")){
        $.ajax({
            url: "DeletePromo",
            dataType: "json",
            type: "POST",
            data: ({
                "id": id,
            }),
            success: function (success) {
               location.reload();
    
            },
            error: function (err) {
                alert("Esta promoción no se puede eliminar debido a que tiene registros relacionados, puedes inactivarla.");
                console.log(err);
    
            }
        })
    }
}
function updateUser(id) {
    $.ajax({
        url: 'readUsuBy',
        dataType: "json",
        type: "POST",
        data: ({
            "columnDBSearch": "usu_id",
            "value": id
        }),
        success: function (success) {
            $("#update-employee").modal('show');
            $(".modal-user-data").empty();
            var data = success.data[0];
            $(".modal-user-data").append(`
                <div class="col-4">
                    <p>Nombre: </p>
                    <strong>${data.usu_nombres} ${data.usu_apellidos}</strong>
                </div>
                <div class="col-4">
                    <p>Numero de documento: </p>
                    <strong>${data.usu_numero_documento}</strong>
                </div>
                <div class="col-4">
                    <p>Celular: </p>
                    <strong>${data.promo_valor}</strong>
                </div>
                <div class="col-4">
                    <p>Correo: </p>
                    <strong>${data.usu_correo}</strong>
                </div>
                <div class="col-4">
                    <p>Fecha de nacimiento: </p>
                    <strong>${data.usu_fecha_nacimiento}</strong>
                </div>
                <div class="col-4">
                    <p>Nombre de usuario: </p>
                    <strong>${data.usu_nombre_login}</strong>
                </div>
            `)
            $("#code-up").val(data.usu_id)
            $("#name-employee-up").val(data.usu_nombres)
            $("#lastname-employee-up").val(data.usu_apellidos)
            $("#doc-employee-up").val(data.usu_numero_documento)
            $("#birthdate-up").val(data.usu_fecha_nacimiento)
            $("#email-up").val(data.usu_correo)
            $("#number-up").val(data.usu_numero_contacto)
            $("#rol-up").val(data.usu_rol)
            $("#user-name-employee-up").val(data.usu_nombre_login)
        },
        error: function (err) {
            console.log(err);
        }
    })
}
function updatePromo(id) {
    $.ajax({
        url: 'readByPromo',
        dataType: "json",
        type: "POST",
        data: ({
            "columnDBSearch": "id_promocion",
            "value": id
        }),
        success: function (success) {
            var data = success.data[0]
            $("#update-promo").modal("show");
            $("#update-promo-times").val(data.promo_tiempo);
            $("#update-promo-name").val(data.promo_nombre);
            $("#update-promo-value").val(data.promo_valor);
            $("#update-promo-id").val(data.id_promocion);
            $("#update-promo-status").val(data.promo_estado);
            // realoanPromo();
        },
        error: function (err) {
            console.log(err);
            
        }
    })
}
function closeAlerts() {
    setTimeout(() => {
        $(".alert").removeClass('show')
        $(".alert").empty(),
        location.reload();
    }, 5000);
}

$('#form-create-employee').submit(function (e) {
    e.preventDefault();
    if (
        $('#name-employee').val() !== '' &&
        $('#lastname-employee').val() !== '' &&
        $('#doc-employee').val() !== '' &&
        $('#birthdate').val() !== '' &&
        $('#number').val() !== '' &&
        $('#rol').val() !== '' &&
        $('#user-name-employee').val() !== '' &&
        $('#password-employee').val() !== '' &&
        $('#password-repet-employee').val() !== ''
    ) {
        if ($('#password-employee').val() === $('#password-repet-employee').val()) {
            $.ajax({
                url: 'createUser',
                type: 'POST',
                dataType: 'json',
                data: ({
                    "nombres": $('#name-employee').val(),
                    "apellidos": $('#lastname-employee').val(),
                    "numero_documento": $('#doc-employee').val(),
                    "fecha_nacimiento": $('#birthdate').val(),
                    "numero_contacto": $('#number').val(),
                    "correo": $('#email').val(),
                    "nombre_login": $('#user-name-employee').val(),
                    "rol": $('#rol').val(),
                    "contrasena": $('#password-employee').val(),
                    "rep_contrasena": $('#password-repet-employee').val()
                }),
                success: function (success) {
                    $('#create-employee').modal('hide')
                    $(".alert-success").addClass('show')
                    $(".alert-success").append(success.message);
                    $("#table-employee").empty()
                    realoanUser();
                },
                error: function (err) {
                    $(".alert-danger").addClass('show')
                    $(".alert-danger").append(err.responseJSON.message)
                    console.log(err);
                }
            });
        } else {
            $("#password-employee, #password-repet-employee").addClass("is-invalid")
        }
    } else {
        console.log('buu');
        $("#alert-danger").addClass("show");
        $("#alert-danger").append("Todos los datos son obligatorios");
    }
    closeAlerts();
})
$('#form-update-employee').submit(function (e) {
    e.preventDefault();
    if (
        $('#name-employee-up').val() !== '' &&
        $('#lastname-employee-up').val() !== '' &&
        $('#doc-employee-up').val() !== '' &&
        $('#birthdate-up').val() !== '' &&
        $('#number-up').val() !== '' &&
        $('#rol-up').val() !== '' &&
        $('#user-name-employee-up').val() !== '' &&
        $('#password-employee-up').val() !== '' &&
        $('#password-repet-employee-up').val() !== ''
    ) {
        $.ajax({
            url: 'UpdateUser',
            type: 'POST',
            dataType: 'json',
            data: ({
                "id": $('#code-up').val(),
                "nombres": $('#name-employee-up').val(),
                "apellidos": $('#lastname-employee-up').val(),
                "numero_documento": $('#doc-employee-up').val(),
                "fecha_nacimiento": $('#birthdate-up').val(),
                "numero_contacto": $('#number-up').val(),
                "correo": $('#email-up').val(),
                "nombre_login": $('#user-name-employee-up').val(),
                "rol": $('#rol-up').val(),
            }),
            success: function (success) {
                $("#table-employee > tbody>").empty();
                realoanUser();
                $("#update-employee").modal('hide')
                $(".alert-success").addClass('show')
                $(".alert-success").append(success.message)
            },
            error: function (err) {
                console.log(err);
            }
        });

    } else {
        console.log('todos campos');

    }
    closeAlerts();
})

// PENDIENTE!!!!!! MAPEAR EL ERROR
$("#form-update-promo").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: 'UptadePromo',
        dataType: "json",
        type: "POST",
        data: ({
            "nombre": $("#update-promo-name").val(),
            "duracion": $("#update-promo-times").val(),
            "valor": $("#update-promo-value").val(),
            "id": $("#update-promo-id").val(),
            "estado": $("#update-promo-status").val()
        }),
        success: function (success) {
            console.log(success);
            $("#create-promo").modal('hide');
            $(".alert-success").addClass('show')
            $(".alert-success").append(success.message);
            $("#update-promo").removeClass("show");
            // $("#update-promo").hide();
            location.reload();
            // realoanPromo();
        },
        error: function (err) {
            console.log(err);
            $(".alert-danger").addClass('show')
            $(".alert-danger").append(err.responseJSON.message)
        }
    });
    closeAlerts();
})
$("#form-create-promo").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: 'createPromo',
        dataType: "json",
        type: "POST",
        data: ({
            "nombre": $("#promo-name").val(),
            "duracion": $("#promo-time").val(),
            "valor": $("#promo-value").val()
        }),
        success: function (success) {
            $("#create-promo").modal('hide');
            $(".alert-success").addClass('show')
            $(".alert-success").append(success.message)
            realoanPromo();
        },
        error: function (err) {
            $(".alert-danger").addClass('show')
            $(".alert-danger").append(err.responseJSON.message)
        }
    });
    setTimeout(() => {
        $(".alert").removeClass("show");
        $(".alert").empty();
    }, 6000);
});

function closeAlert() {
    setTimeout(() => {
        $(".alert").empty();
        $(".alert").removeClass("show");
    }, 4000);
}

$("#changeDisponible").submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: 'UptadeStateR',
        dataType: "json",
        type: "POST",
        data: ({
            "id": "1",
            "nombre": "Disponible",
            "color": $("#disponible").val(),
            "descripcion": "Esta disponible"
        }),
        success: function(success) {
            $(".alert-success").addClass("show");
            $(".alert-success").append(success.message);
        },
        error: function (err) {
            $(".alert-danger").addClass("show");
            $(".alert-danger").append(err);
        }
    });
    closeAlert();
})
$("#changeReservada").submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: 'UptadeStateR',
        dataType: "json",
        type: "POST",
        data: ({
            "id": "2",
            "nombre": "Reservada",
            "color": $("#reservado").val(),
            "descripcion": "Esta disponible"
        }),
        success: function(success) {
            console.log(success);
            $(".alert-success").addClass("show");
            $(".alert-success").append(success.message);
        },
        error: function (err) {
            $(".alert-danger").addClass("show");
            $(".alert-danger").append(err);
        }
    });
    closeAlert();
})
$("#changeTiempo").submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: 'UptadeStateR',
        dataType: "json",
        type: "POST",
        data: ({
            "id": "3",
            "nombre": "iempo Parcial",
            "color": $("#tiempo-parcial").val(),
            "descripcion": "Esta disponible"
        }),
        success: function(success) {
            console.log(success);
            $(".alert-success").addClass("show");
            $(".alert-success").append(success.message);
        },
        error: function (err) {
            $(".alert-danger").addClass("show");
            $(".alert-danger").append(err);
        }
    });
    closeAlert();
})
$("#changeCortesia").submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: 'UptadeStateR',
        dataType: "json",
        type: "POST",
        data: ({
            "id": "4",
            "nombre": "Cortesia",
            "color": $("#cortesia").val(),
            "descripcion": "Esta disponible"
        }),
        success: function(success) {
            console.log(success);
            $(".alert-success").addClass("show");
            $(".alert-success").append(success.message);
        },
        error: function (err) {
            $(".alert-danger").addClass("show");
            $(".alert-danger").append(err);
        }
    });
    closeAlert();
})
$("#changeReservada").submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: 'UptadeStateR',
        dataType: "json",
        type: "POST",
        data: ({
            "id": "2",
            "nombre": "Reservada",
            "color": $("#reservado").val(),
            "descripcion": "Esta disponible"
        }),
        success: function(success) {
            console.log(success);
            $(".alert-success").addClass("show");
            $(".alert-success").append(success.message);
        },
        error: function (err) {
            $(".alert-danger").addClass("show");
            $(".alert-danger").append(err);
        }
    });
    closeAlert();
})
$("#changePromocion").submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: 'UptadeStateR',
        dataType: "json",
        type: "POST",
        data: ({
            "id": "5",
            "nombre": "Promoción",
            "color": $("#promocion").val(),
            "descripcion": "Esta disponible"
        }),
        success: function(success) {
            console.log(success);
            $(".alert-success").addClass("show");
            $(".alert-success").append(success.message);
        },
        error: function (err) {
            $(".alert-danger").addClass("show");
            $(".alert-danger").append(err);
        }
    });
    closeAlert();
})
$("#changeLimpieza").submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: 'UptadeStateR',
        dataType: "json",
        type: "POST",
        data: ({
            "id": "6",
            "nombre": "Limpieza",
            "color": $("#limpieza").val(),
            "descripcion": "Esta disponible"
        }),
        success: function(success) {
            console.log(success);
            $(".alert-success").addClass("show");
            $(".alert-success").append(success.message);
        },
        error: function (err) {
            $(".alert-danger").addClass("show");
            $(".alert-danger").append(err);
        }
    });
    closeAlert();
});
function currecy(id) {
    value = $('#'+id).val();
    var total = new Intl.NumberFormat().format(value);
    console.log(total);
    $('.'+id).empty()
    $('.'+id).append(total)
    
}