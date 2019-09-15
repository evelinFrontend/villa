$(document).ready(function () {
    reloadProvider();
    reloadCategory();
    reloadProduct();
});

$("#form-create-product").submit(function (e) {
    e.preventDefault();
    if ($("#name-product").val() !== '' && $("#value-pay-product").val() !== '' && $("#value-buy-product").val() !== '' && $("#category-product").val()) {
        var file = document.getElementById("img-product").files[0];
        var data = new FormData();
        data.append("imagen", file);
        data.append("codigo", $("#code-product").val());
        data.append("nombre", $("#name-product").val());
        data.append("precio_compra", $("#value-pay-product").val());
        data.append("precio_venta", $("#value-buy-product").val());
        data.append("categoria", $("#category-product").val());
        data.append("proveedor", $("#provider-product").val());
        data.append("cantidad_disponible", $("#cant-product").val());
        $.ajax({
            url: 'createProduct',
            type: 'POST',
            contentType: false,
            data: data,
            processData: false,
            cache: false,
            success: function (success) {
                $('#table-product> tbody>').empty();
                $(".alert-success").addClass("show");
                $(".alert").append(success.message);
                $('#create-product').modal('hide');
                $("#form-create-product").trigger('reset');
                reloadProduct();
            },
            error: function (err) {
                var message = err.responseJSON.message;
                $(".alert-danger").addClass("show");
                $(".alert-danger").append(message);
            }
        });
    } else {
        $(".alert").addClass("show");
        $(".alert").empty();
        $(".alert").append("Todos los campos son obligatorios");
    }
    setTimeout(() => {
        $(".alert").removeClass("show");
        $(".alert").empty();
    }, 4000);
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
                $('#table-category> tbody>').empty();
                $("#alert-scc-category").show();
                $("#alert-scc-category").append('Categoria Creada exitosamente!');
                reloadCategory();
                setTimeout(() => {
                    $("#alert-scc-category").hide();
                }, 3000);
                $("#form-create-category").trigger('reset');
            },
            error: function (err) {
                var message = err.responseJSON.message;
                $(".alert").addClass("show");
                $(".alert").empty();
                $(".alert").append(message);
            }
        });
    } else {
        $(".alert-danger").addClass("show");
        $(".alert").empty();
        $(".alert-danger").append("Todos los campos son requeridos");
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
                $('#table-provider> tbody>').empty();
                $(".alert-success").addClass("show");
                $(".alert").append(success.message);
                $('#create-provider').modal('hide');
                $("#form-create-product").trigger('reset');
                reloadProvider();
            },
            error: function (err) {
                var message = err.responseJSON.message;
                $(".alert-danger").addClass("show");
                $(".alert-danger").append(message);
            }
        });
    } else {
        $(".alert").addClass("show");
        $(".alert").empty();
        $(".alert").append("Todos campos son requeridos");
    }
    setTimeout(() => {
        $(".alert").removeClass("show");
        $(".alert").empty();
    }, 4000);
});


