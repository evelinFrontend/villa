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
        $.ajax({
            url:"previewProcess",
            type:"post",
            dataType:"json",
            data:({
                "fecha_inicio":$("#date-init").val(),
                "fecha_fin":$("#date-fin").val(),
                "porcentaje":$("#porcentaje").val()
            }),
            beforeSend: function() {
                $('.infoProgressProcess').remove();
                $("#confirmProcess").append("<h3 class='infoProgressProcess'>Procesando...</h3>");
            },
            success:function(response){
                console.log(response);
                $(".infoProgressProcess").empty();
                $(".infoProgressProcess").html("Proceso Realizado Correctamente.<br>");
                $("#infoProcessPreview").append(`<b> Porcentaje Ingresado:</b> ${$("#porcentaje").val()}, <b>Valor Eliminado:</b> ${response.valorEliminado},<b>Valor que se debia Eliminar:</b> ${response.valorQueSeDebeEliminar}`);
                
                $('#previewFacturasEliminasdas> tbody>').empty();
                for (var i = 0; i < response.facturasEliminadas.length; i++) {
                    $('#previewFacturasEliminasdas > tbody:last').append(`
                    <tr>
                        <td>${response.facturasEliminadas[i].consecutivo}</td>
                        <td>${response.facturasEliminadas[i].fecha}</td>
                        <td>${response.facturasEliminadas[i].valor}</td>
                        <td>${response.facturasEliminadas[i].tipoPago}</td>
                    </tr>
                    `);
                }
                
                $('#previewFacturasReorganizadas> tbody>').empty();
                for (var i = 0; i < response.facurasRestantesMostrar.length; i++) {
                    $('#previewFacturasReorganizadas > tbody:last').append(`
                    <tr>
                        <td>${response.facurasRestantesMostrar[i].fac_consecutivo}</td>
                        <td>${response.facurasRestantesMostrar[i].fac_hora_salida}</td>
                        <td>${response.facurasRestantesMostrar[i].valor_factura}</td>
                        <td>${response.facurasRestantesMostrar[i].tipo_pago}</td>
                    </tr>
                    `);
                }
                $("#modal-preview-proceso").modal('show');
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

$("#RealizarProcesoConfirmado").click(function(e){
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
                $(".infoProgressProcess").remove();
                $("#confirmProcess").append("<h3 class='infoProgressProcess'>Procesando...</h3>");
            },
            success:function(response){
                console.log(response);
                $(".infoProgressProcess").empty();
                $(".infoProgressProcess").html("Proceso Realizado Correctamente.<br>");
                // $(".infoProgressProcess").append(`<p></p>`);
                $(".infoProgressProcess").append(`<br><small>Valor Eliminado: ${response.valorEliminado} </small><br>`);
                $(".infoProgressProcess").append(`<br><small>Valor que se debia Eliminar: ${response.valorQueSeDebeEliminar}</small><br>`);
                $(".infoProgressProcess").append(`<br><small> Porcentaje Ingresado: ${$("#porcentaje").val()}</small><br>`);
                $('#table-process> tbody>').empty();
                $("#modal-preview-proceso").modal('hide');
                $("#realizarProceso").attr("disabled",true);
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
$("#RealizarProcesoConfirmadoCancelar").click(function(){
    $("#modal-preview-proceso").modal('hide');
});
$("#validarConsecutivos").click(function(){
    $("#modal-validar-consecutivos").modal('show');
});
$("#reorganizarConsecutivosDiaCancelar").click(function(){
    $("#modal-validar-consecutivos").modal('hide');
});

$("#reorganizarConsecutivosDia").click(function(){
    var fecha = $("#date-reorganice").val();
    if(fecha!=""){
        $.ajax({
            url:"reorganizarIndices",
            type:"post",
            dataType:"json",
            data:({
                "fecha":fecha
            }),
            success:function(response){
                alert("Se han reorganizado los consecutivos: "+response);
                console.log(response);
                location.reload();
                // alert(response.message);
            },
            error:function(response){
                console.log(response);
                location.reload();
                // alert(response.responseJSON.message);
            }
        });    
    }else{
        alert("Por Favor ingresa una fecha.");
    }
});