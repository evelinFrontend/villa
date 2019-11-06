$(document).ready(function () {
    reloadInvoices();
    reloadDatoConfig();
    reloadValue();
});

function closeAlerts() {
    setTimeout(() => {
        $(".alert").removeClass('show')
        $(".alert").empty()
    }, 5000);
}


function reloadDatoConfig() {
    $.ajax({
        url: 'readByConf',
        dataType: "json",
        type: "GET",
        success: function (success) {
            console.log(success);
            
            var values = success.data;
            $("#name").val(values.conf_nombre_empresa)
            $("#resolution").val(values.conf_resolucion),
                $("#business-name").val(values.conf_razon_social),
                $("#nit").val(values.conf_nit),
                $("#adress").val(values.conf_direccion),
                $("#phone").val(values.conf_telefono),
                $("#city").val(values.conf_ciudad),
                $("#config-date-init").val(values.conf_fecha_inicio),
                $("#config-date-finish").val(values.conf_fecha_fin),
                $("#range-init").val(values.conf_rango_inicio),
                $("#range-finish").val(values.conf_rango_fin),
                $("#text").val(values.conf_mensaje);
            // agregar a primir factura
            $("#razonSocialFAC").append(values.conf_razon_social);
            $("#nombreEmpresaFAC").append(values.conf_nombre_empresa);
            $("#nitFAC").append(values.conf_nit);
            $("#numeroTelFac").append(values.conf_telefono);
            $("#ciudadFAC").append(values.conf_ciudad);
            $("#resolucionFAC").append(values.conf_resolucion);
            $("#mensajeFooterFAC").append(values.conf_mensaje);
        },
        error: function (err) {
            console.log(err);

        }
    })
}
function reloadValue() {
    $.ajax({
        url: 'readByConfig',
        dataType: "json",
        type: "GET",
        success: function (success) {
            var data = success.data;
            $("#value-iva").val(data.conf_iva);
            $("#min-cort").val(data.conf_minutos_cortesia);
            $("#dec-hab").val(data.conf_precio_decoracion);
            $("#minutosCobrar").val(data.minutos_contar_hora);

        },
        error: function (err) {

        }
    })
}

$("#select-option").change(function (e) {
    const value = $(this).val();
    if (value === "range") {
        $('.range').show();
        $(".number").hide()
    } else {
        $(".number").show()
        $('.range').hide();
    }
});

$("#form-search-invoice").submit(function (e) {
    e.preventDefault();
    data = [];
    const value = $("#select-option").val();
    if (value == "range") {
        data.push({
            "fechaInicial": $("#date-init").val() + " 00:00:00",
            "fechaFinal": $("#date-finish").val() + " 23:59:59"
        })
    } else if (value == "fac_consecutivo") {
        data.push({ "fac_consecutivo": $("#number-invoice").val() });
    } else {
        data.push({ "id_reserva": $("#number-invoice").val() });
    }

    $.ajax({
        url: "readByInvoice",
        type: 'POST',
        dataType: 'json',
        data: (data[0]),
        success: function (response) {
            console.log(response);
            $('#table-search-invoices> tbody>').empty();
            for (var i = 0; i < response.data.length; i++) {
                $('#table-search-invoices > tbody:last').append(`
                <tr>
                    <td>${response.data[i].fac_consecutivo}</td>
                    <td>${response.data[i].fac_hora_salida}</td>
                    <td>${response.data[i].valor_factura}</td>
                    <td>${response.data[i].tipo_pago}</td>
                    <td class="d-flex justify-content-around">
                        <img src="views/assets/icons/print.png" class="icon-list" onclick="printInvoices(${response.data[i].fac_consecutivo})">
                    </td>
                </tr>
                `);
            }
            $('#table-search-invoices').DataTable();
        },
        error: function (response) {
            alert(response.responseJSON.message);
        }
    });
});


$("#config-invoce").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: 'UptadeConf',
        dataType: "json",
        type: "POST",
        data: ({
            "resolucion": $("#resolution").val(),
            "razon_social": $("#business-name").val(),
            "nombre_empresa": $("#name").val(),
            "nit": $("#nit").val(),
            "direccion": $("#adress").val(),
            "telefono": $("#phone").val(),
            "ciudad": $("#city").val(),
            "fecha_inicio": $("#config-date-init").val(),
            "fecha_fin": $("#config-date-finish").val(),
            "rango_inicio": $("#range-init").val(),
            "rango_fin": $("#range-finish").val(),
            "pie_mensaje": $("#text").val()
        }),
        success: function (success) {
            $(".alert-success").addClass("show");
            $(".alert-success").append(success.message);
        },
        error: function (err) {
            $(".alert-danger").addClass("show");
            $(".alert-danger").append(err.responseJSON.message);
        }
    })
    closeAlerts()
})

$("#update-config").submit(function (e) {
    e.preventDefault()
    if ($("#min-cort").val() < 59) {
        $.ajax({
            url: 'UptadeConfig',
            dataType: "json",
            type: "POST",
            data: ({
                "iva": $("#value-iva").val(),
                "minutos_cortesia": $("#min-cort").val(),
                "precio_decoracion": $("#dec-hab").val(),
                "minutos_contar_hora": $("#minutosCobrar").val()
            }),
            success: function (success) {
                $("#modal-iva").modal("hide");
                $(".alert-success").addClass("show");
                $(".alert-success").append(success.message);
                reloadValue();
    
            },
            error: function (err) {
                $(".alert-danger").addClass("show");
                $(".alert-danger").append(err.responseJSON.message);
            }
        });    
    } else {
        $(".alert-danger").addClass("show");
        $(".alert-danger").append("El tiempo de cortesia no debe ser mayor a 59 minutos");

    }
    closeAlerts()

})

