//productos Registrados
$.ajax({
    url:'readByCantProduct',
    type:"GET",
    data:({}),
    success:function(response){
        $('#cantRegisterProducts').html(response.data.cantidad);
    },
    error:function(response){
        console.log(response);
    },
});
//Usuarios Registrados
$.ajax({
    url:'readUsuByCant',
    type:"GET",
    data:({}),
    success:function(response){
        $('#cantRegisterUsers').html(response.data.cantidad);
    },
    error:function(response){
        console.log(response);
    },
});
//Habitaciones Registrados
$.ajax({
    url:'readByRoomCant',
    type:"GET",
    data:({}),
    success:function(response){
        $('#cantRegisterRooms').html(response.data.cantidad);
    },
    error:function(response){
        console.log(response);
    },
});
//catidad de cortesias en el mes
$.ajax({
    url:'readByCountCortesia',
    type:"GET",
    data:({}),
    success:function(response){
        $('#cantCortesias').html(response.data.cantidadCortesias);
    },
    error:function(response){
        console.log(response);
    },
});


$.ajax({
    url:'obtenerReporteGraficaInicio',
    type:"GET",
    data:({}),
    success:function(response){
        response =response.data;
        console.log(response);
        var ctx = document.getElementById('chart');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Cortesias', 'Promociones', 'Reservas', 'Anulaciones'],
                datasets: [{
                    label: '# of Votes',
                    data: [
                        response.cantidadCortesias.cantidadCortesias,
                        response.cantidadPromociones.cantidadPromociones,
                        response.cantidadReservas.cantidadReservas, 
                        response.cantidadAnulaciones.cantidadAnulaciones
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132)',
                        'rgba(54, 162, 235)',
                        'rgba(255, 206, 86)',
                        'rgba(75, 192, 192)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    },
    error:function(response){
        console.log(response);
    },
});

