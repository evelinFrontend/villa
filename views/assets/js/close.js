var fechaInicio;
var fechaFin;
var totalFacturas;
var valorInicio;
var totalVentas;
var valorCaja;
var cantidadCortesias;
var ValorTotalCortesias;
var cantidaFacturasAnuladas;
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
            cantidadCortesias = success.data.cortesiasRealizadas;
            ValorTotalCortesias = success.data.valorCortesias;
            cantidaFacturasAnuladas = success.data.cantidaFacturasAnuladas;

            $("#facEnd").append(fechaFin);
            $("#facInit").append(fechaInicio);
            $("#facnum").append(totalFacturas);
            $("#valorAbriCaja").append(valorInicio);  
            $("#cantidadCortesias").append(cantidadCortesias);  
            $("#ValorTotalCortesias").append(ValorTotalCortesias); 
            $("#cantidaFacturasAnuladas").append(cantidaFacturasAnuladas);  
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
    $("#p-valor-fac-number").append(totalVentas);
    $("#p-value-init").append(valorInicio);
    $("#p-value-end").append(valorCaja);
    $("#p-cor-number").append(cantidadCortesias);
    $("#p-valor-cor-number").append(ValorTotalCortesias);
    $("#p-anulada-number").append(cantidaFacturasAnuladas);
    $("#printClose").modal('hide');
    $("#content-print").addClass("show");
    window.print();
    location.reload();
    
})

$("#cierreDeDia").click(function() {
    let date = new Date();
    // alert(`${date.getFullYear()}-${date.getMonth()+1}-${date.getDate()}`);
    $.ajax({
        url:"guardarFechas",
        type:"POST",
        dataType:"json",
        data:({
            fecha_inicio: `${date.getFullYear()}-${date.getMonth()+1}-${date.getDate()}`,
            fecha_final :`${date.getFullYear()}-${date.getMonth()+1}-${date.getDate()}`
        }),
        success:function(response){
            console.log(response);
            fetch('reporteVentas')
             .then(resp => resp.blob())
             .then(blob => {
                 const url = window.URL.createObjectURL(blob);
                 const a = document.createElement('a');
                 a.style.display = 'none';
                 a.href = url;
                 // the filename you want
                 a.download = 'reporte de ventas'+`${date.getDate()}/${date.getMonth()+1}/${date.getFullYear()}`+'.xls';
                 document.body.appendChild(a);
                 a.click();
                 window.URL.revokeObjectURL(url);
                 // alert('your file has downloaded!'); 
             })
             .catch(() => alert('oh no!'));
        },
        error:function(response){
            console.log(response);
            alert(response.responseJSON.message);
        },
    });
});