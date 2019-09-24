<div class="content-main">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <div class="cards statistics p-4">
                <h4 class="cards-title">Productos registrados</h4>
                <h1 class="card-data" id="cantRegisterProducts"></h1>
                <div class="card-content-link border-top">
                    <a href="inventario"><p class="text-center">ver mas</p></a>
                </div>
             </div>   
            <div class="cards statistics p-4">
                <h4 class="cards-title text-center">Usuarios registrados</h4>
                <h1 class="card-data text-center" id="cantRegisterUsers"></h1>
                <div class="card-content-link border-top">
                    <a href="configuraciones"><p class="text-center">ver mas</p></a>
                </div>
            </div>
            <div class="cards statistics p-4">
                <h4 class="cards-title">Habitaciones registradas</h4>
                <h1 class="card-data text-center" id="cantRegisterRooms"></h1>
                <div class="card-content-link border-top">
                    <a href="habitaciones"><p class="text-center">ver mas</p></a>
                </div>
            </div>
            <div class="cards statistics p-4">
                <h4 class="cards-title">Numero de cortesias en el mes</h4>
                <h1 class="card-data text-center" id="cantCortesias"></h1>
            </div>
        </div>
        <div class="row">
            <canvas id="chart"></canvas>
        </div>
    </div>
</div>
<script src="views/assets/lib/Chart.bundle.min.js"></script>
<script src="views/assets/lib/Chart.min.js"></script>
<script src="views/assets/js/home.js"></script>

<!-- reporte cierre de dia
turnos de empleados
 -->