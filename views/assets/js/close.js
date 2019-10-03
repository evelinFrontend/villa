$("#content-close").ready(function() {
    $.ajax({
        url: 'UptadeTurn',
        dataType: "json",
        type: "GET",
        success: function(success) {
            console.log(success);
            $("#facEnd").append(success.data.facturaFin);
            $("#facInit").append(success.data.facturaInicio);
            $("#facnum").append(success.data.totalFacturasRealizadas);
            $("#cierre-input").val(success.data.totalVentasTurno);  
        },
        error: function (err) {
            
        }
    })
})

$("#cierre").click(function () {
    location.href = 'login'
})