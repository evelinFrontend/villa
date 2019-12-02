$("#reception").ready(function () {
    $("#content-additional").hide();
    $("#content-additional-re").hide();
    // $('#modal-content-products-re').DataTable();
    getTurno();
    getRooms()
    getProducts();
    getPromo();
    HabitacionSelect();
    getCategory()
    $("#restar").hide();
    setTimeout(refrescar, 100000);
});
function refrescar() {
    location.reload();
}
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
                var data = success.data[i];
                var time;
                if (data.notificarCortesia === true || data.notificarPromocion ===true ) {
                    var isCortesia = '¡'
                    var isCortesia2 = '!'
                } else {
                    var isCortesia = ''
                    var isCortesia2 = ''
                    
                }
                if (data.tiempo_transcurido) {
                    var time = data.tiempo_transcurido
                } else {
                    var time = '';
                }
                if(data.colorPromo){
                    data.sr_color= data.colorPromo;
                }
                $("#content-card").append(`
                <div class="cards room mb-2" onclick="reserva(${data.sr_estado_reserva}, ${data.hab_numero})">
                    <div class="linear-room" style="background:${data.sr_color};"></div>
                    <div class="body-room-card d-flex">
                        <div class="d-flex">
                            <h1 class="card-number" style="color:${data.sr_color};">${isCortesia}${data.hab_numero}${isCortesia2}</h1>
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
        }
    });
}
function getPromo() {
    $.ajax({
        url: 'readByPromo',
        dataType: "json",
        type: "POST",
        data: ({
            "columnDBSearch": "promo_estado",
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
$(".goInvoices").click(function () {
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
    } else {
        $("#content-additional-re").hide()
    }
})
var arrayProducts = [];
var arrayProductsId = [];

$("#select-category").change(function () {
  var value = $("#select-category").val();
  arrayProductsId = arrayProducts.filter(obj => obj.id_categoria === value);
  addProducts(arrayProductsId)
  console.log(value);
  console.log(arrayProductsId);
})
$("#select-category-re").change(function () {
  var value = $("#select-category-re").val();  
  arrayProductsId = arrayProducts.filter(obj => obj.id_categoria === value);
  addProducts(arrayProductsId);
  console.log(value);
  console.log(arrayProductsId);
})
$("#search-product").keyup(function () {
  var data = $("#search-product").val();
  arrayProductsLetter = arrayProducts.filter(obj => obj.pro_nombre.toLowerCase().includes(data));
  addProducts(arrayProductsLetter)
})
$("#search-product-re").keyup(function () {
  var data = $("#search-product-re").val();
  arrayProductsLetter = arrayProducts.filter(obj => obj.pro_nombre.toLowerCase().includes(data));
  addProducts(arrayProductsLetter)
})
function addProducts(array) {
  $("#modal-content-products").empty();
  $("#modal-content-products-re").empty();
  for (let i = 0; i < array.length; i++) {
    const data = array[i];
    $("#modal-content-products").append(`
        <div class="col-6 align-items-center justify-content-between border product-card" id="prod-${data.id_producto}" onclick="addArray(this.id, ${data.id_producto}, '${data.pro_nombre}', ${data.pro_precio_venta},${true},${true},1)">
            <div id="img-product">
                <img src="views/assets/img/products/img_deafult_product.jpg">
            </div>
            <div>
              <h6 class="name text-right">${data.pro_nombre}</h6>
              <p class="text-right">${data.pro_precio_venta}</p>
            </div>
        </div>
    `)
    $("#modal-content-products-re").append(`
        <div class="col-6 align-items-center justify-content-between border product-card" id="prod-re${data.id_producto}" onclick="addArray(this.id, ${data.id_producto}, '${data.pro_nombre}', ${data.pro_precio_venta},${true},${true},1)">
            <div id="img-product">
                <img src="views/assets/img/products/img_deafult_product.jpg">
            </div>
            <div>
              <h6 class="name text-right">${data.pro_nombre}</h6>
              <p class="text-right">${data.pro_precio_venta}</p>
            </div>
        </div>
    `)
  }

}
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
        arrayProducts = success.data;
        for (var i = 0; i < arrayProducts.length; i++) {
            var data = arrayProducts[i];
            $("#modal-content-products").append(`
                    <div class="col-6 align-items-center justify-content-between border product-card" id="prod-${data.id_producto}" onclick="addArray(this.id, ${data.id_producto}, '${data.pro_nombre}', ${data.pro_precio_venta},${true},${true},1)">
                            <div id="img-product">
                                <img src="views/assets/img/products/img_deafult_product.jpg">
                            </div>
                            <div>
                                <h6 class="name text-right">${data.pro_nombre}</h6>
                                <p class="text-right">${data.pro_precio_venta}</p>
                            </div>
                        </div>
                    `)
            $("#modal-content-products-re").append(`
                    <div class="col-6 align-items-center justify-content-between border product-card" id="prod-re-${data.id_producto}" onclick="addArray(this.id, ${data.id_producto}, '${data.pro_nombre}', ${data.pro_precio_venta},${true},${true},1)">
                            <div id="img-product">
                                <img src="views/assets/img/products/img_deafult_product.jpg">
                            </div>
                            <div>
                                <h6 class="name text-right">${data.pro_nombre}</h6>
                                <p class="text-right">${data.pro_precio_venta}</p>
                            </div>
                        </div>
                    `)

        }

        },
        error: function (err) {

        }
    })

}

function getCategory() {
  $.ajax({
    url: 'readByCategory',
    dataType: "json",
    type: "POST",
    data: ({
      "columnDBSearch": 1,
      "value": 1
    }),
    success: function (response) {
      for (var i = 0; i < response.data.length; i++) {
        $("#select-category, #select-category-re").append(`
                    <option value="${response.data[i].id_categoria}">${response.data[i].cat_nombre}</option>
                `);
      }
    },
    error: function (response) {
      console.log(response);
    },
  });
}



// reservar
var products = [];
var productData = [];
var valorTiempo;
var canti = 0;
var multi = 1;
var input = 1
var num_hab;

function reserva(data, id) {
    console.log(data);

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
                    valorTiempo = success.data[0].th_valor_hora1;
                    $("#invoices").addClass('active');
                    $("#content-card").hide()
                    $("#reception").hide()
                    $("#btn-facturar").hide()

                    sumar();
                    break;
                case 2:
                    $("#reserva").addClass('active');
                    $(".input-form-reserva").hide()
                    $("#content-card").hide();
                    $("#reception").hide();
                    $("#btn-cancel-changes").hide();
                    $("#activarPromocion").show();
                    verReserva(id)
                    break;
                case 5:
                    valorTiempo = success.data[0].th_valor_hora;
                    $("#reserva").addClass('active');
                    $(".input-form-reserva").hide()
                    $("#content-card").hide();
                    $("#reception").hide();
                    $("#btn-cancel-changes").hide();
                    $("#btn-update-invoice").hide();
                    $("#activarPromocion").show();
                    $("#activarPromocion").html("Cambiar Promoción");
                    verReserva(id)
                    break;
                case 6:
                    cambiarEstadoReserva(num_hab);
                    break;
                case 3:
                    $("#reserva").addClass('active');
                    $(".input-form-reserva").hide()
                    $("#content-card").hide();
                    $("#reception").hide();
                    $("#btn-cancel-changes").hide();
                    $("#activarPromocion").show();
                    verReserva(id)
                    break;
                case 4:
                    $("#reserva").addClass('active');
                    $(".input-form-reserva").hide()
                    $("#content-card").hide();
                    $("#reception").hide();
                    $("#btn-cancel-changes").hide();
                    $("#activarPromocion").show();
                    verReserva(id);
                    $("#detail-reserva").append(`
                        <div class="col">
                            <small>Cortesia:</small>
                            <h6>Si</h6>
                        </div>
                    `)
                    break;
                default:
                    break;
            }

        },
        error: function (err) {

        }
    });


}
//cambiar estado de la reserva
function cambiarEstadoReserva(habitacion) {
    if (confirm("¿Cambiar estado a disponible?")) {
        $.ajax({
            url: 'cambiarEstadoReservaLimpieza',
            dataType: "json",
            type: "POST",
            data: (
                {
                    "habitacion": habitacion
                }
            ),
            success: function (success) {
                location.reload();
            },
            error: function (err) {
                alert("error", err)
            }
        })
    }
}
function sumar() {
    var valorProducts = 0;
    products.forEach(element => {
        valorProducts += (element.precio * parseInt($("#" + element.idProd).val()))
    });
    $("#total").html(parseInt(valorTiempo) + parseInt(valorProducts));

}
function addArray(id, idProd, name, value, invoice, facturar, cantidad) {
    $("#cant-products-table > tbody").empty();
    $("#" + id).hide();
    products.push({ 'id': idProd, 'name': name, 'precio': value, 'cantidad': cantidad });
    console.log(products);
    if (facturar) {
        $("#btn-facturar").hide();
        $("#btn-update-invoice").show();
        $("#btn-cancel-changes").show();
    } else {
        $("#btn-update-invoice").hide();
    }
    for (let i = 0; i < products.length; i++) {
        const element = products[i];
        if (invoice) {
            var deleteID = "prod-" + element.id;
        } else {
            var deleteID = "prod-re-" + element.id;
        }
        $("#cant-products-table > tbody").append(`
            <tr>
              <td>${element.name}<small>($${element.precio})</small></td>
              <td>
                <input class="form-control inputAddProduct" type="number"  id="cant-prod-add-${element.id}" value="${element.cantidad}" OnKeyUp="showButtons(this)">
              </td>
              <td onclick="deleteArray('${deleteID}',${element.id},${invoice})">X</td>
            </tr>
        `)
    }

    sumar();
}


function deleteArray(idDiv, idProd, invoice) {
    $("#btn-update-invoice").show();
    console.log(idDiv);
    $("#" + idDiv).css("display", "block");
    for (let i = 0; i < products.length; i++) {
        if (products[i].id != undefined) {
            if (products[i].id == idProd) {
                products.splice(i, 1);
            }
        }
    }
    refrescarVistaProductos(invoice);
}

function refrescarVistaProductos(invoice) {
    $("#cant-products-table > tbody").empty();
    for (let i = 0; i < products.length; i++) {
        if (products[i].id != undefined) {
            const element = products[i];
            if (invoice) {
                $("#cant-products-table > tbody").append(`
                    <tr>
                      <td>${element.name}</td>
                      <td>
                        <input class="form-control" type="number" id="${element.id}" value="${element.cantidad}">
                      </td>
                      <td onclick="deleteArray('prod-${element.id}',${element.id},${true})">X</td>
                    </tr>
                `)
            } else {
                $("#cant-products-table > tbody").append(`
                    <tr>
                      <td>${element.name}</td>
                      <td>
                        <input class="form-control" type="number" id="${element.id}" value="${element.cantidad}">
                      </td>
                      <td onclick="deleteArray('prod-re-${element.id}',${element.id},${false})">X</td>
                    </tr>
                `)

            }
        }
    }
}

$("#form-invoices").submit(function (e) {
    e.preventDefault();
    for (let i = 0; i < products.length; i++) {
        const element = products[i];
        input = $("#" + element.id).val();
        productData.push({ "id": element.id, "cantidad": element.cantidad })
    }
    var tipoReserva = 2;
    if ($("#courtesy").val() != '') {
        tipoReserva = 5;
    } else if ($("#cortesia").val() != 0) {
        tipoReserva = 4;
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
});


var reservaNumHab;
var reservaTotal;
var personasAdicionales;
var habitacionDecorada;
var idReserva;
var restante;
var existeCortesia;
function formatAMPM(date) {
  date =  new Date(date);
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var year = date.getFullYear();
  var month = date.getMonth();
  var dia = date.getDate();
  var ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; //the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = year +"-"+month+"-"+dia+" "+hours + ':' + minutes + ' ' + ampm;
  return strTime;
}
function verReserva(hab) {
    //crear una funcion que consulte los datos de la factura ya tengo valor actuañ de la consulta 
    var data = hab.toString()
    $.ajax({
        url: 'detallesReserva',
        dataType: "json",
        type: "POST",
        data: ({
            "habitacion": data
        }),
        success: function (success) {
            console.log(success);
            var financiero = success.data.financieros;
            var product = success.data.productos;
            var reserva = success.data.reserva;
            valorTiempo = success.data.financieros.totalTiempo;
            reservaNumHab = reserva.hab_numero;
            reservaTotal = financiero.total
            idReserva = success.data.reserva.id_reserva;
            consultFacturadata(financiero, product);
            $("#consecutivo").append(success.data.siguienteConsecutivo)
            $("#ra_fecha_hora_ingreso").html(formatAMPM(success.data.reserva.ra_fecha_hora_ingreso))
            if (success.data.reserva.sr_estado_reserva == 3) {
                $("#print-parcial").html("Continuar tiempo parcial");
            } else {
                $("#print-parcial").html("Imprimir tiempo parcial");
            }
            if (parseInt(success.data.financieros.totalTiempo) == 0 && parseInt(success.data.financieros.productos) == 0) {
                $("#btn-anular-reserva").show();
            } else {
                $("#btn-anular-reserva").show();
            }
            if (success.data.reserva.ra_habitacion_decorada === '1') {
                $("#detail-reserva").append(`
                <div class="col">
                    <small>Decoración:</small>
                    <h6>Si</h6>
                </div>
               `);
            }
            $("#TOTAL-INVOICE-SHOW").append(new Intl.NumberFormat().format(success.data.financieros.total));
            if (success.data.promocion !== null) {
                $("#detail-reserva").append(`
                <div class="col">
                    <small>Promoción:</small>
                    <h6>${success.data.promocion.promo_nombre}</h6>
                </div>
               `);
                $("#courtesy").val(success.data.promocion.id_promocion);
                $(".cortesia-re").hide();

            }
            //dar valor al restante en la modal
            restante = financiero.total;
            $("#modalTotal, #totalReserva").append(new Intl.NumberFormat().format(financiero.total));
            $("#detail-reserva").append(`
                <div class="col">
                    <small>Nro. habitación:</small>
                    <h6>${reserva.hab_numero}</h6>
                </div>
                <div class="col">
                    <small>persona adicional:</small>
                    <h6>${reserva.ra_numero_personas_adicionales}</h6>
                </div>
                <div class="col">
                    <small>Tiempo transcurrido:</small>
                    <h6>${reserva.tiempo_transcurido}</h6>
                </div>
            `)
            for (let i = 0; i < product.length; i++) {
                const element = product[i];
                addArray("prod-" + element.re_det_id_producto, element.re_det_id_producto, element.pro_nombre, element.re_det_valor_unidad, true, false, element.re_det_cantidad);
            }
            //VALORES DE DETALLE
            personasAdicionales = reserva.ra_numero_personas_adicionales;
            habitacionDecorada = reserva.ra_habitacion_decorada;
            existeCortesia = reserva.ra_tipo_cortesia;
            // location.reload();
        },
        error: function (err) {
            console.log(err);

        }
    })
}
function consultFacturadata(data, product) {
    //falta datos de la factura
    $("#timetrancurrido").append(data.tiempoTranscurrido);
    $("#horavalor").append(data.valorHora);
    $("#horatrancurrido").append(data.horasCobrar);
    $("#totalTotal").append(data.total);
    for (let i = 0; i < product.length; i++) {
        const element = product[i];
        $("#tableProductsTIME").append(`
            <tr>
                <td>${element.pro_nombre}</td>
                <td>${element.re_det_cantidad}</td>
                <td>${element.re_det_valor_unidad}</td>
            </tr>
       `)

    }


}
var updateInvice = false;
$("#btn-update-invoice").hide();
$("#edit").click(function name() {
    $("#edit").hide();
    $("#cancel-edit").show()
    $("#detail-reserva").hide();
    $(".input-form-reserva").show();
    updateInvice = true;
    $("#btn-update-invoice").show();
    $("#btn-facturar").hide();
    $("#btn-cancel-changes").show();
    if (parseInt(personasAdicionales) > 0) {
        $("#additional-invoice").val(personasAdicionales);
        $("#select-person-re").val("si");
        $("#select-person-re").change();
    }
    if (parseInt(habitacionDecorada) == 1) {
        $("#decorated-room-invoice").val("1");
        $("#decorated-room-invoice").change();
    }
    if(existeCortesia!=null){
        $("#cortesia-update").val(existeCortesia);
        $("#cortesia-update").change();
    }
    $("#decorated-room").val(habitacionDecorada);
})
$("#cancel-edit").click(function () {
    $("#edit").show();
    $("#cancel-edit").hide()
    $("#detail-reserva").show();
    $(".input-form-reserva").hide();
    updateInvice = false;
    $("#btn-update-invoice").hide();
    $("#btn-facturar").show();
    $("#btn-cancel-changes").hide();
})
$("#type-pay").change(function () {
    $("#input-efectivo").attr("disabled",true);
    $("#input-credito").attr("disabled",true);
    $("#input-transferencia").attr("disabled",true);
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
        $("#transferencia").show()
        $("#restar").show()
        $("#restan-value").append(restante)
        $("#input-efectivo").attr("disabled",false);
        $("#input-credito").attr("disabled",false);
        $("#input-transferencia").attr("disabled",false);

    }
})
var restotal;
var resEfectivo;
$("#input-efectivo").keyup(function () {
    $("#restan-value").empty();
    var value = $(this).val();
    resEfectivo = restante - value
    restotal = resEfectivo
    $("#restan-value").append(restotal)
});
var resCredito;
$("#input-credito").keyup(function () {
    $("#restan-value").empty();
    var value = $(this).val();
    restotal = resEfectivo - value;
    resCredito = restotal;
    $("#restan-value").append(restotal)
})
var resTranfer;
$("#input-transferencia").keyup(function () {
    $("#restan-value").empty();
    var value = $(this).val();
    restotal = resCredito - value
    $("#restan-value").append(restotal)
    console.log(resCredito, value);
})

$("#form-reserva").submit(function (e) {
    var valueTranferencia = 0;
    var valueCredito = 0;
    var valueEfectivo = 0;
    e.preventDefault();
    $("#modal-type-pay").modal('show');
    //precargar total
    $("#input-efectivo").val(reservaTotal);
    $("#input-credito").val(reservaTotal);
    $("#input-transferencia").val(reservaTotal);

    $("#input-efectivo").attr("disabled",true);
    $("#input-credito").attr("disabled",true);
    $("#input-transferencia").attr("disabled",true);
    
    $("#btn-aceptar-metodo").click(function () {
        
        if($("#type-pay").val()=="efectivo"){
            valueTranferencia = 0;
            valueCredito = 0;
            valueEfectivo = $("#input-efectivo").val();
        }else if($("#type-pay").val()=="credito"){
            valueTranferencia = 0;
            valueCredito = $("#input-credito").val();
            valueEfectivo = 0;
        }else if($("#type-pay").val()=="transferencia"){
            valueTranferencia = $("#input-transferencia").val();
            valueCredito = 0;
            valueEfectivo = 0;
        }else{
            valueTranferencia = $("#input-transferencia").val();
            valueCredito = $("#input-credito").val();
            valueEfectivo = $("#input-efectivo").val();
        }

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
            success: function (success) {
                $("#modal-printer").modal("show");
                $("#modal-type-pay").modal("hide");
                //datos configuracion factura
                $("#razonSocialFAC").html(success.data.configuracion_factura.conf_razon_social);
                $("#nombreEmpresaFAC").html(success.data.configuracion_factura.conf_nombre_empresa);
                $("#nitFAC").html("NIT " + success.data.configuracion_factura.conf_nit);
                $("#direccionFAC").html(success.data.configuracion_factura.conf_direccion);
                $("#numeroTelFac").html(success.data.configuracion_factura.conf_telefono);
                $("#ciudadFAC").html(success.data.configuracion_factura.conf_ciudad);
                $("#resolucionFAC").html("Resolución: " + success.data.configuracion_factura.conf_resolucion);
                $("#mensajeFooterFAC").html(success.data.configuracion_factura.conf_mensaje);
                //datos  factura
                $("#numeroFacturaFAC").html(success.factura);
                $("#numeroFacturaFAC").html(success.factura);
                $("#habitacionNumFAC").html(success.data.reserva.hab_numero);
                $("#horaEntradaFAC").html(success.data.reserva.ra_fecha_hora_ingreso);
                $("#horaSalidaFAC").html(success.fechaRealizacion);

                ///Detalles servicio
                $("#descTiempoFAC").html("Tiempo: " + success.data.reserva.tiempo_transcurido);
                $("#valorTiempoFAC").html(new Intl.NumberFormat().format(success.data.financieros.totalTiempo));

                //Productos 
                if (success.data.productos.length <= 0) {
                    $("#DescProduct").hide();
                }
                for (var i = 0; i < success.data.productos.length; i++) {
                    var value = new Intl.NumberFormat().format(success.data.productos[i].re_det_valor_total)
                    $('#tableProductsFAC > tbody:last').append(`
                   <tr>
                   <td>${success.data.productos[i].pro_nombre}</td>
                   <td>${success.data.productos[i].re_det_cantidad}</td>
                   <td>${value}</td>
                   </tr>
                   `);
                }
                $("#valorProductosTotalFAC").html(new Intl.NumberFormat().format(success.data.financieros.productos));
                $("#valorBaseIvaFAC").html(new Intl.NumberFormat().format(success.data.financieros.baseIva));
                $("#subtotalFAC").html(new Intl.NumberFormat().format(success.data.financieros.subtotal));
                $("#valorIvaFAC").html(new Intl.NumberFormat().format(success.data.financieros.iva));
                $("#valorTotalFAC").html(new Intl.NumberFormat().format(success.data.financieros.total));
                //hab itacion decora
                if (parseInt(success.data.financieros.decoracion) > 0) {
                    $('#habitacionDecorada').after(`
                    <div class="d-flex justify-content-between">
                    <p>Habitacion Decorada:</p>
                    <p>${new Intl.NumberFormat().format(success.data.financieros.decoracion)}</p>
                    </div>
                    `);
                }
                //FORMAS DE PAGO
                if (parseInt(success.data.financieros.valor_pago_efectivo) > 0) {
                    $('#formasDePagoFAC').after(`
                        <div class="d-flex justify-content-between">
                            <p>Efectivo:</p>
                            <p>${new Intl.NumberFormat().format(success.data.financieros.valor_pago_efectivo)}</p>
                        </div>
                    `);
                }
                if (parseInt(success.data.financieros.valor_pago_credito) > 0) {
                    $('#formasDePagoFAC').after(`
                        <div class="d-flex justify-content-between">
                            <p>Credito:</p>
                            <p>${new Intl.NumberFormat().format(success.data.financieros.valor_pago_credito)}</p>
                        </div>
                    `);
                }
                if (parseInt(success.data.financieros.valor_pago_transferencia) > 0) {
                    $('#formasDePagoFAC').after(`
                        <div class="d-flex justify-content-between">
                            <p>Transferencia:</p>
                            <p>${new Intl.NumberFormat().format(success.data.financieros.valor_pago_transferencia)}</p>
                        </div>
                    `);
                }
                //    $("#").html(response.configuracion_factura.);
                // location.reload();
            },
            error: function (err) {
                $(".a-modal-danger").empty();
                $(".a-modal-danger").addClass("show");
                $(".a-modal-danger").append(err.responseJSON.message);

            }
        })
        closeAlerts()
    })
})

$("#goToReception").click(function () {
    location.reload();
})

$("#btn-print").click(function () {
    $("#content-print").addClass("show");
    $(".data-invoces").addClass("show")
    window.print();
    location.reload();
})
$("#close-print").click(function () {
    $("#content-print").removeClass("show");

})
$("#print-parcial").click(function () {
    $.ajax({
        url: 'cambiarEstadoReserva',
        dataType: "json",
        type: "POST",
        data: ({
            "habitacion": reservaNumHab,
            "estado_reserva": 3
        }),
        success: function (success) {
            console.log(success);
            if ($("#print-parcial").html() != "Continuar tiempo parcial") {
                $("#reservaID").html(success.data.reserva.id_reserva);
                $("#horaEntradaTP").html(success.data.reserva.ra_fecha_hora_ingreso);
                $("#horaSalidaTP").html(success.data.reserva.ra_inicio_tiempo_parcial);
                $("#numhab").html(success.data.reserva.hab_numero);
                $("#timetrancurrido").html(success.data.financieros.tiempoTranscurrido)
                $("#totalTiempoParcial").html(new Intl.NumberFormat().format(success.data.financieros.total))
                $("#valorTiempoParcial").html(new Intl.NumberFormat().format(success.data.financieros.totalTiempo))
                for (var i = 0; i < success.data.productos.length; i++) {
                    var valor = new Intl.NumberFormat().format(success.data.productos[i].re_det_valor_total)
                    $('#tableProductsTIME> tbody:last').append(`
                <tr>
                    <th>${success.data.productos[i].pro_nombre}</th>
                    <td>${success.data.productos[i].re_det_cantidad}</td>
                    <td>${valor}</td>
                </tr>
                `);
                }
                $(".data-time").addClass("show")
                $("#content-print").addClass("show");
                window.print();
            }
            location.reload();
        },
        error: function (err) {
            console.log(err);

        }
    })
})
$("#btn-cancel-changes").click(function () {
    location.reload();
});

//ACTUALIZAR RESERVA
$("#btn-update-invoice").click(function () {
    for (let i = 0; i < products.length; i++) {
        const element = products[i];
        input = $("#" + element.id).val();
        productData.push({ "id": element.id, "cantidad": element.cantidad })
    }
    if (updateInvice) {
        var data = {
            "id_reserva": idReserva,
            "numero_personas_adicionales": $("#additional-invoice").val(),
            "habitacion_decorada": $("#decorated-room-invoice").val(),
            "productos": JSON.stringify(productData),
            "cortesia": $("#cortesia-update").val()
        }
    } else {
        var data = {
            "id_reserva": idReserva,
            "numero_personas_adicionales": personasAdicionales,
            "habitacion_decorada": habitacionDecorada,
            "productos": JSON.stringify(productData),
            "cortesia": "no"
        }
    }
    $.ajax({
        url: 'ModificarReserva',
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
});
function showButtons(element) {
    var idProducto = element.id.replace("cant-prod-add-", "");
    products.forEach((product) => {
        if (product.id == idProducto) {
            product.cantidad = element.value;
        }
    });
    $("#btn-update-invoice").show();
    $("#btn-facturar").hide();
}

$("#btn-anular-reserva").click(function (e) {
    // $("#modal-cancel").modal('show');
    if(confirm("¿Cancelar Reserva?")){
        e.preventDefault();
        $.ajax({
            url: 'cancelarReserva',
            dataType: "json",
            type: "POST",
            data: ({
                "id_reserva": idReserva,
                "motivo": "N/A"
            }),
            success: function (success) {
                location.reload()
    
            },
            error: function (err) {
                console.log(err);
                alert(err.responseJSON.message);
            }
        })
    }
})
$("#btn-cambio-habitacion").click(function () {
    $("#modal-cambio-habitacion").modal('show');
})
// $("#cancelar-reserva").submit(function (e) {
//     e.preventDefault();
//     $.ajax({
//         url: 'cancelarReserva',
//         dataType: "json",
//         type: "POST",
//         data: ({
//             "id_reserva": idReserva,
//             "motivo": $("#motivo").val()
//         }),
//         success: function (success) {
//             location.reload()

//         },
//         error: function (err) {
//             console.log(err);

//         }
//     })
// });
function currecy(id) {
    value = $('#' + id).val();
    var total = new Intl.NumberFormat().format(value);
    console.log(total);
    $('.' + id).empty()
    $('.' + id).append(total)

}

function HabitacionSelect(){
    $.ajax({
        url: 'readByRoom',
        type: 'POST',
        dataType: 'json',
        data: ({
            "columnDBSearch": 1,
            "value": 1
        }),
        success: function (success) {
            var options = success.data;
            $('#nueva-habitacion').empty();
            $.each(options, function (value, item) {
                $("#nueva-habitacion").append($("<option>",{
                    value: item.hab_numero,
                    text: item.hab_numero
                }));
                   
            })
        },
        error: function (err) {
            var message = err.responseJSON.message;
            alert(message);
        }
    });
}

$("#cambiarHabitacionReserva").submit(function(e){
    e.preventDefault();
    if(confirm("Realizar el cambio de habitación?")){
        $.ajax({
            url: 'cambiarHabitacionReserva',
            type: 'POST',
            dataType: 'json',
            data: ({
                "habitacionNueva": $("#nueva-habitacion").val(),
                "habitacionActual": num_hab,
                "reiniciarTiempo": $("#reiniciar-tiempo").val()
            }),
            success: function (success) {
                var options = success.data;
                console.log(success);
                alert(success.message)
                location.reload();
            },
            error: function (err) {
                console.log(err);
                var message = err.responseJSON.message;
                alert(message);
            }
        });
    }
});


$("#activarPromocion").click(function(){
    $("#modal-activar-promocion").modal('show');

    $.ajax({
        url: 'readByPromo',
        type: 'POST',
        dataType: 'json',
        data: ({
            "columnDBSearch": 1,
            "value": 1
        }),
        success: function (success) {
            var options = success.data;
            $('#activarPromoOptions').empty();
            $.each(options, function (value, item) {
                $("#activarPromoOptions").append($("<option>",{
                    value: item.id_promocion,
                    text: item.promo_nombre
                }));
                   
            })
        },
        error: function (err) {
            var message = err.responseJSON.message;
            alert(message);
        }
    });
});

$("#activarPromocionEnReserva").submit(function(e){
    e.preventDefault();
    if(confirm("Realizar la Activación de la promoción?")){
        $.ajax({
            url: 'activarPromocionEnReserva',
            type: 'POST',
            dataType: 'json',
            data: ({
                "habitacion": num_hab,
                "promocion": $("#activarPromoOptions").val()
            }),
            success: function (success) {
                var options = success.data;
                console.log(success);
                alert(success.message)
                location.reload();
            },
            error: function (err) {
                console.log(err);
                var message = err.responseJSON.message;
                alert(message);
            }
        });
    }
});