$(document).ready(function () {
    $('#table-search-invoices').DataTable();
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
    } else if (value === "number") {
        $(".number").show()
        $('.range').hide();
    }
});

$("#form-search-invoice").submit(function (e) {
    e.preventDefault();
    data = [];
    const value = $("#select-option").val();
    if (value === "range") {
        data.push({
            "init": $("#date-init").val(),
            "finish": $("#date-finish").val()
        })
    } else if (value === "number") {
        data.push({ "number": $("#number-invoice").val() })
    }
    console.log(data);

    $.ajax({
        url: actionurl,
        type: 'POST',
        dataType: 'json',
        data: ({}),
        success: function (response) {

        },
        error: {

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
            "precio_decoracion" : $("#dec-hab").val()
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