function reloadInvoices() {
    $.ajax({
        url: 'readByInvoice',
        dataType: "json",
        type: "POST",
        success: function (response) {
            console.log(response);
            $('#table-search-invoices> tbody>').empty();
            for (var i = 0; i < response.data.length; i++) {
                var valorFactura = new Intl.NumberFormat().format(response.data[i].valor_factura);
                $('#table-search-invoices > tbody:last').append(`
                <tr>
                    <td>${response.data[i].fac_consecutivo}</td>
                    <td>${response.data[i].fac_hora_salida}</td>
                    <td>${valorFactura}</td>
                    <td>${response.data[i].tipo_pago}</td>
                    <td class="d-flex justify-content-around">
                        <img src="views/assets/icons/print.png" class="icon-list" onclick="printInvoices(${response.data[i].fac_consecutivo})">
                        <img src="views/assets/icons/edit.png" class="icon-list" onclick="editMethosPay(${response.data[i].fac_consecutivo})">
                    </td>
                </tr>
                `);
            }
            $('#table-search-invoices').DataTable();
        },
        error: function (response) {
            console.log(response);
        },
    });
}
var habitacionSeleccionada;
function editMethosPay(factura){
    habitacionSeleccionada = factura;
    $.ajax({
        url: 'obtenerDetallesFactura',
        dataType: "json",
        type: "POST",
        data: ({
            "consecutivo": factura
        }),
        success: function(success) {
            console.log(success);
            $("#btn-aceptar-metodo")[0].textContent="Cambiar Metodo de pago";
            $("#modalTotal").html(success.data[0].valor_factura);
            $("#opcionMixtoPay").hide();
            $("#restar").hide();
            $("#modal-type-pay").modal('show');
            
            $("#input-efectivo").val(success.data[0].valor_factura);
            $("#input-credito").val(success.data[0].valor_factura);
            $("#input-transferencia").val(success.data[0].valor_factura);
            if(success.data[0].tipo_pago=="efectivo"){
                $("#type-pay").val("efectivo");
                $("#type-pay").change();
            }else if(success.data[0].tipo_pago=="credito"){
                $("#type-pay").val("credito");
                $("#type-pay").change();
            }else if(success.data[0].tipo_pago=="transferencia"){
                $("#type-pay").val("transferencia");
                $("#type-pay").change();
            }else{
                alert("Este es un pago mixto, no puede ser editado.");
            }
        },
        error: function (err) {
            console.log(err);
            
        }
    })

}
$("#btn-aceptar-metodo").click(function() {
    var valueTranferencia,valueCredito,valueEfectivo;
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
        url: 'cambiarMetodoPago',
        dataType: "json",
        type: "POST",
        data: (
            {
                "habitacion": habitacionSeleccionada,
                "tipo_pago": $("#type-pay").val(),
                "cantidad_efectivo": valueEfectivo,
                "cantidad_credito": valueCredito,
                "cantidad_transferencia": valueTranferencia
            }
        ),
        success: function (success) {
            alert("Modificación Exitosa");
            location.reload();
        },
        error:function(err){
            console.log("Ha ocurrido un error.");
            location.reload();
        }
    });
    
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

    }
})
function currecy(id) {
    value = $('#'+id).val();
    var total = new Intl.NumberFormat().format(value);
    console.log(total);
    $('.'+id).empty()
    $('.'+id).append(total)
    
}

$("#dec-hab").keyup(function() {
    var value = $(this).val();
    var total = new Intl.NumberFormat().format(value);
    $("#value-hab-dec").empty()
    $("#value-hab-dec").append(total)
    console.log(total);
    
})

function printInvoices(data) {
    $.ajax({
        url: 'obtenerDetallesFactura',
        dataType: "json",
        type: "POST",
        data: ({
            "consecutivo": data
        }),
        success: function(success) {
            console.log(success);
            var data = success.data[0];
            $("#numeroFacturaFAC").append(data.fac_consecutivo);
            $("#habitacionNumFAC").append(data.hab_numero);
            $("#horaEntradaFAC").append(data.fac_fecha_hora_ingreso);
            $("#horaSalidaFAC").append(data.fac_hora_salida);
            $("#descTiempoFAC").append(data.tiempo_total);
            $("#valorTiempoFAC").append(data.totalSoloTiempo);
            $("#valorTotalFAC").append(data.valor_factura);
            $("#valorProductosTotalFAC").append(data.totalSoloProductos);
            $("#valorIvaFAC").append(data.iva);
            $("#subtotalFAC").append(data.subtotal);
            var array = data.productos;
            for (let i = 0; i < array.length; i++) {
                const element = array[i];
                $("#tableProductsFAC> tbody").append(`
                <tr>
                    <th>${element.pro_nombre}</th>
                    <th>${element.det_cantidad}</th>
                    <th>${element.det_valor_total}</th>
                </tr>
                `);                
            }
            $("#content-print").addClass("show");
            $(".data-invoces").addClass("show")
            window.print();
            location.reload();
        },
        error: function (err) {
            console.log(err);
            
        }
    })


}