//llenas tabla de productos
function reloadProduct() {
    $.ajax({
        url: 'readByProduct',
        dataType: "json",
        type: "POST",
        data: ({
            "columnDBSearch": 1,
            "value": 1
        }),
        success: function (response) {
            for (var i = 0; i < response.data.length; i++) {
                $('#table-product> tbody:last').append(`
                <tr>
                    <th>${response.data[i].pro_codigo}</th>
                    <td>${response.data[i].pro_nombre}</td>
                    <td>${response.data[i].cat_nombre}</td>
                    <td>${response.data[i].pr_nombre}</td>
                    <td class="d-flex justify-content-around">
                        <p onclick="updateProduct(${response.data[i].id_producto})">ver</p>
                        <img src="views/assets/icons/delete.png" class="icon-list" onclick="deleteData(${response.data[i].id_producto},'deleteProduct')">
                    </td>
                </tr>
                `);
            }
            $('#table-product').DataTable();
        },
        error: function (response) {
            console.log(response);
        },
    });
}
//llenas tabla de categorias
function reloadCategory() {
    $.ajax({
        url: 'readByCategory',
        dataType: "json",
        type: "POST",
        data: ({
            "columnDBSearch": 1,
            "value": 1
        }),
        success: function (response) {
            console.log(response);

            $('#table-category> tbody>').empty();
            for (var i = 0; i < response.data.length; i++) {
                $("#category-product").append(`
                    <option value="${response.data[i].id_categoria}">${response.data[i].cat_nombre}</option>
                `);
                $('#table-category> tbody:last').append(`
                <tr>
                    <th>${response.data[i].id_categoria}</th>
                    <td>${response.data[i].cat_nombre}</td>
                    <td>${response.data[i].cat_descripcion}</td>
                    <td class="d-flex justify-content-around">
                        <img src="views/assets/icons/print.png" class="icon-list">
                        <img src="views/assets/icons/delete.png" class="icon-list" onclick="deleteData(${response.data[i].id_categoria}, 'deleteCategory')">
                    </td>
                </tr>
                `);
            }
            $('#table-category').DataTable();
        },
        error: function (response) {
            console.log(response);
        },
    });
}
//llenas tabla de proveedores
function reloadProvider() {
    $.ajax({
        url: 'readByProvider',
        dataType: "json",
        type: "POST",
        data: ({
            "columnDBSearch": 1,
            "value": 1
        }),
        success: function (response) {
            for (var i = 0; i < response.data.length; i++) {
                $("#provider-product").append(`
                    <option value="${response.data[i].id_proveedor}">${response.data[i].pr_nombre}</option>
                `);
                $('#table-provider> tbody:last').append(`
                <tr>
                    <td>${response.data[i].pr_nombre}</td>
                    <td>${response.data[i].nombre_contacto}</td>
                    <td>${response.data[i].pr_telefono}</td>
                    <td class="d-flex justify-content-around">
                        <img src="views/assets/icons/print.png" class="icon-list">
                        <img src="views/assets/icons/delete.png" class="icon-list" onclick="deleteData(${response.data[i].id_proveedor}, 'deleteProvider')">
                    </td>
                </tr>
                `);
            }
            $('#table-provider').DataTable();
        },
        error: function (response) {
            console.log(response);
        },
    });
}

//delete
function deleteData(value, url) {
    console.log(value, url);
    $.ajax({
        url: url,
        dataType: "json",
        type: "POST",
        data: ({
            "id": value
        }),
        success: function (success) {
            $(".alert-success").addClass("show");
            $(".alert-success").append(success.message);
            $('#table-product> tbody>').empty();
            $('#table-category> tbody>').empty();
            $('#table-provider> tbody>').empty();
            reloadProduct();
            reloadCategory();
            reloadProvider();
        },
        error: function (err) {
            
            var message = err.responseJSON.message;
            console.log(message);
            $(".alert-danger").addClass("show");
            $(".alert-danger").append(message);
        }
    })
    setTimeout(() => {
        $(".alert").removeClass("show");
        $(".alert").empty();
    }, 4000);
}

//update
function updateProduct(id) {
    $('#modal-pr-update').modal('show')
    $.ajax({
        url: 'readByProduct',
        dataType: "json",
        type: "POST",
        data: ({
            "columnDBSearch": 'id_producto',
            "value": id
        }),
        success: function(success) {
            console.log(success);
            var data = success.data
            $(".update-pr-img").append(
            `<img src="${success}">`
            )
           $(".update-pr-detail").append(`
                <h3>${data.pro_nombre}</h3>
                <small>${data.pro_codigo}</small>
                <p>${data}</p>
                <p>${data}</p>
                <p>${data}</p>
           `)
            
        },
        error: function (err) {
            console.log(err);
            
        }
    })
  
    
}


