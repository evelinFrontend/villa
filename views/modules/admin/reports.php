<div class="content-main">
    <div class="row">
        <img src="views/assets/icons/angle-left-solid.svg" class="icon-menu mr-3" id="icon-back">
        <h4 class="pricipal-title mb-4 mt-3">Reportes</h4>
    </div>
    <div class="row items-repor">
        <div class="cards reporte col-3 p-4 mb-4" id="reporteVenta">
            <p class="text-center">Reporte de ventas</p>
        </div>
        <div class="cards reporte col-3 p-4 mb-4" id="reporteHabitacion">
            <p class="text-center">Reporte de Habitaciones</p>
        </div>
        <div class="cards reporte col-3 p-4 mb-4" id="reporInvetario">
            <p class="text-center">Reporte de inventario Actual</p>
        </div>
        <div class="cards reporte col-3 p-4 mb-4" id="ReporMovimiento">
            <p class="text-center">Reporte de movimientos</p>
        </div>
        <div class="cards reporte col-3 p-4 mb-4" id="productVendidos">
            <p class="text-center">Productos vendidos</p>
        </div>
        <div class="cards reporte col-3 p-4 mb-4" id="GananciaXproducto">
            <p class="text-center">Ganancia por producto</p>
        </div>
        <div class="cards reporte col-3 p-4 mb-4" id="formasPago">
            <p class="text-center">Formas de pago</p>
        </div>
    </div>
    <div class="search-reporte subcontent p-4">
        <h4 class="pricipal-title mb-4">Buscar por rango de fechas</h4>
        <form id="form-search">
            <div class="row">
                <div class="form-group col">
                    <label for="init-date">Desde:</label>
                    <input id="init-date" class="form-control" type="date">
                </div>
                <div class="form-group col">
                    <label for="init-date">Hasta</label>
                    <input id="init-date" class="form-control" type="date">
                </div>
                <div class="form-group col pt-2">
                    <button class="btn btn-primary mt-4">Buscar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="ganancia subcontent"></div>
    <div class="pago">
        <div class="row justify-content-around">
            <div class="cards reporte p-4 text-center">
                <h6>EFECTIVO</h6>
                <p>Total cancelado en efectivo</p>
                <h3>100.000</h3>
            </div>
            <div class="cards reporte p-4 text-center">
                <h6>TRANSFERENCIA</h6>
                <p>Total cancelado en transferencia</p>
                <h3>100.000</h3>
            </div>
            <div class="cards reporte p-4 text-center">
                <h6>CONSIGNACION</h6>
                <p>Total cancelado por consignación</p>
                <h3>100.000</h3>
            </div>
        </div>
    </div>
</div>
<script src="views/assets/js/reports.js"></script>