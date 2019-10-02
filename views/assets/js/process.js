$("#deleteInvoices").submit(function(e){
    e.preventDefault();
    if($("#date-init").val()!="" || $("#date-fin").val()!=""){
        
        $.ajax({
            url:"iniciarProceso",
            type:"post",
            dataType:"json",
            data:({
                "fecha_inicio":$("#date-init").val(),
                "fecha_fin":$("#date-fin").val()
            }),
            success:function(response){
                $("#confirmProcess").show();
                $("#valorTotal").val(response.valorTotal);
                console.log(response);
                $('#table-process> tbody>').empty();
                for (var i = 0; i < response.data.length; i++) {
                    $('#table-process > tbody:last').append(`
                    <tr>
                        <td>${response.data[i].fac_consecutivo}</td>
                        <td>${response.data[i].fac_hora_salida}</td>
                        <td>${response.data[i].valor_factura}</td>
                        <td>${response.data[i].tipo_pago}</td>
                    </tr>
                    `);
                }
                $('#table-process').DataTable();
            },
            error:function(response){
                console.log(response);
                alert(response.responseJSON.message);
            }
        });
    }else{
        alert("Ingresa Una fecha válida.");
    }
});
$("#confirmProcess").submit(function(e){
    e.preventDefault();
    if($("#porcentaje").val()>0){
        if(confirm("Seguro que deseas iniciar el proceso?"))
        $.ajax({
            url:"confirmarProceso",
            type:"post",
            dataType:"json",
            data:({
                "fecha_inicio":$("#date-init").val(),
                "fecha_fin":$("#date-fin").val(),
                "porcentaje":$("#porcentaje").val()
            }),
            beforeSend: function() {
                $("#confirmProcess").append("<h3>Procesando...</h3>");
            },
            success:function(response){
                console.log(response);
                // $("#confirmProcess").show();
                // $("#valorTotal").val(response.valorTotal);
                // $('#table-process> tbody>').empty();
                // for (var i = 0; i < response.data.length; i++) {
                //     $('#table-process > tbody:last').append(`
                //     <tr>
                //         <td>${response.data[i].fac_consecutivo}</td>
                //         <td>${response.data[i].fac_hora_salida}</td>
                //         <td>${response.data[i].valor_factura}</td>
                //         <td>${response.data[i].tipo_pago}</td>
                //     </tr>
                //     `);
                // }
                // $('#table-process').DataTable();
            },
            error:function(response){
                console.log(response);
                alert(response.responseJSON.message);
            }
        });
    }else{
        alert("Ingresa un porcentaje válido.");
    }
});

// $.ajax({
//     url:"confirmarRealizarProceso",
//     dataType:"json",
//     data:({porcentaje:porcentaje,fecha1: $("#fechaDesde").val(),fecha2:$("#fechaDesde").val()}),
//     type:"post",
//     beforeSend: function() {
//          notify("Procesando...","info");
//     },
//     success:function(response){
//         console.log(response);
//         location.reload();
//     },
//     error:function(response){
//         console.log(response);
//     }
// });