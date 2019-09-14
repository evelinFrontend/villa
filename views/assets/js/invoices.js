$(document).ready(function () {
    $('#table-search-invoices').DataTable();
    $.ajax({
        url: 'readByConf',
        dataType: "json",
        type: "GET",
        success: function (success) {
            var values = success.data
            console.log(values);
            $("#prefix").val(),
                $("#resolution").val(values.conf_resolucion),
                $("#business-name").val(),
                //nombre de la empresa?
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
});
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
            "id": $("#prefix").val(),
            "resolucion": $("#resolution").val(),
            "razon_social": $("#business-name").val(),
            "nombre_empresa": "INVESTMENTS GROUP S.A.S",
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
            console.log(success);
            $(".alert-success").addClass("show");
            $(".alert-success").append(success.message);
        },
        error: function (err) {
            $(".alert-danger").addClass("show");
            $(".alert-danger").append(err.responseJSON.message);
        }
    })
    setTimeout(() => {
        $(".alert").removeClass("show");
        $(".alert").empty();
    }, 5000);
})

