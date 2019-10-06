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
            $("#valorAbriCaja").append(success.data.abrioCajaCon);  
            $("#cierre-input").val(success.data.totalVentasTurno);  
            $("#caja-input").val(success.data.valorCaja);  
        },
        error: function (err) {
            
        }
    })
})

$("#cierre").click(function () {
    location.href = 'login'
})