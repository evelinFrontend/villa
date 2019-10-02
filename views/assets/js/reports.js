var tipoReporte;
$(".reporte").click(function (e) {
    console.log(e.currentTarget.id);
    var type = e.currentTarget.id;
    if (type === "formasPago") {
        tipoReporte = "formasPago";
        $("#icon-back").addClass("show")
        $(".search-reporte").addClass("show");
        $(".ganancia").hide();
        $(".pago").hide();
        $(".items-repor").hide();
    } else if (type === "GananciaXproducto") {
        tipoReporte = "GananciaXproducto";
        $("#icon-back").addClass("show")
        $(".ganancia").addClass("show");
        $(".pago").hide();
        $(".search-reporte").hide();
        $(".items-repor").hide();
    } else if (type === "reporteVenta" ) {
        tipoReporte = "reporteVenta";
        $("#icon-back").addClass("show")
        $(".search-reporte").addClass("show");
        $(".ganancia").hide();
        $(".pago").hide();
        $(".items-repor").hide();
    }else if(type === "reporteHabitacion"){
        tipoReporte = "reporteHabitacion";
        $("#icon-back").addClass("show")
        $(".search-reporte").addClass("show");
        $(".ganancia").hide();
        $(".pago").hide();
        $(".items-repor").hide();
    }else if(type === "reporInvetario"){
        fetch('reporteInventario')
         .then(resp => resp.blob())
         .then(blob => {
             const url = window.URL.createObjectURL(blob);
             const a = document.createElement('a');
             a.style.display = 'none';
             a.href = url;
             // the filename you want
             a.download = 'Inventario Actual.xls';
             document.body.appendChild(a);
             a.click();
             window.URL.revokeObjectURL(url);
             // alert('your file has downloaded!'); 
         })
         .catch(() => alert('oh no!'));

    }else if(type === "ReporMovimiento"){
        tipoReporte = "ReporMovimiento";
        $("#icon-back").addClass("show")
        $(".search-reporte").addClass("show");
        $(".ganancia").hide();
        $(".pago").hide();
        $(".items-repor").hide();
    }else if(type === "productVendidos"){
        tipoReporte = "productVendidos";
        $("#icon-back").addClass("show")
        $(".search-reporte").addClass("show");
        $(".ganancia").hide();
        $(".pago").hide();
        $(".items-repor").hide();
    }
});
$("#icon-back").click(function () {
    // $(".items-repor").addClass("show");
    // $("#icon-back").hide();
    // $(".ganancia").hide();
    // $(".pago").hide();
    // $(".search-reporte").hide();
    location.reload();
})

$("#form-search").submit(function (e) {
    e.preventDefault();
    if (tipoReporte === "formasPago") {
        if($("#fecha_inicio").val()!="" || $("#fecha_final").val()!=""){
            $.ajax({
               url:"guardarFechas",
               type:"POST",
               dataType:"json",
               data:({
                   fecha_inicio:$("#init-date").val(),
                   fecha_final :$("#fin-date").val()
               }),
               success:function(response){
                   console.log(response);
                   fetch('reporteFormarDePago')
                    .then(resp => resp.blob())
                    .then(blob => {
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.style.display = 'none';
                        a.href = url;
                        // the filename you want
                        a.download = 'Formas de pago'+$("#init-date").val()+'-'+$("#fin-date").val()+'.xls';
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
        }else{
            alert("Ingresa las fechas para el reporte.");
        }
    } else if (tipoReporte === "GananciaXproducto") {
    } else if (tipoReporte === "reporteVenta" ) {
        if($("#fecha_inicio").val()!="" || $("#fecha_final").val()!=""){
            $.ajax({
               url:"guardarFechas",
               type:"POST",
               dataType:"json",
               data:({
                   fecha_inicio:$("#init-date").val(),
                   fecha_final :$("#fin-date").val()
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
                        a.download = 'reporte de ventas'+$("#init-date").val()+'-'+$("#fin-date").val()+'.xls';
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
        }else{
            alert("Ingresa las fechas para el reporte.");
        }
    }else if(tipoReporte === "reporteHabitacion"){
        $.ajax({
            url:"guardarFechas",
            type:"POST",
            dataType:"json",
            data:({
                fecha_inicio:$("#init-date").val(),
                fecha_final :$("#fin-date").val()
            }),
            success:function(response){
                console.log(response);
                fetch('reporteHabitaciones')
                 .then(resp => resp.blob())
                 .then(blob => {
                     const url = window.URL.createObjectURL(blob);
                     const a = document.createElement('a');
                     a.style.display = 'none';
                     a.href = url;
                     // the filename you want
                     a.download = 'reporte de habitaciones'+$("#init-date").val()+'-'+$("#fin-date").val()+'.xls';
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
    }else if(tipoReporte === "reporInvetario"){
    }else if(tipoReporte === "ReporMovimiento"){
    }else if(tipoReporte === "productVendidos"){
    }
    console.log(tipoReporte);
});