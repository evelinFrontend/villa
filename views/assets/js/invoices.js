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
            var values = success.data
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
                $("#text").val(values.conf_mensaje)

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
        success: function(success) {
            console.log(success);
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
    if (value =="range") {
        data.push({
            "fechaInicial": $("#date-init").val()+" 00:00:00",
            "fechaFinal": $("#date-finish").val()+" 23:59:59"
        })
    }else if(value =="fac_consecutivo"){
        data.push({ "fac_consecutivo": $("#number-invoice").val() });
    }else{
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
                        <img src="views/assets/icons/edit.png" class="icon-list" onclick="viewMove(${response.data[i].fac_consecutivo})">
                    </td>
                </tr>
                `);
            }
            $('#table-search-invoices').DataTable();
        },
        error: function (response){
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

$("#update-config").submit(function(e) {
    e.preventDefault()
    $.ajax({
        url: 'UptadeConfig',
        dataType: "json",
        type: "POST",
        data: ({
            "iva": $("#value-iva").val(),
            "minutos_cortesia": $("#min-cort").val(),
            "precio_decoracion" : $("#dec-hab").val(),
            "minutos_contar_hora" : $("#minutosCobrar").val()
        }),
        success: function(success) {
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
                $('#table-search-invoices > tbody:last').append(`
                <tr>
                    <td>${response.data[i].fac_consecutivo}</td>
                    <td>${response.data[i].fac_hora_salida}</td>
                    <td>${response.data[i].valor_factura}</td>
                    <td>${response.data[i].tipo_pago}</td>
                    <td class="d-flex justify-content-around">
                        <img src="views/assets/icons/edit.png" class="icon-list" onclick="viewMove(${response.data[i].fac_consecutivo})">
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