$(document).ready(function () {
    realoanUser();
    realoanPromo();
    getReserveStatus();
    $("#table-promo").DataTable();

});

function getReserveStatus() {
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
                console.log(elm.sr_color);
                $("#content-shema").append(`
                    <div class="row">
                            <div class="col">
                                <div class="shema-card">
                                    <div class="liner-shema" id="shema-${elm.sr_estado_reserva}" style="background: ${elm.sr_color}"></div>
                                    <h3 class="text-center" id="text-${elm.sr_estado_reserva}" style="color: ${elm.sr_color}">X</h3>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="${elm.sr_estado_reserva}">${elm.sr_nombre}</label>
                                    <select id="${elm.sr_estado_reserva}" class="form-control select-color">
                                    </select>
                                </div>
                            </div>
                        </div>
               `);

            }
            colors = [
                {"value":"#17a2b8","label":"Azul"},
                {"value":"#28a745","label":"Verde"},
                {"value":"#ffc107","label":"Amarillo"},
                {"value":"#6f42c1","label":"Violeta"},
                {"value":"#dc3545","label":"Rojo"},
                {"value":"#343a40","label":"Negro"},
                {"value":"#fd7e14","label":"Naranja"},
                {"value":"#6c757d","label":"gris"},
                {"value":"#e83e8c","label":"rosado"}
            ]
            for (let i = 0; i < colors.length; i++) {
                const color = colors[i];
                $(".select-color").append($("<option>",{
                    value: color.value,
                    text: color.label
                }));
                   
                
            }

            
        },
        error: function (err) {

        }
    })
}

$("#1").change(function() {
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
                $("#table-promo> tbody:last").append(`
                    <tr>
                    <td>${response.data[i].promo_nombre}</td>
                    <td>${response.data[i].promo_tiempo}</td>
                    <td>${response.data[i].promo_valor}</td>
                    <td class="d-flex justify-content-around">
                        <img src="views/assets/icons/edit.png" class="icon-list" onclick="updatePromo(${response.data[i].id_promocion})">
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
            realoanPromo();
        },
        error: function (err) {

        }
    })
}
function closeAlerts() {
    setTimeout(() => {
        $(".alert").removeClass('show')
        $(".alert").empty()
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
            "duracion": $("#update-promo-time").val(),
            "valor": $("#update-promo-value").val(),
            "id": $("#update-promo-id").val(),
            "estado": $("#update-promo-status").val()
        }),
        success: function (success) {
            $("#create-promo").modal('hide');
            $(".alert-success").addClass('show')
            $(".alert-success").append(success.message);
            realoanPromo();
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
        $("#alert").removeClass("show");
        $("#alert").empty();
    }, 6000);
})