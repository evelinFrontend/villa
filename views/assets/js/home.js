//productos Registrados
$.ajax({
    url:'readByCantProduct',
    type:"GET",
    data:({}),
    success:function(response){
        console.log(response);
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
        console.log(response);
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
        console.log(response);
        $('#cantRegisterRooms').html(response.data.cantidad);
    },
    error:function(response){
        console.log(response);
    },
});


var ctx = document.getElementById('chart');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132)',
                'rgba(54, 162, 235)',
                'rgba(255, 206, 86)',
                'rgba(75, 192, 192)',
                'rgba(153, 102, 255)',
                'rgba(255, 159, 64)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
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