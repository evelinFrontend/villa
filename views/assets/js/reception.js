
$("#reception").ready(function () {
    $("#content-additional").hide();
    $("#content-additional-re").hide();
    getTurno();
    getRooms();
    getProducts();
    getPromo()
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
            for (var i = 0; i < success.data.length; i++) {
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
function getPromo() {
    $.ajax({
        url: 'readByPromo',
        dataType: "json",
        type: "POST",
        data: ({
            "columnDBSearch": 1,
            "value": 1
        }),
        success: function (success) {
            data = success.data
            for (let i = 0; i < data.length; i++) {
                const elt = data[i];
                $("#courtesy, #courtesy-re").append(`
                    <option value="${elt.id_promocion}">${elt.promo_nombre}</option>
                `)
            }
        },
        error: function (err) {

        }
    })
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
});

//facturar 
$(".goInvoices").click(function (e) {
    $("#invoices").addClass('active');
    $("#reception").hide();
})
$("#select-person, #select-person-re").change(function () {
    if ($("#select-person").val() === 'si') {
        $("#content-additional").show()
    } else {
        $("#content-additional").hide()
    }
})
$("#select-person-re").change(function () {
    if ($("#select-person-re").val() === 'si') {
        $("#content-additional-re").show()
        console.log("sdkocmsdn");
        
    } else {
        $("#content-additional-re").hide()
    }
})

function getProducts() {
    $.ajax({
        url: 'readByProduct',
        dataType: "json",
        type: "POST",
        data: ({
            "columnDBSearch": 1,
            "value": 1
        }),
        success: function (success) {
            for (var i = 0; i < success.data.length; i++) {
                var data = success.data[i];
                $("#modal-content-products, #modal-content-products-re").append(`
                <div class="product-card row" id="prod-${data.id_producto}" onclick="addArray(this.id, ${data.id_producto}, '${data.pro_nombre}', ${data.pro_precio_venta})">
                    <div class="col d-flex" id="img-product">
                        <img src="views/assets/img/products/${data.pro_imagen}">
                    </div>
                    <div class="col" id="detail-product">
                        <h6 class="name">${data.pro_nombre}</h6>
                        <p>${data.pro_precio_venta}</p>
                    </div>
                 </div>
                `)
            }
        },
        error: function (err) {

        }
    })
}

// reservar
var products = [];
var productData = [];
var monto;
var canti = 0;
var multi = 1;
var input = 1
var num_hab;

function reserva(data, id) {
    num_hab = id;
    $.ajax({
        url: 'readByRoom',
        dataType: "json",
        type: "POST",
        data: ({
            "columnDBSearch": "hab_numero",
            "value": id
        }),
        success: function (success) {
            console.log(data);
            
            switch (data) {
                case 1:
                    monto = success.data[0].th_valor_hora;
                    $("#invoices").addClass('active');
                    $("#content-card").hide()
                    $("#reception").hide()
                    sumar();
                    break;
                case 2:
                    monto = success.data[0].th_valor_hora;
                    $("#reserva").addClass('active');
                    $(".input-form-reserva").hide()
                    $("#content-card").hide();
                    $("#reception").hide();
                    verReserva(id)
                    break;
                case 5:
                    monto = success.data[0].th_valor_hora;
                    $("#reserva").addClass('active');
                    $(".input-form-reserva").hide()
                    $("#content-card").hide();
                    $("#reception").hide();
                    verReserva(id)
                    break;
                case 6:
                        cambiarEstadoReserva(num_hab);
                default:
                    break;
            }

        },
        error: function (err) {

        }
    });


}
//cambiar estado de la reserva
function cambiarEstadoReserva(habitacion){
    if(confirm("¿Cambiar estado a disponible?")){
        $.ajax({
            url: 'cambiarEstadoReservaLimpieza',
            dataType: "json",
            type: "POST",
            data: (
                {
                    "habitacion": habitacion
                }
            ),
            success: function(success) {
                location.reload();
            },
            error: function (err) {
                alert("error", err)
            }
        })
    }
}
function sumar() {
    $("#total").empty();
    canti = canti * multi;
    monto = parseInt(monto) + parseInt(canti)
    $("#total").append(monto);

}
function addArray(id, idProd, name, value) {
    $("#cant-products-table > tbody").empty();
    $("#" + id).hide();
    products.push({ 'id': idProd, 'name': name });
    console.log(products);
    canti = value;
    for (let i = 0; i < products.length; i++) {
        const element = products[i];
        $("#cant-products-table > tbody").append(`
            <tr>
              <td>${element.name}</td>
              <td>
                <input class="form-control" type="number" id="${element.id}" value="1">
              </td>
              <td onclick="deleteArray('${id}',${element.id})">X</td>
            </tr>
        `)
    }
    sumar();
}

function deleteArray(idDiv,idProd) {
    $("#"+idDiv).show(); 
    for (let i = 0; i < products.length; i++) {
        if (products[i].id != undefined) {
            if (products[i].id == idProd ) {
                console.log(products[i].id+" Eliminado.");
                console.log(products);
                products.splice(i, 1);
            }
        }
    }
    refrescarVistaProductos();
}

function refrescarVistaProductos(){
    $("#cant-products-table > tbody").empty();
    for (let i = 0; i < products.length; i++) {
        if (products[i].id != undefined) {
            const element = products[i];
            $("#cant-products-table > tbody").append(`
                <tr>
                  <td>${element.name}</td>
                  <td>
                    <input class="form-control" type="number" id="${element.id}" value="1">
                  </td>
                  <td onclick="deleteArray('prod-${element.id}',${element.id})">X</td>
                </tr>
            `)
        }
    }
}

$("#form-invoices").submit(function (e) {
    e.preventDefault();
    for (let i = 0; i < products.length; i++) {
        const element = products[i];
        input = $("#" + element.id).val();
        productData.push({ "id": element.id, "cantidad": input })
        var tipoReserva = 2;
        if ($("#courtesy").val() != '') {
            tipoReserva = 5;
        } else if($("#cortesia").val() != 0){
            tipoReserva = 4;
        }
    }
    var data = {
        "hab_numero": num_hab,
        "promocion": $("#courtesy").val(),
        "cortesia": $("#cortesia").val(),
        "tipo_reserva": tipoReserva,
        "numero_personas_adicionales": $("#additional").val(),
        "habitacion_decorada": $("#decorated-room").val(),
        "productos": JSON.stringify(productData)
    }
    $.ajax({
        url: 'CrearReserva',
        dataType: "json",
        type: "POST",
        data: data,
        success: function (success) {
            location.reload()
        },
        error: function (err) {
            $(".alert-danger").addClass('show');
            $(".alert-danger").append(err.responseJSON.message);
            console.log(err);

        }
    })
    closeAlerts();
})

var reservaNumHab;
var reservaTotal;

function verReserva(hab) {
    var data = hab.toString()
    $.ajax({
        url: 'detallesReserva',
        dataType: "json",
        type: "POST",
        data: ({
            "habitacion": data
        }),
        success: function (success) {
            var financiero = success.data.financieros;
            var product = success.data.productos;
            var reserva = success.data.reserva;
            console.log(success);
            reservaNumHab = reserva.hab_numero;
            reservaTotal = financiero.total

            if (success.data.promocion !== null) {
                $("#detail-reserva").append(`
                <div class="col">
                    <p>Promoción:</p>
                    <h6>${success.data.promocion.promo_nombre}</h6>
                </div>
               `);
               $("#courtesy").val(success.data.promocion.id_promocion);
               $(".cortesia-re").hide();

             } else {
                $("#detail-reserva").append(`
                    <div class="col">
                        <p>Cortesia:</p>
                        <h6></h6>
                    </div>
                `)
            }
            $("#total").empty()
            $("#total").append(monto);
            $("#detail-reserva").append(`
                <div class="col">
                    <p>Nro. habitación:</p>
                    <h6>${reserva.hab_numero}</h6>
                </div>
                <div class="col">
                    <p>persona adicional:</p>
                    <h6>${reserva.ra_numero_personas_adicionales}</h6>
                </div>
                <div class="col">
                    <p>Tiempo transcurrido:</p>
                    <h6>${reserva.tiempo_transcurido}</h6>
                </div>
            `)
            for (let i = 0; i < product.length; i++) {
                const element = product[i];
                $("#cant-products-table > tbody").append(`
                    <tr>
                      <td>${element.pro_nombre}</td>
                      <td>
                        <input class="form-control" type="number" id="${element.id}" value="${element.re_det_cantidad}">
                      </td>
                      <td onclick="deleteArray()">X</td>
                    </tr>
                `)

            }
        },
        error: function (err) {

        }
    })
}

 var isform;

$("#edit").click(function name() {
    $("#edit").hide();
    $("#cancel-edit").show()
    $("#detail-reserva").hide();
    $(".input-form-reserva").show();
    isform = false

})
$("#cancel-edit").click(function() {
    $("#edit").show();
    $("#cancel-edit").hide()
    $("#detail-reserva").show();
    $(".input-form-reserva").hide();
    isform = true;
})

$("#type-pay").change(function() {
    if ($("#type-pay").val() == "efectivo") {
        $("#efectivo").show()
        $("#credito").hide()
        $("#transferencia").hide()
    } else if ($("#type-pay").val() == "credito") {
        $("#efectivo").hide()
        $("#credito").show()
        $("#transferencia").hide()
    } else if ($("#type-pay").val() == "transferencia") {
        $("#efectivo").hide()
        $("#credito").hide()
        $("#transferencia").show() 
    } else {
        $("#efectivo").show()
        $("#credito").show()
        $("#transferencia").hide() 
    }
})
$("#form-reserva").submit(function(e) {
    var valueTranferencia = 0;
    var valueCredito = 0
    var valueEfectivo = 0
    e.preventDefault();
    $("#modal-type-pay").modal('show');
    $("#btn-aceptar-metodo").click(function() {
        valueTranferencia = $("#input-transferencia").val()
        valueCredito = $("#input-credito").val()
        valueEfectivo = $("#input-efectivo").val()
        $.ajax({
            url: 'reservaAfactura',
            dataType: "json",
            type: "POST",
            data: (
                {
                    "habitacion": reservaNumHab,
                    "tipo_pago": $("#type-pay").val(),
                    "cantidad_efectivo": valueEfectivo,
                    "cantidad_credito": valueCredito,
                    "cantidad_transferencia": valueTranferencia
                }
            ),
            success: function(success) {
                alert("bieeeenn", success)
            },
            error: function (err) {
                
            }
        })
        
    })

    
})
