
$("#reception").ready(function () {
    $("#content-additional").hide();
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
                $("#courtesy").append(`
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
$("#select-person").change(function () {
    if ($("#select-person").val() === 'si') {
        $("#content-additional").show()
    } else {
        $("#content-additional").hide()
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
                $("#modal-content-products").append(`
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
    console.log(data, id);
    
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
            switch (data) {
                case 1:
                    monto = success.data[0].th_valor_hora;
                    $("#invoices").addClass('active');
                    $("#content-card").hide()
                    $("#reception").hide()
                    sumar();
                    break;
                case 2:
                    console.log("rntro");
                    
                    monto = success.data[0].th_valor_hora;
                    $("#reserva").addClass('active');
                    $("#content-card").hide();
                    $("#reception").hide();
                    sumar()
                    verReserva(id)

                default:
                    break;
            }

        },
        error: function (err) {

        }
    });


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
    canti = value;
    for (let i = 0; i < products.length; i++) {
        const element = products[i];
        $("#cant-products-table > tbody").append(`
            <tr>
              <td>${element.name}</td>
              <td>
                <input class="form-control" type="number" id="${element.id}" value="1">
              </td>
              <td onclick="deleteArray('${id}',${idProd})">X</td>
            </tr>
        `)
    }
    sumar();
}

function deleteArray(id,idProd) {
    $("#"+id).show(); 
    for (let i = 0; i < products.length; i++) {
        if (products[i].id != undefined) {
            const element = products[i];
            if (element.id == idProd ) {
                delete products[i];
                console.log(products);
                
            }
        }
    }
}

$("#form-invoices").submit(function (e) {
    e.preventDefault();
    for (let i = 0; i < products.length; i++) {
        const element = products[i];
        input = $("#" + element.id).val();
        productData.push({ "id": element.id, "cantidad": input })
        var data = {
            "hab_numero": num_hab,
            "promocion": $("#courtesy").val(),
            "cortesia": $("#cortesia").val(),
            "tipo_reserva": "2",
            "numero_personas_adicionales": $("#additional").val(),
            "habitacion_decorada": $("#decorated-room").val(),
            "productos": JSON.stringify(productData)
        }
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

function verReserva(hab) {
    $("#btn-can-reserva, #btn-facturar").addClass("show");
    $("#btn-reservar").hide()
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

            console.log(product);
            $("#total").empty()
            $("#total").append(monto);
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

