$(".reporte").click(function (e) {
    console.log(e.currentTarget.id);
    var type = e.currentTarget.id;
    if (type === "formasPago") {
        $("#icon-back").addClass("show")
        $(".pago").addClass("show");
        $(".ganancia").hide();
        $(".items-repor").hide();
        $(".search-reporte").hide();
    } else if (type === "GananciaXproducto" || type === "ProducXhabitacion") {
        $("#icon-back").addClass("show")
        $(".ganancia").addClass("show");
        $(".pago").hide();
        $(".search-reporte").hide();
        $(".items-repor").hide();
    } else if (type === "reporteVenta" || type === "reporteHabitacion" || type === "reporInvetario" || type === "ReporMovimiento" || type === "productVendidos") {
        $("#icon-back").addClass("show")
        $(".search-reporte").addClass("show");
        $(".ganancia").hide();
        $(".pago").hide();
        $(".items-repor").hide();
    }
});
// $("#icon-back").click(function () {
//     $(".items-repor").addClass("show");
//     $("#icon-back").hide();
//     $(".ganancia").hide();
//     $(".pago").hide();
//     $(".search-reporte").hide();
// })

