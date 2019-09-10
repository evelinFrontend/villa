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
            url: '',
            type: 'POST',
            dataType: 'json',
            data: ({

            }),
            success: function (success) {
                console.log(success);
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

$("#form-create-provider").submit(function(e) {
    e.preventDefault();
    if ($("#name-incharge").val() !== '' && $("#name-provider").val() !== '' && $("#nit-provider").val() !== '' && $("#business-name-provider").val() !== '' && $("#number-provider").val() !== '' && $("#address-provider").val() !== '' && $("#doc-employee").val() !== '') {
        $.ajax({
            url: '',
            type: 'POST',
            dataType: 'json',
            data: ({

            }),
            success: function (success) {
                console.log(success);
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