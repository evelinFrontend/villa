$(document).ready(function () {
    $('#table-product').DataTable();
    $('#table-category').DataTable();
    $('#table-provider').DataTable();
});

$("#form-create-product").submit(function (e) {
    e.preventDefault();
    if ($("#name-product").val() !== '' && $("#value-product").val() !== '' && $("#category").val() !== '' && $("#provider").val()) {
        $.ajax({
            url: '',
            type: 'POST',
            dataType: 'json',
            data: ({

            }),
            success: function (success) {
                console.log(success);
                $('#create-product').modal('hide')
            },
            error: function (err) {
                var message = err.responseJSON.message;
                $(".alert").addClass("show");
                $(".alert").empty();
                $(".alert").append(message);
            }
        });
    } else {
        $(".alert").addClass("show");
        $(".alert").empty();
        $(".alert").append("Todos los campos son obligatorios");
    }
})

$("#form-create-category").submit(function (e) {
    e.preventDefault();
    if ($("#name-new-category").val() !== '') {
        $.ajax({
            url: 'createCategory',
            type: 'POST',
            dataType: 'json',
            data: ({
                "nombre": $("#name-new-category").val(),
                "descripcion": $("#description-category").val(),
            }),
            success: function (success) {
                $("#alert-scc-category").show();
                $("#alert-scc-category").append('Categoria Creada exitosamente!');
                setTimeout(() => {
                    $("#alert-scc-category").hide();
                }, 3000);
                $("#form-create-category").trigger('reset')
            },
            error: function (err) {
                var message = err.responseJSON.message;
                $(".alert").addClass("show");
                $(".alert").empty();
                $(".alert").append(message);
            }
        });
    } else {
        $(".alert").addClass("show");
        $(".alert").empty();
        $(".alert").append("Todos los campos son requeridos");
    }
});

$("#form-create-provider").submit(function (e) {
    e.preventDefault();
    if ($("#name-incharge").val() !== '' && $("#name-provider").val() !== '' && $("#nit-provider").val() !== '' && $("#business-name-provider").val() !== '' && $("#address-provider").val() !== '' && $("#doc-employee").val() !== '') {
        $.ajax({
            url: 'createProvider',
            type: 'POST',
            dataType: 'json',
            data: ({
                "nombre_contacto": $("#name-incharge").val(),
                "nombre": $("#name-provider").val(),
                "nit": $("#nit-provider").val(),
                "razon_social": $("#business-name-provider").val(),
                "telefono": $("#business-name-provider").val(),
                "direccion": $("#address-provider").val(),
                "correo": $("#email-provider").val(),
                "numero_cuenta": $("#account-provider").val(),
                "tipo_cuenta": $("#type-account-provider").val(),
                "banco": $("#bank-provider").val(),

            }
            ),
            success: function (success) {
                console.log(success, data);
            },
            error: function (err) {
                var message = err.responseJSON.message;
                $(".alert").addClass("show");
                $(".alert").empty();
                $(".alert").append(message);
            }
        });
    } else {
        $(".alert").addClass("show");
        $(".alert").empty();
        $(".alert").append("Todos campos son requeridos");
    }
});

//llenas tabla de productos
$.ajax({
    url:'readByProduct',
    dataType:"json",
    type:"POST",
    data:({
        "columnDBSearch":1,
        "value": 1
    }),
    success:function(response){
        console.log(response);
        for(var i = 0; i<response.data.length;i++){
            $('#table-product> tbody:last').append(`
            <tr>
                <th>${response.data[i].pro_codigo}</th>
                <td>${response.data[i].pro_nombre}</td>
                <td>${response.data[i].cat_nombre}</td>
                <td>${response.data[i].pr_nombre}</td>
                <td class="d-flex justify-content-around">
                    <img src="views/assets/icons/print.png" class="icon-list">
                    <img src="views/assets/icons/delete.png" class="icon-list">
                </td>
            </tr>
            `);
        }
        $('#table-product').DataTable();
    },
    error:function(response){
        console.log(response);
    },
});
//llenas tabla de categorias
$.ajax({
    url:'readByCategory',
    dataType:"json",
    type:"POST",
    data:({
        "columnDBSearch":1,
        "value": 1
    }),
    success:function(response){
        console.log(response);
        for(var i = 0; i<response.data.length;i++){
            $('#table-category> tbody:last').append(`
            <tr>
                <th>${response.data[i].id_categoria}</th>
                <td>${response.data[i].cat_nombre}</td>
                <td>${response.data[i].cat_descripcion}</td>
                <td class="d-flex justify-content-around">
                    <img src="views/assets/icons/print.png" class="icon-list">
                    <img src="views/assets/icons/delete.png" class="icon-list">
                </td>
            </tr>
            `);
        }
        $('#table-category').DataTable();
    },
    error:function(response){
        console.log(response);
    },
});
//llenas tabla de proveedores
$.ajax({
    url:'readByProvider',
    dataType:"json",
    type:"POST",
    data:({
        "columnDBSearch":1,
        "value": 1
    }),
    success:function(response){
        console.log(response);
        for(var i = 0; i<response.data.length;i++){
            $('#table-provider> tbody:last').append(`
            <tr>
                <td>${response.data[i].pr_nombre}</td>
                <td>${response.data[i].nombre_contacto}</td>
                <td>${response.data[i].pr_telefono}</td>
                <td class="d-flex justify-content-around">
                    <img src="views/assets/icons/print.png" class="icon-list">
                    <img src="views/assets/icons/delete.png" class="icon-list">
                </td>
            </tr>
            `);
        }
        $('#table-provider').DataTable();
    },
    error:function(response){
        console.log(response);
    },
});
