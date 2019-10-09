var fechaInicio;
var fechaFin;
var totalFacturas;
var valorInicio;
var totalVentas;
var valorCaja;
$("#content-close").ready(function() {
    $.ajax({
        url: 'UptadeTurn',
        dataType: "json",
        type: "GET",
        success: function(success) {
            console.log(success);
            fechaInicio = success.data.facturaInicio;
            fechaFin = success.data.facturaFin;
            totalFacturas = success.data.totalFacturasRealizadas;
            valorInicio = success.data.abrioCajaCon;
            totalVentas = success.data.totalVentasTurno;
            valorCaja = success.data.valorCaja;
            $("#facEnd").append(fechaFin);
            $("#facInit").append(fechaInicio);
            $("#facnum").append(totalFacturas);
            $("#valorAbriCaja").append(valorInicio);  
            $("#cierre-input").val(totalVentas);  
            $("#caja-input").val(valorCaja);  
        },
        error: function (err) {
            
        }
    })
});

$("#cierre").click(function () {
    $("#printClose").modal('show');
});
$("#btn-close").click(function() {
    location.href = 'login'
});
$("#btn-print").click(function() {
    $("#p-data-init").append(fechaInicio);
    $("#p-data-end").append(fechaFin);
    $("#p-fac-number").append(totalFacturas);
    $("#p-value-init").append(valorInicio);
    $("#p-value-end").append(totalVentas);
    $("#printClose").modal('hide');
    $("#content-print").addClass("show");
    window.print();
    location.reload();
    
})