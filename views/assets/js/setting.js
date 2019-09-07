$(document).ready(function() {
    $('#table-employee').DataTable(); 
} );

$('#create-employee').submit(function(e) {
    e.preventDefault();
    if (
        $('#name-employee').val() !== '' &&
        $('#lastname-employee').val() !== '' &&
        $('#doc-employee').val() !== '' &&
        $('#birthdate').val() !== '' &&
        $('#number').val() !== '' &&
        $('#rol').val() !== '' &&
        $('#user-name-employee').val() !== '' &&
        $('#password-employee').val() !== '' &&
        $('#password-repet-employee').val() !== ''
    ) {
        if ($('#password-employee').val() === $('#password-repet-employee').val()) {
            $.ajax({
                url:'createUser',
                type: 'POST',
                dataType: 'json',
                data: ({
                    "nombres": $('#name-employee').val(),
                    "apellidos":  $('#lastname-employee').val(),
                    "numero_documento": $('#doc-employee').val(),
                    "fecha_nacimiento": $('#birthdate').val(),
                    "numero_contacto": $('#number').val(),
                    "correo": $('#email').val(),
                    "nombre_login": $('#user-name-employee').val(),
                    "rol": $('#rol').val(),
                    "contrasena": $('#password-employee').val(),
                    "rep_contrasena": $('#password-repet-employee').val()		
                }),
                success: function(success) {
                    $('#form-create-employee').modal('hide')

                },
                error: function(err) {
                    console.log(err);        
                }
            });
        } else {
            console.log('no coinci');
        }
    } else {
        console.log('buu');

    }
})