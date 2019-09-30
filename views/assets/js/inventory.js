$(document).ready(function () {
    reloadProvider();
    reloadCategory();
    reloadProduct();
    reloadMoves();
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
    setTimeout(() => {
        $(".alert").removeClass("show");
        $(".alert").empty();
    }, 5000);
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
                "telefono": $("#number-provider").val(),
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

//forms update
$("#form-update-product").submit(function(e) {
    e.preventDefault();
    if ($("#name-product-up").val() !== '' && $("#value-pay-product-up").val() !== '' && $("#value-buy-product-up").val() !== '' && $("#category-product-up").val() !== '' && $("#provider-product-up").val() !== '') {
        var file = document.getElementById("img-product").files[0];
        var data = new FormData();
        data.append("imagen", file);
        data.append("id", $("#id-product-up").val());
        data.append("estado", $("#status-product-up").val());
        data.append("codigo", $("#code-product-up").val());
        data.append("nombre", $("#name-product-up").val());
        data.append("precio_compra", $("#value-pay-product-up").val());
        data.append("precio_venta", $("#value-buy-product-up").val());
        data.append("categoria", $("#category-product-up").val());
        data.append("proveedor", $("#provider-product-up").val());
        data.append("cantidad_disponible", $("#cant-product-up").val());
        $.ajax({
            url: 'UptadeProduct',
            type: 'POST',
            contentType: false,
            data: data,
            processData: false,
            cache: false,
            success: function (success) {
                $(".alert-success").addClass("show");
                $(".alert-success").append(success.message);
                // $('#table-product> tbody>').empty();
                $('#modal-pr-update').modal('hide');
                $("#form-update-product").trigger('reset');
                // reloadProduct();
            },
            error: function (err) {
                console.log(err);
                $(".alert-update").addClass("show");
                $(".alert-update").append(err.message);
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

$("#form-update-category").submit(function(e) {
    e.preventDefault();
    if ($("#name-new-category-up").val() !== '') {
        $.ajax({
            url: 'UptadeCategory',
            type: 'POST',
            dataType: 'json',
            data: ({
                "id": $("#id-new-category-up").val(),
                "nombre": $("#name-new-category-up").val(),
                "descripcion": $("#description-category-up").val(),
            }),
            success: function (success) {
                $('#table-category> tbody>').empty();
                reloadCategory();
                $("#alert-scc-category").show();
                $("#alert-scc-category").append(success.message);
                $("#modal-ct-update").modal("hide");
            },
            error: function (err) {
                var message = err.responseJSON.message;
                $(".modal-up-category").addClass("show");
                $(".modal-up-category").append(message);
            }
        });
    } else {
        $(".modal-up-category").addClass("show");
        $(".modal-up-category").append("Todos los campos son requeridos");
    }
    setTimeout(() => {
        $(".alert").removeClass("show");
        $(".alert").hide();
        $(".alert").empty();
    }, 5000);
})

$("#form-update-provider").submit(function(e) {
    e.preventDefault();
    if ($("#name-incharge-up").val() !== '' && $("#name-provider-up").val() !== '' && $("#nit-provider-up").val() !== '' && $("#business-name-provider-up").val() !== '' && $("#address-provider-up").val() !== '' && $("#doc-employee-up").val() !== '') {
        $.ajax({
            url: 'UpdateProvider',
            type: 'POST',
            dataType: 'json',
            data: ({
                "id": $("#id-incharge-up").val(),
                "nombre_contacto": $("#name-incharge-up").val(),
                "nombre": $("#name-provider-up").val(),
                "nit": $("#nit-provider-up").val(),
                "razon_social": $("#business-name-provider-up").val(),
                "telefono": $("#number-provider-up").val(),
                "direccion": $("#address-provider-up").val(),
                "correo": $("#email-provider-up").val(),
                "numero_cuenta": $("#account-provider-up").val(),
                "tipo_cuenta": $("#type-account-provider-up").val(),
                "banco": $("#bank-provider-up").val(),

            }
            ),
            success: function (success) {
                $('#table-provider> tbody>').empty();
                $(".alert-success").addClass("show");
                $(".alert").append(success.message);
                $('#update-provider').modal('hide');
                $("#form-create-product").trigger('reset');
                reloadProvider();
            },
            error: function (err) {
                console.log(err);
                
                // var message = err.responseJSON.message;
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
})

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
                    <td>${response.data[i].pro_estado}</td>
                    <td class="d-flex justify-content-around">
                        <img src="views/assets/icons/edit.png" class="icon-list" onclick="updateProduct(${response.data[i].id_producto})">
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
//LISTAR PRODUCTOS PARA MOVIMIENTOS
reloadTableProductMoves();
function reloadTableProductMoves() {
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
                $('#table-product-moves> tbody:last').append(`
                <tr>
                    <th>${response.data[i].pro_codigo}</th>
                    <td>${response.data[i].pro_nombre}</td>
                    <td>${response.data[i].cat_nombre}</td>
                    <td>${response.data[i].pr_nombre}</td>
                    <td>${response.data[i].pro_cantidad_disponible}</td>
                    <td><input  class="form-control col-m2" type="number" id="prod-${response.data[i].id_producto}" value="0" ></td>
                    <td class="d-flex justify-content-around">
                        <img src="views/assets/icons/basket-duo.png" class="icon-list" id="func-${response.data[i].id_producto}" onclick="AddProductMove(${response.data[i].id_producto})">
                    </td>
                </tr>
                `);
            }
            $('#table-product-moves').DataTable();
        },
        error: function (response) {
            console.log(response);
        },
    });
}
//PRODUCTOS AFECTADOS EN EL MOVIENTO 
var dataMoves = [];
function AddProductMove(id){
    let cantidad = $("#prod-"+id).val();
    if(cantidad>0){
        $("#prod-"+id).attr("disabled",true);
        var element = document.getElementById("func-"+id);
        element.setAttribute('onclick','deleteProductMove('+dataMoves.length+')') ;
        element.setAttribute('src','X.png') ;
        dataMoves.push({    
            "id": id,
            "cantidad": cantidad
        });
    }else{
        alert("Inserta un valor valido");
    }
    console.log(dataMoves);
}
//eliminar productos del moviemiento
function deleteProductMove(index){
    $("#prod-"+dataMoves[index].id).attr("disabled",false);
    $("#prod-"+dataMoves[index].id).val("0");
    var element = document.getElementById("func-"+dataMoves[index].id);
    element.setAttribute('onclick','AddProductMove('+dataMoves[index].id+')') ;
    element.setAttribute('src','views/assets/icons/basket-duo.png') ;
    // dataMoves.splice(index,1);
    delete dataMoves[index];
    console.log(dataMoves);
}
//guardar Movimiento
$("#CrateMove").click(function(){
    var dataMovesSent = [];
    var fechaMove = $("#movement-date").val();
    var typeMove = $("#movement-type").val();
    var desc = $("#movement-description").val();
    if(fechaMove!="" && typeMove!="" && desc != ""){
        dataMoves.forEach(element => {
            dataMovesSent.push(element);
        });

        $.ajax({
            url: 'createMove',
            dataType: "json",
            type: "POST",
            data: ({
                "fecha": fechaMove,
                "typeMove": typeMove,
                "descripcion":desc,
                "productos":dataMovesSent
            }),
            success:function(response){
                console.log(response);
                if(response.status=="success"){
                    location.reload();
                }else{
                    alert("error.");
                }
            } ,
            error:function(response){
                console.log(response);
                alert(response.responseJSON.message);
            } 
        });         
    }else{
        alert("Inserta los datos para crear el movimiento.");
    }
});
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
            $('#table-category> tbody>').empty();
            for (var i = 0; i < response.data.length; i++) {
                $("#category-product").append(`
                    <option value="${response.data[i].id_categoria}">${response.data[i].cat_nombre}</option>
                `);
                $("#category-product-up").append(`
                    <option value="${response.data[i].id_categoria}">${response.data[i].cat_nombre}</option>
                `);
                $('#table-category> tbody:last').append(`
                <tr>
                    <th>${response.data[i].id_categoria}</th>
                    <td>${response.data[i].cat_nombre}</td>
                    <td>${response.data[i].cat_descripcion}</td>
                    <td class="d-flex justify-content-around">
                        <img src="views/assets/icons/edit.png" class="icon-list" onclick="updateCategory(${response.data[i].id_categoria})">
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
                $("#provider-product-up").append(`
                    <option value="${response.data[i].id_proveedor}">${response.data[i].pr_nombre}</option>
                `);
                $('#table-provider> tbody:last').append(`
                <tr>
                    <td>${response.data[i].pr_nombre}</td>
                    <td>${response.data[i].nombre_contacto}</td>
                    <td>${response.data[i].pr_telefono}</td>
                    <td class="d-flex justify-content-around">
                        <img src="views/assets/icons/edit.png" class="icon-list" onclick="updateProvider(${response.data[i].id_proveedor})">
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
//llenas tabla de movimientos
function reloadMoves() {
    $.ajax({
        url: 'readByMoves',
        dataType: "json",
        type: "POST",
        success: function (response) {
            console.log(response);
            $('#table-moviment> tbody>').empty();
            for (var i = 0; i < response.data.length; i++) {
                $('#table-moviment > tbody:last').append(`
                <tr>
                    <td>${response.data[i].id_movimiento}</td>
                    <td>${response.data[i].mov_tipo}</td>
                    <td>${response.data[i].mov_observaciones}</td>
                    <td>${response.data[i].mov_fecha}</td>
                    <td>${response.data[i].total}</td>
                    <td class="d-flex justify-content-around">
                        <img src="views/assets/icons/print.png" class="icon-list" onclick="printMove(${response.data[i].id_movimiento})">
                    </td>
                </tr>
                `);
            }
            $('#table-moviment').DataTable();
        },
        error: function (response) {
            console.log(response);
        },
    });
}

//print movement
function printMove(id) {
    console.log(id);
    $(".printMovenment").addClass("show");
    // window.print();
    // location.reload();
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
            var data = success.data
            console.log(data);
            $(".update-pr-img").empty()
            $(".update-pr-detail").empty()
            $(".update-pr-img").append(
            `<img src="views/assets/img/products/${data[0].pro_imagen}" class="update-img">`
            )
            var valuepay = new Intl.NumberFormat().format(data[0].pro_precio_compra);
            var valuebuy= new Intl.NumberFormat().format(data[0].pro_precio_venta);
           $(".update-pr-detail").append(`
                <h3>${data[0].pro_nombre}</h3>
                <small class="font-weight-bold">Codigo: ${data[0].pro_codigo}</small>
                <p>Precio de compra: ${valuepay}COP</p>
                <p>Precio de venta: ${valuebuy}COP</p>
                <p>Cantidad: ${data[0].pro_cantidad_disponible}</p>
                <p>Categoria: ${data[0].cat_nombre}</p>
                <p>proveedor: ${data[0].pr_nombre}</p>
           `); 
           $("#name-product-up").val(data[0].pro_nombre)
           $("#status-product-up").val(data[0].pro_estado)
           $("#id-product-up").val(data[0].id_producto)
           $("#code-product-up").val(data[0].pro_codigo)
           $("#value-pay-product-up").val(data[0].pro_precio_compra)
           $("#value-buy-product-up").val(data[0].pro_precio_venta)
           $("#cant-product-up").val(data[0].pro_cantidad_disponible)
           $("#category-product-up").val(data[0].cat_nombre)
           $("#provider-product-up").val(data[0].pr_nombre)  
        },
        error: function (err) {
            console.log(err);
            
        }
    })

}

function updateCategory(id) {
    $.ajax({
        url: 'readByCategory',
        dataType: "json",
        type: "POST",
        data: ({
            "columnDBSearch": "id_categoria",
            "value": id
        }),
        success: function(success) {
            console.log(success);
            data = success.data[0];
            $("#modal-ct-update").modal('show');
            $("#name-new-category-up").val(data.cat_nombre);
            $("#id-new-category-up").val(data.id_categoria);
            $("#description-category-up").val(data.cat_descripcion);       
        },
        error: function (err) {
            
        }
    })
}

function updateProvider(id) {
    $.ajax({
        url: 'readByProvider',
        dataType: "json",
        type: "POST",
        data: ({
            "columnDBSearch": "id_proveedor",
            "value": id
        }),
        success: function(success) {
            var data = success.data[0];
            console.log(success);
            $("#update-provider").modal('show');
            $("#id-incharge-up").val(data.id_proveedor);
            $("#name-incharge-up").val(data.nombre_contacto);
            $("#name-provider-up").val(data.pr_nombre);
            $("#nit-provider-up").val(data.pr_nit);
            $("#number-provider-up").val(data.pr_telefono);
            $("#business-name-provider-up").val(data.pr_razon_social);
            $("#address-provider-up").val(data.pr_direccion);
            $("#email-provider-up").val(data.pr_email);
            $("#account-provider-up").val(data.pr_numero_cuenta);
            $("#type-account-provider-up").val(data.pr_tipo_cuenta);
            $("#bank-provider-up").val(data.pr_banco);
            
        },
        error: function (err) {
            console.log(err);
            
        }
    })
}


